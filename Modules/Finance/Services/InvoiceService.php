<?php


namespace Modules\Finance\Services;


use App\Models\Client;
use App\Traits\CustomFields;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Modules\Finance\Entities\Invoice;
use Modules\Finance\Entities\InvoiceItem;
use Modules\Setting\Entities\Config;
use Modules\Finance\Entities\Vendor;

class InvoiceService
{
    use CustomFields;
    /**
     * @var Invoice
     */
    private $model;
    /**
     * @var TaxService
     */
    private $taxService;
    /**
     * @var BankAccountService
     */
    private $bankAccountService;
    /**
     * @var ServiceService
     */
    private $service;
    /**
     * @var TransactionService
     */
    private $transactionService;

    public function __construct(
        Invoice $model,
        TaxService $taxService,
        BankAccountService $bankAccountService,
        ServiceService $service,
        TransactionService $transactionService
    )
    {
        $this->model = $model;
        $this->taxService = $taxService;
        $this->bankAccountService = $bankAccountService;
        $this->service = $service;
        $this->transactionService = $transactionService;
    }

    public function getAllByType($invoice_type)
    {
        return $this->model->where('invoice_type', $invoice_type)->get();
    }

    public function findById($id, $invoice_type = null){
        $model = $this->model->with(['items', 'items.service', 'transactions']);
        if ($invoice_type){
            return $model->where('invoice_type', $invoice_type)->findOrFail($id);
        }

        return $model->findOrFail($id);

    }

    public function getPreRequisite(string $invoice_type, $id = null)
    {
        $data['invoice_type'] = $invoice_type;
        $data['taxes'] = $this->taxService->pluckAll();

        $data['cases'] = ['' => __('finance.Select Case')];
        $data['invoice_no'] = formatInvoiceNumber($this->getAllByType($invoice_type)->max('id') + 1, $invoice_type);

        $data['bank_accounts'] = $this->bankAccountService->pluckAll();
        $data['payment_methods'] = generate_finance_normal_translated_select_option(get_finance_var('list')['payment_method']);
        $data['discount_type'] = generate_finance_normal_translated_select_option(get_finance_var('list')['discount_type']);

        if ($invoice_type == 'income') {
            $data['clients'] = Client::all()->pluck('name', 'id')->prepend( __('finance.select_client'), '');
            $data['clientable_type'] = get_class(new Client());
            $data['client_type'] = 'client';
            $data['service_types'] = $this->service->pluckAllByType(['service'], 'service');
        } else {
            $data['clients'] = Vendor::all()->pluck('name', 'id')->prepend( __('finance.select_vendor'), '');
            $data['clientable_type'] = get_class(new Vendor());
            $data['client_type'] = 'vendor';
            $data['service_types'] = $this->service->pluckAllByType(['expense'], 'expense');
        }
        $data['fields'] = null;
        if (moduleStatusCheck('CustomField')){
            $data['fields'] = getFieldByType($invoice_type.'_invoice');
        }

        if ($id){
            $data['model'] = $this->findById($id, $invoice_type);
        }

        return $data;
    }

    public function store(array $requests)
    {
        DB::beginTransaction();
        try
        {
            $model = $this->model->forceCreate($this->formatInvoiceRequest($requests));
            if (moduleStatusCheck('CustomField')){
                $this->storeFields($model, gv($requests, 'custom_field', []), gv($requests, 'invoice_type', ''). '_invoice');
            }
            $model->items()->saveMany($this->formatInvoiceItemRequest(gv($requests, 'item_row', [])));

            if (gv($requests, 'paid', 0) > 0){
                $this->transactionService->store($this->formatTransactionRequest($requests, $model));
            }
            DB::commit();

            return $model;
        } catch (\Exception $e) {
            DB::rollBack();
            throw ValidationException::withMessages(['message' => $e->getMessage()]);
        }

    }

    public function update($requests, $id)
    {
        DB::beginTransaction();
        try
        {
            $model = $this->findById($id, gv($requests, 'invoice_type', 'income'));
            $model->forceFill($this->formatInvoiceRequest($requests, $model))->save();

            $model->items()->delete();
            $model->items()->saveMany($this->formatInvoiceItemRequest(gv($requests, 'item_row', [])));
            $model->refresh();

            $adjust_amount = $model->balance - $model->grand_total;

            if ( $adjust_amount > 0){
                $this->transactionService->store($this->adjustTransaction($model, $adjust_amount, $requests));
            }

            DB::commit();

            return $model;
        } catch (\Exception $e) {
            DB::rollBack();
            throw ValidationException::withMessages(['message' => $e->getMessage()]);
        }
    }

