<?php

namespace Modules\Finance\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Finance\Http\Requests\TaxRequest;
use Modules\Finance\Services\TaxService;

class TaxController extends Controller
{
    /**
     * @var TaxService
     */
    private $taxService;

    public function __construct(TaxService $taxService)
    {
        $this->taxService = $taxService;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data['models'] = $this->taxService->getAll();
        return view('finance::tax.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {

        return view('finance::tax.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(TaxRequest $request)
    {
        $model = $this->taxService->store($request->validated());
        $response = [
            'model' => $model,
            'goto' => route('taxes.index'),
            'message' => __('finance.Tax Added Successfully'),
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
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $data['model'] = $this->taxService->findById($id);
        return view('finance::tax.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(TaxRequest $request, $id)
    {
        $model = $this->taxService->update($id, $request->validated());
        $response = [
            'model' => $model,
            'goto' => route('taxes.index'),
            'message' => __('finance.Tax Updated Successfully'),
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
        $this->taxService->destroy($id);
        return response()->json(['message' => __('finance.Tax Deleted Successfully'), 'goto' => route('taxes.index')]);
    }
}
