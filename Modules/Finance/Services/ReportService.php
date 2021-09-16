<?php


namespace Modules\Finance\Services;


use Carbon\Carbon;


class ReportService
{

    protected $chartOfAccountRepository,$transactionService,$bankAccountService;

    public function __construct(
        TransactionService $transactionService,
        BankAccountService $bankAccountService
    )
    {
        $this->transactionService = $transactionService;
        $this->bankAccountService = $bankAccountService;
    }

    public function profit(array $request): array
    {
        $data = [];
        $data['start'] = gv($request, 'start');
        $data['end'] = gv($request, 'end');

        $data['income'] = $this->transactionService->getTotalAmountByParamFilterByDate(['type' => 'in'], $data['start'], $data['end']);
        $data['expense'] = $this->transactionService->getTotalAmountByParamFilterByDate(['type' => 'out'], $data['start'], $data['end']);

        return $data;
    }

    public function transaction(array $request): array
    {
        $data = [];
        $data['start'] = gv($request, 'start');
        $data['end'] = gv($request, 'end');

        $data['transactions'] = $this->transactionService->allTransactions($data['start'], $data['end']);

        return $data;
    }

    public function statement(array $request): array
    {
        $data = [];

        $data['start'] = gv($request, 'start');
        $data['end'] = gv($request, 'end');

        $data['bank_account_id'] = gv($request, 'bank_account_id');

        $data['transactions'] = $this->transactionService->allTransactions($data['start'], $data['end'], $data['bank_account_id']);

        $data['banks'] = $this->bankAccountService->pluckAll();

        return $data;
    }

    public function bankReport($id): array
    {
        $data['bank'] = $this->bankAccountService->find($id);
        $data['transactions'] = $data['bank']->transactions;

        return $data;
    }
}
