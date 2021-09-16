<?php


namespace Modules\Finance\Services;


use App\Traits\CustomFields;
use Illuminate\Support\Facades\DB;
use Modules\Finance\Entities\BankAccount;

class BankAccountService
{
    use CustomFields;
    /**
     * @var BankAccount
     */
    private $model;
    /**
     * @var TransactionService
     */
    private $transactionService;

    public function __construct(
        BankAccount $model
    )
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function store(array $requests)
    {
        $model = $this->model->forceCreate($this->formatRequest($requests));
        if (moduleStatusCheck('CustomField')){
            $this->storeFields($model, gv($requests, 'custom_field', []), 'bank_account');
        }
        return $model;
    }

    private function formatRequest(array $requests)
    {
        return [
            'bank_name' => gv($requests, 'bank_name'),
            'branch_name' => gv($requests, 'branch_name'),
            'account_name' => gv($requests, 'account_name'),
            'account_number' => gv($requests, 'account_number'),
            'opening_balance' => gv($requests, 'opening_balance', 0),
            'description' => gv($requests, 'description'),
        ];
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function update(int $id, array $requests)
    {
        $model = $this->findById($id);
        $model->forceFill($this->formatRequest($requests))->save();
        $model = $model->refresh();

        if (moduleStatusCheck('CustomField')){
            $this->storeFields($model, gv($requests, 'custom_field', []), 'bank_account');
        }

        return $model;
    }

    public function destroy($id)
    {
        $model = $this->destroyAble($id);

        return $model->delete();
    }

    private function destroyAble( $id)
    {
        $model = $this->findById($id);

//        delete Logic

        return $model;
    }

    private function transactionFormate(BankAccount $bankAccount)
    {
        return [
            'title' => "Opening balance",
            'description' => "{$bankAccount->bank_name} ({$bankAccount->account_number})",
            'payment_method' => 'bank',
            'amount' => $bankAccount->opening_balance,
            'transaction_date' => date('Y-m-d'),
            'bank_account_id' => $bankAccount->id,
            'come_from' => 'opening_balance',
            'type' => 'in',
        ];
    }

    public function pluckAll()
    {
        return $this->model->select(DB::raw('CONCAT(bank_name, " (", account_number, ")") AS full_name'), 'id')->where('status', 1)->get()->pluck('full_name', 'id')->prepend( __('finance.select_account'), '');
    }
}
