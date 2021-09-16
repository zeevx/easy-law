<?php

namespace Modules\Finance\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Finance\Http\Requests\ExpenseTypeRequest;
use Modules\Finance\Services\ServiceService;

class ExpenseTypeController extends Controller
{
    /**
     * @var ServiceService
     */
    private $service;
    /**
     * @var Request
     */
    private $request;

    public function __construct(
        ServiceService $service,
        Request $request
    )
    {
        $this->service = $service;
        $this->request = $request;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data['models'] = $this->service->getAllByType(['expense']);
        return view('finance::expense_type.index', $data);
    }

    public function create()
    {
        $quick_add = $this->request->quick_add;
        if ($this->request->ajax() and $quick_add == 1){
            return view('finance::expense_type.create_modal');
        }
        return view('finance::expense_type.create');
    }

    public function store(ExpenseTypeRequest $request)
    {
        $model = $this->service->store(array_merge($request->validated(), ['type' => 'expense']));
        $response = [
            'model' => $model,
            'message' => __('finance.Expense Type Added Successfully'),
        ];

        if ($request->quick_add != 1){
            $response['goto'] = route('expense_types.index');
        } else{
            $response['appendTo'] = '#service_type';
        }

        return response()->json($response);


    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        abort(404);
        return view('finance::show');
    }

    public function edit($id)
    {
        $data['model'] = $this->service->findById($id, 'expense');
        return view('finance::expense_type.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(ExpenseTypeRequest $request, $id)
    {
        $model = $this->service->update($id, array_merge($request->validated(), ['type' => 'expense']));
        $response = [
            'model' => $model,
            'goto' => route('expense_types.index'),
            'message' => __('finance.Expense Type Updated Successfully'),
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
        $this->service->destroy($id, 'expense');
        return response()->json(['message' => __('finance.Expense Type Deleted Successfully'), 'goto' => route('expense_types.index')]);
    }
}
