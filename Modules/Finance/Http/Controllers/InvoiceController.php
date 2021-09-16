<?php

namespace Modules\Finance\Http\Controllers;

use App\Models\Cases;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Finance\Http\Requests\InvoicePaymentRequest;
use Modules\Finance\Http\Requests\InvoiceSettingsRequest;
use Modules\Finance\Http\Requests\ServiceRequest;
use Modules\Finance\Services\InvoiceService;
use Modules\Finance\Services\ServiceService;

class InvoiceController extends Controller
{
    /**
     * @var ServiceService
     */
    private $service;
    /**
     * @var InvoiceService
     */
    private $invoiceService;

    public function __construct(
        ServiceService $service,
        InvoiceService $invoiceService
    )
    {
        $this->service = $service;
        $this->invoiceService = $invoiceService;
    }


    public function getService(Request $request)
    {
        $data['service'] = $this->service->findById($request->service_id);
        $data['row'] = $request->row;

        return view('finance::invoice.item_row', $data)->render();

    }

    public function getCase(Request $request)
    {
        $client_id = $request->client_id;

        $cases =  Cases::where(function($q) use ($client_id) {
            return $q->where('plaintiff', $client_id)->orWhere('opposite', $client_id);
        })->get()->pluck('title', 'id')->prepend( __('finance.Select Case'), '');

        $data['html'] = '';
        $data['html'] .=  \Form::label('case_id', __('finance.Select Case'));
        $data['html'] .= \Form::select('case_id', $cases,  null, ['class' => 'primary_select select_case', 'data-parsley-errors-container' => '#case_id_error']);

        return response()->json($data);

    }

    public function print($id){
        $data['model'] = $this->invoiceService->findById($id);
        return view('finance::invoice.print', $data);
    }

    public function add_payment($id){
        $preRequisite = $this->invoiceService->getPreRequisiteForPayment($id);
        return view('finance::invoice.add_payment', $preRequisite);
    }

    public function post_add_payment(InvoicePaymentRequest $request, $id){
        $model = $this->invoiceService->addPayment(array_merge($request->all()), $id);
        return response()->json(['message' => trans('finance.Payment Added to Invoice Successful'), 'reload' => true]);
    }

    public function settings (){
        $preRequisite = $this->invoiceService->getPreRequisiteForSettings();
        return view('finance::invoice.settings', $preRequisite);
    }

    public function post_settings (InvoiceSettingsRequest $request){
        $model = $this->invoiceService->saveSettings($request->validated());
        return response()->json(['message' => trans('finance.Invoice Settings Saved Successful'), 'reload'=> true]);
    }
}