    private function formatInvoiceRequest(array $requests, $invoice = null)
    {
        $tax = gv($requests, 'tax_id');
        $requests['tax_id'] = null;
        $requests['tax_value'] = 0;
        if ($tax){
            $tax = explode('-', $tax);
            $requests['tax_id'] = gv($tax, 0);
            $requests['tax_value'] = gv($tax, 1, 0);
        }

        $invoice_calc = $this->calculation($requests, $invoice);

        $invoice_no = gv($requests, 'invoice_no');
        $invoice_type = gv($requests, 'invoice_type', 'income');
        if (!$invoice_no){
            $invoice_no = $this->getAllByType($invoice_type)->max('id') + 1;
        }

        $formatRequest = [
            'clientable_id' => gv($requests, 'clientable_id'),
            'clientable_type' => gv($requests, 'clientable_type'),
            'case_id' => gv($requests, 'case_id'),
            'invoice_no' => $invoice_no,
            'invoice_type' => $invoice_type,
            'invoice_date' => gv($requests, 'invoice_date', date('Y-m-d')),
            'due_date' => gv($requests, 'due_date'),
            'sub_total' => gv($invoice_calc, 'sub_total', 0),
            'discount' => gv($requests, 'discount', 0),
            'discount_type' => gv($requests, 'discount_type', 'flat'),
            'discount_amount' => gv($invoice_calc, 'discount_amount', 0),
            'net_total' => gv($invoice_calc, 'net_total', 0),
            'tax' => gv($requests, 'tax_value', 0),
            'tax_amount' => gv($invoice_calc, 'tax_amount', 0),
            'tax_id' => gv($requests, 'tax_id'),
            'grand_total' => gv($invoice_calc, 'grand_total', 0),
            'paid' => gv($invoice_calc, 'paid', 0),
            'due' => gv($invoice_calc, 'due', 0),
            'payment_status' => gv($invoice_calc, 'payment_status'),
            'note' => gv($requests, 'note'),
        ];

        if (!$invoice){
            $formatRequest['created_by'] = Auth::id();
        } else{
            $formatRequest['updated_by'] = Auth::id();
        }


        return$formatRequest;
    }

    private function calculation(array $requests, $invoice)
    {
        $data['sub_total'] = 0;

        $data['paid'] = gv($requests, 'paid', 0);
        foreach($requests['item_row'] as $item_row){
            $data['sub_total'] += (gv($item_row, 'qty', 0) * gv($item_row, 'amount', 0));
        }

        $data['discount_amount'] = $this->invoice_discount($requests, $data['sub_total']);

        $data['net_total'] = $data['sub_total'] - $data['discount_amount'];

        $data['tax_amount'] = $this->invoice_tax($requests, $data['net_total']);

        $data['grand_total'] = $data['net_total'] + $data['tax_amount'];

        $data['due'] = $data['grand_total'] - $data['paid'];

        if ($invoice and $data['due'] < 0){
            $data['due'] = 0;
            $data['paid'] = $data['grand_total'];
        }

        if ($data['paid'] == 0 and $data['grand_total'] != 0){
            $data['payment_status'] = 'due';
        } else if ($data['due'] == 0){
            $data['payment_status'] = 'paid';
        } else if($data['due'] > 0 ){
            $data['payment_status'] = 'partial';
        } else if($data['due'] > 0 ){
            $data['payment_status'] = 'overpaid';
        } else {
            $data['payment_status'] = 'unknown';
        }

        return $data;


    }

    private function calculate_amount($total_amount, $calculation_amount, $calculation_type){
        if ($calculation_type == 'flat'){
            return (int) $calculation_amount;
        } else{
            return (($total_amount / 100) * $calculation_amount);
        }
    }

    private function invoice_discount($requests, $total_amount){
        return $this->calculate_amount($total_amount, gv($requests, 'discount', 0), gv($requests, 'discount_type', 'flat'));
    }

    private function invoice_tax($requests, $total_amount){
        return $this->calculate_amount($total_amount, gv($requests, 'tax_value', 0), 'percentage');
    }

