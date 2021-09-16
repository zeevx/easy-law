<?php

namespace Modules\Finance\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Finance\Http\Requests\VendorRequest;
use Modules\Finance\Services\VendorService;

class VendorController extends Controller
{
    private $vendorService;

    public function __construct(VendorService $vendorService)
    {
        $this->vendorService = $vendorService;
    }

    public function index()
    {
        $data['models'] = $this->vendorService->getAll();
        return view('finance::vendor.index', $data);
    }

    public function create()
    {
        $preRequisite = $this->vendorService->getPreRequisite();
        return view('finance::vendor.create', $preRequisite);
    }

    public function store(VendorRequest $request)
    {
        $model = $this->vendorService->store($request->all());

        $response = [
            'model' => $model,
            'goto' => route('vendors.index'),
            'message' => __('vendor.Vendor Added Successfully'),
        ];
        return response()->json($response);
    }

    public function show($id)
    {
        $data['model'] = $this->vendorService->findById($id);
        return view('finance::vendor.show', $data);
    }

    public function edit($id)
    {
        $preRequisite = $this->vendorService->getPreRequisite($id);
        return view('finance::vendor.edit', $preRequisite);
    }

    public function update(VendorRequest $request, $id)
    {
        $model = $this->vendorService->update($id, $request->all());
        $response = [
            'model' => $model,
            'goto' => route('vendors.index'),
            'message' => __('vendor.Vendor Updated Successfully'),
        ];
        return response()->json($response);
    }

    public function destroy($id)
    {
        $this->vendorService->destroy($id);
        return response()->json(['message' => __('vendor.Vendor Deleted Successfully'), 'goto' => route('vendors.index')]);
    }
}
