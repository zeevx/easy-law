<?php


namespace Modules\Finance\Services;


use App\Traits\CustomFields;
use App\Traits\ImageStore;
use Modules\Finance\Entities\Service;
use Modules\Finance\Entities\Transaction;

class TransactionService
{
    use CustomFields;
    use ImageStore;
    /**
     * @var Transaction
     */
    private $model;

    /**
     * @var ServiceService
     */
    private $service;
    /**
     * @var BankAccountService
     */
    private $bankAccountService;

    public function __construct(
        Transaction $model,
        ServiceService $service,
        BankAccountService $bankAccountService
    )
    {
        $this->model = $model;
        $this->service = $service;
        $this->bankAccountService = $bankAccountService;
    }

    public function create($request)
    {
        return $this->model->forceCreate($this->formatRequest($request));
    }

    public function findById($id, array $come_from =[], array $with = [])
    {
        if ($come_from){
            return $this->model->with($with)->whereIn('come_from', $come_from)->findOrFail($id);
        }
        return $this->model->with($with)->findOrFail($id);

    }


    public function update($request, $id)
    {
        $transaction = $this->findById($id);
        $transaction->forceFill($this->formatRequest($request, $transaction))->save();
        $transaction= $transaction->refresh();
        if (moduleStatusCheck('CustomField')){
            $this->storeFields($transaction, gv($request, 'custom_field', []), $transaction->come_from);
        }
    }

    private function formatRequest($request, $transaction = null): array
    {
        $formattedRequest = [
            'title' => gv($request, 'title'),
            'payment_method' => gv($request, 'payment_method', 'cash'),
            'amount' => gv($request, 'amount'),
            'transaction_date' => gv($request, 'transaction_date'),
            'description' => gv($request, 'description')
        ];

        if (gv($request, 'service_id')){
            $formattedRequest['morphable_id'] = gv($request, 'service_id');
            $formattedRequest['morphable_type'] = get_class(new Service());
        } else{
            $formattedRequest['morphable_id'] = gv($request, 'morphable_id');
            $formattedRequest['morphable_type'] = gv($request, 'morphable_type');
        }

        if (gv($request, 'payment_method', 'cash') == 'bank'){
            $formattedRequest ['bank_account_id'] = gv($request, 'bank_account_id');
        } else{
            $formattedRequest ['bank_account_id'] = null;
        }

        if(gv($request, 'file')){
            $formattedRequest['file'] =  $this->saveFile(gv($request, 'file'));
        }

        if (!$transaction){
            $formattedRequest ['come_from'] = gv($request, 'come_from');
            $formattedRequest ['type'] = gv($request, 'type', 'in');
        }

        return $formattedRequest;
    }

    public function findByParam($param, array $with = [])
    {
        return $this->model->with($with)->where($param)->first();
    }

    public function getAllByType(array $type, $with = [])
    {
        return $this->model->with($with)->whereIn('come_from', $type)->get();
    }

    public function getPreRequisite($type, $come_from, $id = null)
    {
        $data['bank_accounts'] = $this->bankAccountService->pluckAll();
        $data['payment_methods'] = generate_finance_normal_translated_select_option(get_finance_var('list')['payment_method']);
        $data['service_types'] = $this->service->pluckAllByType($type, $come_from);
        $data['fields'] = null;
        if (moduleStatusCheck('CustomField')){
            $data['fields'] = getFieldByType($come_from);
        }
        if (!$id){
            return $data;
        }

        $data['model'] = $this->findById($id, $type);
        return $data;


    }

    public function store(array $requests)
    {
        $transaction =  $this->model->forceCreate($this->formatRequest($requests));
        if (moduleStatusCheck('CustomField')){
            $this->storeFields($transaction, gv($requests, 'custom_field', []), gv($requests, 'come_from'));
        }
    }

    public function destroy(int $id, array $come_from)
    {
        $model = $this->destroyAble($id, $come_from);
        return $model->delete();
    }

    private function destroyAble($id, $come_from)
    {
        return $this->findById($id, $come_from);
    }

    public function getTotalAmountByParamFilterByDate(array $params, $start, $end)
    {
        $transaction = $this->model->where($params);

        if ($start) {
            $transaction = $transaction->where('transaction_date', '>=', $start);
        }
        if ($end) {
            $transaction = $transaction->where('transaction_date', '<=', $end);
        }

        return $transaction->sum('amount');
    }

    public function allTransactions($start, $end, $bank_account_id = null)
    {
        $transaction = $this->model->with('bank');

        if ($start || $end) {
            $transaction = $transaction->whereBetween('transaction_date', [$start, $end]);
        }


        if ($bank_account_id) {
            $transaction = $transaction->where('bank_account_id', $bank_account_id);
        }

        return $transaction->get();
    }

}