    private function formatInvoiceItemRequest($items)
    {
        $formatItem = [];
        foreach($items as $item){
            $qty = gv($item, 'qty', 0);
            $amount = gv($item, 'amount', 0);
            $formatItem[] = new InvoiceItem([
                'service_type_id' => gv($item, 'service'),
                'qty' => $qty,
                'amount' => $amount,
                'total' => $qty * $amount
            ]);
        }

        return $formatItem;

    }

    private function formatTransactionRequest(array $requests, $invoice)
    {
        $type = gv($requests, 'type', 'in');
        $title = __('finance.Payment Paid to Invoice No.'). ' '.$invoice->invoice_no;
        if ($type == 'in'){
            $title = __('finance.Payment Receive for Invoice No.'). ' '.$invoice->invoice_no;
        }
        $formattedRequest = [
            'title' => $title,
            'payment_method' => gv($requests, 'payment_method', 'cash'),
            'amount' => gv($requests, 'paid'),
            'transaction_date' => gv($requests, 'invoice_date', gv($requests, 'transaction_date')),
            'morphable_id' => $invoice->id,
            'morphable_type' => get_class($invoice),
            'bank_account_id' => gv($requests, 'bank_account_id'),
            'come_from' => gv($requests, 'come_from'),
            'type' => $type,

        ];
        return $formattedRequest;

    }

    private function adjustTransaction($invoice, $adjust_amount, $requests)
    {
        $type = gv($requests, 'type', 'in');
        if ($type == 'in'){
            $type = 'out';
        } else{
            $type = 'in';
        }
        return [
            'title' => __('finance.Transaction Adjustment for Invoice No. '. $invoice->invoice_no),
            'payment_method' => 'cash',
            'amount' => $adjust_amount,
            'transaction_date' => $invoice->invoice_date,
            'morphable_id' => $invoice->id,
            'morphable_type' => get_class($invoice),
            'bank_account_id' => null,
            'come_from' => gv($requests, 'come_from'),
            'type' => $type,

        ];
    }

    public function getPreRequisiteForPayment($id)
    {
        $data['bank_accounts'] = $this->bankAccountService->pluckAll();
        $data['payment_methods'] = generate_finance_normal_translated_select_option(get_finance_var('list')['payment_method']);
        $data['model'] = $this->findById($id);
        return $data;
    }

    public function addPayment(array $requests, $id)
    {
        $invoice = $this->findById($id);
        if ($invoice->invoice_type == 'income'){
            $requests['come_from'] = 'income_invoice';
            $requests['type'] = 'in';
        } else{
            $requests['come_from'] = 'expense_invoice';
            $requests['type'] = 'out';
        }
        $invoice->forceFill($this->addTransactionToInvoice($requests, $invoice))->save();
        return $this->transactionService->store($this->formatTransactionRequest($requests, $invoice));
    }

    private function addTransactionToInvoice(array $requests, $invoice)
    {
        $paid = gv($requests, 'paid', 0);
        $data['paid'] = $invoice->paid + $paid;
        $data['due'] = $invoice->due - $paid;

        if ($invoice and $data['due'] < 0){
            $data['due'] = 0;
            $data['paid'] = $invoice->grand_total;
        }
        if ($data['due'] == 0){
            $data['payment_status'] = 'paid';
        } else if($data['due'] > 0 ){
            $data['payment_status'] = 'partial';
        } else if($data['due'] > 0 ){
            $data['payment_status'] = 'overpaid';
        } else {
            $data['payment_status'] = 'unknown';
        }

        return $data;

    }

    public function destroy(int $id, string $invoice_type)
    {
        $model = $this->destroyAble($id, $invoice_type);
        $model->transactions()->delete();
        $model->items()->delete();
        return $model->delete();
    }

    private function destroyAble(int $id, string $invoice_type)
    {
        return $this->findById($id, $invoice_type);
    }

    public function getPreRequisiteForSettings()
    {
        $data = [];
        $data['next_income_invoice_no'] = $this->getAllByType('income')->max('id') + 1;
        $data['next_expense_invoice_no'] = $this->getAllByType('expense')->max('id') + 1;
        $data['preview_number'] = str_pad(1, getConfig('invoice_number_padding', 4), 0, STR_PAD_LEFT);
        return $data;
    }

    public function saveSettings(array $requests)
    {

        foreach($requests as $key => $value){
            $config = Config::where('key', $key)->first();

            if($config === null){
                Config::create([
                    'key' => $key,
                    'value' => $value
                ]);
            }else{
                $config->value = $value;
                $config->save();
            }
        }

        return true;
    }


}
