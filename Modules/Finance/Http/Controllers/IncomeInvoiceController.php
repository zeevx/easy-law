<?php

namespace Modules\Finance\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Finance\Http\Requests\InvoiceRequest;
use Modules\Finance\Services\InvoiceService;

class IncomeInvoiceController extends Controller
{
    /**
     * @var InvoiceService
     */
    private $invoiceService;
    private $invoice_type = 'income';

    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data['models'] = $this->invoiceService->getAllByType($this->invoice_type);
        return view('finance::invoice.income.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $preRequisite = $this->invoiceService->getPreRequisite($this->invoice_type);
        return view('finance::invoice.income.create', $preRequisite);
    }

    public function store(InvoiceRequest $request)
    {
        $model = $this->invoiceService->store(array_merge($request->all(), ['come_from' => 'income_invoice', 'type' => 'in']));
        return response()->json(['message' => trans('finance.'. ucfirst($request->invoice_type) .' Invoice Created Successful'), 'reload' => true, 'window' => route('invoice.print', $model->id)]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $data['model'] = $this->invoiceService->findById($id, $this->invoice_type);
        return view('finance::invoice.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $preRequisite = $this->invoiceService->getPreRequisite($this->invoice_type, $id);
        return view('finance::invoice.income.edit', $preRequisite);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(InvoiceRequest $request, $id)
    {
        $model = $this->invoiceService->update(array_merge($request->all(), ['come_from' => 'income_invoice', 'type' => 'in']), $id);
        return response()->json(['message' => trans('finance.'. ucfirst($this->invoice_type) .' Invoice Updated Successful'), 'goto' => route('invoice.incomes.index'), 'window' => route('invoice.print', $model->id)]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $this->invoiceService->destroy($id, $this->invoice_type);
        return response()->json(['message' => trans('finance.'. ucfirst($this->invoice_type) .' Invoice Deleted Successful'), 'goto' => route('invoice.incomes.index')]);
    }
}
