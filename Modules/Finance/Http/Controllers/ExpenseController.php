<?php

namespace Modules\Finance\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Finance\Http\Requests\ExpenseRequest;
use Modules\Finance\Services\TransactionService;

class ExpenseController extends Controller
{
    /**
     * @var TransactionService
     */
    private $transactionService;
    private $type = ['expense'];

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;

    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data['models'] = $this->transactionService->getAllByType($this->type, ['morphable']);
        return view('finance::expense.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $preRequisite = $this->transactionService->getPreRequisite($this->type, 'expense');
        return view('finance::expense.create', $preRequisite);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(ExpenseRequest $request)
    {
        $this->transactionService->store(array_merge($request->validated(), ['come_from' => 'expense', 'type' => 'out', 'service_id' => $request->expense_type]));
        return response()->json(['message' => trans('finance.Expense Added Successfully'), 'reload' => true]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $data['model'] = $this->transactionService->findById($id, ['expense']);
        return view('finance::expense.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $preRequisite = $this->transactionService->getPreRequisite($this->type, 'expense',  $id);
        return view('finance::expense.edit', $preRequisite);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(ExpenseRequest $request, $id)
    {
        $this->transactionService->update(array_merge($request->validated(), ['service_id' => $request->expense_type]), $id);
        return response()->json(['message' => trans('finance.Expense Updated Successfully'), 'goto' => route('expenses.index')]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $this->transactionService->destroy($id, $this->type);
        return response()->json(['message' => trans('finance.Expense Deleted Successfully'), 'goto' => route('expenses.index')]);
    }
}
