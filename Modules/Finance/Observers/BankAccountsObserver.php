<?php


namespace Modules\Finance\Observers;


use Illuminate\Support\Facades\Auth;
use Modules\Finance\Entities\BankAccount;
use Modules\Finance\Services\TransactionService;

class BankAccountsObserver
{
    /**
     * @var TransactionRepository
     */
    private $transactionService;

    /**
     * BankAccountsObserver constructor.
     * @param TransactionRepository $transactionService
     */
    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function creating(BankAccount $bankAccount){
        $bankAccount->created_by = Auth::id();
    }

    public function created(BankAccount $bankAccount){
        if ($bankAccount->opening_balance){
            $this->transactionService->create($this->transactionFormate($bankAccount));
        }
    }

    public function updating(BankAccount $bankAccount){
        $bankAccount->updated_by = Auth::id();
    }

    public function updated(BankAccount $bankAccount){
        $transaction = $this->transactionService->findByParam(['bank_account_id' => $bankAccount->id]);
        if ($transaction){
            if ($bankAccount->opening_balance){
                $this->transactionService->update($this->transactionFormate($bankAccount), $transaction->id);
            } else{
                $transaction->delete();
            }
        } else {
            if ($bankAccount->opening_balance){
                $this->transactionService->create($this->transactionFormate($bankAccount));
            }
        }
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


}
