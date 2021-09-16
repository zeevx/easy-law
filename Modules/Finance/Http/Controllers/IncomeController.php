<?php

namespace Modules\Finance\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Finance\Http\Requests\IncomeRequest;
use Modules\Finance\Services\TransactionService;

class IncomeController extends Controller
{
    /**
     * @var TransactionService
     */
    private $transactionService;
    private $type = ['income'];

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
        return view('finance::income.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $preRequisite = $this->transactionService->getPreRequisite($this->type, 'income');

        return view('finance::income.create', $preRequisite);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(IncomeRequest $request)
    {
        $this->transactionService->store(array_merge($request->validated(), ['come_from' => 'income', 'type' => 'in', 'service_id' => $request->income_type]));
        return response()->json(['message' => trans('finance.Income Added Successfully'), 'reload' => true]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $data['model'] = $this->transactionService->findById($id, ['income']);
        return view('finance::income.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $preRequisite = $this->transactionService->getPreRequisite($this->type, 'income', $id);
        return view('finance::income.edit', $preRequisite);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(IncomeRequest $request, $id)
    {
        $this->transactionService->update(array_merge($request->validated(), ['service_id' => $request->income_type]), $id);
        return response()->json(['message' => trans('finance.Income Updated Successfully'), 'goto' => route('incomes.index')]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $this->transactionService->destroy($id, $this->type);
        return response()->json(['message' => trans('finance.Income Deleted Successfully'), 'goto' => route('incomes.index')]);
    }
}
