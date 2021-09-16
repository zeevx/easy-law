<?php

namespace Modules\Finance\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Finance\Http\Requests\IncomeTypeRequest;
use Modules\Finance\Services\ServiceService;

class IncomeTypeController extends Controller
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
        $data['models'] = $this->service->getAllByType(['income']);
        return view('finance::income_type.index', $data);
    }

    public function create()
    {
        $quick_add = $this->request->quick_add;
        if ($this->request->ajax() and $quick_add == 1){
            return view('finance::income_type.create_modal');
        }
        return view('finance::income_type.create');
    }

    public function store(IncomeTypeRequest $request)
    {
        $model = $this->service->store(array_merge($request->validated(), ['type' => 'income']));
        $response = [
            'model' => $model,
            'message' => __('finance.Income Type Added Successfully'),
        ];

        if ($request->quick_add != 1){
            $response['goto'] = route('income_types.index');
        } else{
            $response['appendTo'] = '#income_type';
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
        $data['model'] = $this->service->findById($id, 'income');
        return view('finance::income_type.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(IncomeTypeRequest $request, $id)
    {
        $model = $this->service->update($id, array_merge($request->validated(), ['type' => 'income']));
        $response = [
            'model' => $model,
            'goto' => route('income_types.index'),
            'message' => __('finance.Income Type Updated Successfully'),
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
        $this->service->destroy($id, 'income');
        return response()->json(['message' => __('finance.Income Type Deleted Successfully'), 'goto' => route('income_types.index')]);
    }
}
