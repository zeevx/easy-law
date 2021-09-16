<?php

namespace Modules\Finance\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Finance\Http\Requests\ServiceRequest;
use Modules\Finance\Services\ServiceService;

class ServiceController extends Controller
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
        $data['models'] = $this->service->getAllByType(['service']);
        return view('finance::service.index', $data);
    }

    public function create()
    {
        $quick_add = $this->request->quick_add;
        if ($this->request->ajax() and $quick_add == 1){
            return view('finance::service.create_modal');
        }
        return view('finance::service.create');
    }

    public function store(ServiceRequest $request)
    {
        $model = $this->service->store(array_merge($request->validated(), ['type' => 'service']));
        $response = [
            'model' => $model,
            'message' => __('finance.Service Added Successfully'),
        ];

        if ($request->quick_add != 1){
            $response['goto'] = route('services.index');
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
        $data['model'] = $this->service->findById($id, 'service');
        return view('finance::service.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(ServiceRequest $request, $id)
    {
        $model = $this->service->update($id, array_merge($request->validated(), ['type' => 'service']));
        $response = [
            'model' => $model,
            'goto' => route('services.index'),
            'message' => __('finance.Service Updated Successfully'),
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
        $this->service->destroy($id, 'service');
        return response()->json(['message' => __('finance.Service Deleted Successfully'), 'goto' => route('services.index')]);
    }

    public function getService(Request $request)
    {
        $data['service'] = $this->service->findById($request->service_id);
        $data['row'] = $request->row;

        return view('finance::invoice.item_row', $data)->render();

    }
}
