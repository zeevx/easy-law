<?php

namespace Modules\Finance\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Finance\Http\Requests\BankAccountRequest;
use Modules\Finance\Services\BankAccountService;

class BankAccountController extends Controller
{

    /**
     * @var BankAccountService
     */
    private $bankAccountService;

    public function __construct(BankAccountService $bankAccountService)
    {
        $this->bankAccountService = $bankAccountService;
    }


    public function index()
    {
        $data['models'] = $this->bankAccountService->getAll();
        return view('finance::bank_account.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $fields = null;

        if (moduleStatusCheck('CustomField')){
            $fields = getFieldByType('bank_account');
        }
        return view('finance::bank_account.create', compact('fields'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(BankAccountRequest $request)
    {
        $model = $this->bankAccountService->store($request->validated());
        $response = [
            'model' => $model,
            'goto' => route('bank_accounts.index'),
            'message' => __('finance.Bank Account Added Successfully'),
        ];
        return response()->json($response);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $data['model'] = $this->bankAccountService->findById($id);

        return view('finance::bank_account.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $data['model'] = $this->bankAccountService->findById($id);
        $data['fields'] = null;

        if (moduleStatusCheck('CustomField')){
            $data['fields'] = getFieldByType('bank_account');
        }
        return view('finance::bank_account.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(BankAccountRequest $request, $id)
    {
        $model = $this->bankAccountService->update($id, $request->validated());
        $response = [
            'model' => $model,
            'goto' => route('bank_accounts.index'),
            'message' => __('finance.Bank Account Updated Successfully'),
        ];
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $this->bankAccountService->destroy($id);
        return response()->json(['message' => __('finance.Bank Account Deleted Successfully'), 'goto' => route('bank_accounts.index')]);
    }
}
