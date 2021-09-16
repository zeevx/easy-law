@extends('finance::layouts.master')
@push('css_before')
    <style>
        .invoice_table {
            border-collapse: collapse;
        }

        h1, h2, h3, h4, h5, h6 {
            margin: 0;
        }

        .invoice_wrapper {
            max-width: 435px;
            margin: auto;
        }

        .invoice_table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }

        .border_none {
            border: 0px solid transparent;
            border-top: 0px solid transparent !important;
        }

        .invoice_part_iner {
            background-color: #fff;
            padding: 20px;
        }

        .invoice_part_iner h4 {
            font-size: 30px;
            font-weight: 500;
            margin-bottom: 40px;

        }

        .invoice_part_iner h3 {
            font-size: 25px;
            font-weight: 500;
            margin-bottom: 5px;

        }

        .table_border thead {
            background-color: #F6F8FA;
        }

        .invoice_table td, .table th {
            padding: 5px 0;
            vertical-align: top;
            border-top: 0 solid transparent;
            color: #79838b;
        }

        .invoice_table td, .table th {
            padding: 5px 0;
            vertical-align: top;
            border-top: 0 solid transparent;
            color: #79838b;
        }

        .table_border tr {
            border-bottom: 1px solid #000 !important;
        }

        /* .table_border tr:last-child{
            border-bottom: 0 solid transparent !important;
        } */
        th p span, td p span {
            color: #212E40;
        }

        .invoice_table th {
            color: #00273d;
            font-weight: 300;
            border-bottom: 1px solid #f1f2f3 !important;
            background-color: #fafafa;
        }

        h5 {
            font-size: 16px;
            font-weight: 500;
            line-height: 23px;
        }

        h6 {
            font-size: 10px;
            font-weight: 300;
        }

        .mt_40 {
            margin-top: 40px;
        }

        .table_style th, .table_style td {
            padding: 20px;
        }

        .invoice_info_table td {
            font-size: 10px;
            padding: 0px;
        }

        .invoice_info_table td h6 {
            color: #6D6D6D;
            font-weight: 400;
        }

        p {
            font-size: 10px;
            color: #454545;
            line-height: 16px;
        }

        .invoice_info_table2 tbody {

        }

        .invoice_info_table2 tbody th {
            background: transparent;
            padding: 0px;
            text-align: right;
            border-bottom: 1px dotted #000 !important;
        }

        .invoice_info_table2 tbody td {
            padding: 0px;
        }

        .table_border2 thead {
            border-bottom: 1px solid #000 !important;
        }

        .table_border2 thead th {
            background: transparent;
            border-bottom: 1px solid #000 !important;
            font-size: 10px;
        }

        .table_border2 tbody td {
            padding: 0px;
            font-size: 10px;
        }

        .w_70 {
            width: 70%;
        }

        .pdf_table_1 {

        }

        .pdf_table_1 th {
            font-size: 10px;
            padding: 3px;
            background: transparent;
            border-bottom: 1px solid #000 !important;
            border-top: 1px solid #000 !important;
            text-align: left;
        }

        .pdf_table_2 th {
            font-size: 10px;
            padding: 3px;
            background: transparent;
            border-bottom: 1px solid #000 !important;
            border-top: 1px solid #000 !important;
            text-align: left;
        }

        .pdf_table_2 td {
            padding: 0;
        }

        .pdf_table_2 tfoot {

        }

        .pdf_table_2 tfoot td {
            background: #D2D6DE;
            color: #000 !important;
        }

        .dashed_table {
        }

        .dashed-underline {
            display: block;
            border-bottom: 1px dashed #000;
            margin: 5px 0;
        }

        .dashed_table th {
            background: transparent;
            border-bottom: 0 !important;
            text-align: right;
            padding: 0 !important;
            font-size: 10px;
        }

        .dashed_table td {
            padding: 0 !important;
        }

        .dashed_table td span {
            border-bottom: 1px dotted #000;
            padding: 0;
            display: block;
            margin-left: 5px;
            font-size: 10px;
        }

        .balance_text strong {
            font-style: italic;
        }

        hr {
            margin: 0 !important;
        }

        .invoice_wrapper h3,
        .invoice_wrapper h5,
        .invoice_wrapper h6,
        .invoice_wrapper h4 {
            color: #000000;
        }

        .invoice_wrapper table td,
        .invoice_wrapper table th {
            font-size: 10px !important;
        }


        .invoice_logo {
            width: 30%;
            float: left;
            text-align: left;
        }

        .invoice_no {
            text-align: right;
            color: #415094;
        }

        .invoice_info {
            padding: 20px;
            text-transform: capitalize;
        }

        table.dataTable tbody td {
            text-align: left;
        }

        @page {
            /* this affects the margin in the printer settings */
            margin-top: 1in;
        }

        .a4_width {
            max-width: 793.71px;
            min-height: 1122.52px;
            margin: auto;
        }

        .a4_width_modal {
            max-width: 210mm;
        }

        .modal-content .modal-body {
            border-radius: 15px;
        }

        .signature_bottom {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            bottom: 30px;
        }

        .extra-margin {
            height: 70px;
        }

        .QA_section .QA_table tbody th, .QA_section .QA_table tbody td {
            padding: 3px;
        }

        .nowrap {
            white-space: nowrap;
        }

        .hpb-1 {
            padding-bottom: 5px;
        }
    </style>
@endpush
@section('mainContent')


    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-lg-3 col-md-3 col-sm-12">
                    @php
                        $setting = config('configs')
                    @endphp
                    <div class="box_header common_table_header">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px text-nowrap">{{ __('finance.Invoice No'). ': '.$model->invoice_no }}</h3>
                            <ul class="d-flex">
                                @if ($model->payment_status == 'due')
                                    <li><a class="primary-btn radius_30px mr-10 fix-gr-bg"
                                           href="javascript:void(0)">{{ __('finance.Due')}}</a>
                                    </li>
                                @elseif ($model->status == 'partial')
                                    <li><a class="primary-btn radius_30px mr-10 fix-gr-bg"
                                           href="javascript:void(0)">{{__('finance.Partial')}}</a>
                                    </li>
                                @else
                                    <li><a class="primary-btn radius_30px mr-10 fix-gr-bg"
                                           href="javascript:void(0)">{{__('finance.Paid')}}</a>
                                    </li>
                                @endif

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12">
                    <ul class="d-flex float-right">
                        @php
                            $route = 'invoice.'. $model->invoice_type .'s.'
                        @endphp
                        <li><a class="primary-btn radius_30px mr-10 fix-gr-bg mr-10"
                               href="{{ route($route.'index') }}">{{__('finance.Back To List')}}</a>
                        </li>

                        @if(permissionCheck($route . 'edit'))
                        <li><a class="primary-btn radius_30px mr-10 fix-gr-bg mr-10"
                               href="{{ route($route.'edit',$model->id) }}">{{__('common.Edit')}}</a>
                        </li>
                        @endif


                        <li><a class="primary-btn radius_30px mr-10 fix-gr-bg mr-10 print_window"
                               href="{{ route('invoice.print',$model->id) }}"
                               target="_blank">{{__('common.Print')}}</a>
                        </li>


                        <li><a class="primary-btn radius_30px fix-gr-bg mr-10"
                               href="#" data-toggle="modal" data-target="#payments">{{__('finance.View Payments')}}</a>
                        </li>


                        @if($model->due >  0 and permissionCheck('invoice.payment.add'))
                            <li><a class="primary-btn radius_30px fix-gr-bg mr-10 btn-modal"
                                   data-container="payment_modal"
                                   href="{{ route('invoice.payment.add',$model->id) }}">{{__('finance.Add Payment')}}</a>
                            </li>
                        @endif

                    </ul>
                </div>

                <div class="col-12 student-details">

                    <div class="white_box_50px box_shadow_white position-relative a4_width" id="printableArea">
                        <div class="row pb-30 border-bottom">
                            <div class="col-md-6 col-lg-6">
                                @if (getConfig('site_logo'))
                                    <img src="{{ asset(getConfig('site_logo')) }}" width="100px" alt="">
                                @else
                                    <img src="{{ asset('public/uploads/settings/logo.png')}}" width="100px" alt="">
                                @endif
                            </div>
                            <div class="col-md-6 col-lg-6 text-right">
                                <h5 class="hpb-1">{{ getConfig('site_title') }}</h5>
                                <h5 class="hpb-1">{{ getConfig('phone') }}</h5>
                                <h5 class="hpb-1">{{ getConfig('email') }}</h5>
                                <h5>{{ getConfig('address') }}</h5>
                            </div>
                        </div>
                        <div class="row mt-1">
                            @if($model->case)
                                <div class="col-12 text-center font-weight-bold">
                                    {{ __('finance.Case Title') . ' : '.@$model->case->title }}
                                </div>
                            @endif
                            <div class="col-md-6 col-lg-6 col-sm-12">
                                <table class="table-borderless">

                                    <tr>
                                        <td>{{ __('finance.Invoice No') }}</td>
                                        <td>: {{ $model->invoice_no }}</td>
                                    </tr>

                                    @php
                                        $client = $model->invoice_type == 'income' ? 'Client' : 'Vendor'
                                    @endphp
                                    <tr>
                                        <td>{{ __('finance.'.$client.' Name') }}</td>
                                        <td>: {{ @$model->clientable->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{__('finance.'.$client.' Address')}}</td>
                                        <td>: {{ @$model->clientable->address }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{__('finance.Phone')}}</td>
                                        <td>
                                            : {{ @$model->clientable->mobile }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{__('finance.Email')}}</td>
                                        <td>
                                            <a href="mailto:{{ $model->clientable->email }}">: {{ $model->clientable->email }}</a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6 col-lg-6 col-sm-12">
                                <table class="table-borderless mr-0 ml-auto">
                                    <tr>
                                        <td>{{ __('finance.Invoice Date') }}</td>
                                        <td>
                                            : {{ formatDate($model->invoice_date)}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('finance.Due Date') }}</td>
                                        <td>
                                            : {{ formatDate($model->due_date)}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{__('finance.Created By')}}</td>
                                        <td>: {{ @$model->creator->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{__('finance.Created At')}}</td>
                                        <td>: {{ formatDate($model->created_at) }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{__('finance.Invoice Type')}}</td>
                                        <td>
                                            : {{ __('finance.'.ucfirst($model->invoice_type).' Invoice') }} </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6 col-lg-6 col-sm-12 previous_due" style="display: none">
                                <table class="table-borderless">
                                    <tr>
                                        <td><b>{{__('finance.Previous Due')}}</b></td>
                                    </tr>
                                    <tr>
                                        <td>{{__('Amount')}}:</td>
                                        <td>{{ amountFormat(0) }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row mt-10">
                            <div class="col-12">
                                <div class="QA_section QA_section_heading_custom check_box_table">
                                    <div class="QA_table ">
                                        <!-- table-responsive -->
                                        <div class="">
                                            <table class="table ">
                                                <tr class="m-0">
                                                    <th scope="col">{{ __('finance.No') }}</th>
                                                    <th scope="col"
                                                        width="20%">{{__('finance.'. ($model->invoice_type == 'income' ? 'Service' : 'Expense'). ' Type')}}</th>

                                                    <th scope="col">{{__('finance.Description')}}</th>
                                                    <th scope="col">{{__('finance.Qty/Hr')}}</th>
                                                    <th scope="col">{{__('finance.Unit Price')}}</th>

                                                    <th scope="col"
                                                        class="text-right">{{__('finance.Sub Total')}}</th>
                                                </tr>

                                                @foreach($model->items as $key=> $item)
                                                    <tr>
                                                        <td>{{ $key+1 }}</td>
                                                        <td>{{ $item->service->name }} </td>
                                                        <td>{{ $item->description }} </td>
                                                        <td class="nowrap">{{ $item->qty }}</td>
                                                        <td class="nowrap">{{ amountFormat($item->amount) }}</td>
                                                        <td class="text-right"> {{ amountFormat($item->total) }} </td>
                                                    </tr>

                                                @endforeach
                                                <tfoot>
                                                <tr>
                                                    <td colspan="5" style="text-align: right">
                                                        <ul>

                                                            <li class="nowrap">{{__('finance.Sub Total')}}
                                                                :
                                                            </li>

                                                            <li>{{__('finance.Discount')}}
                                                                :
                                                            </li>

                                                            <li>{{__('finance.Net Total')}}
                                                                :
                                                            </li>


                                                            <li>{{__('finance.Tax')}}
                                                                ({{ $model->tax }}%)
                                                                :
                                                            </li>


                                                            <li class="border-top-0">{{__('finance.Grand Total')}}
                                                                :
                                                            </li>
                                                            <li class="border-top-0">{{__('finance.Paid')}}
                                                                :
                                                            </li>
                                                            <li class="border-top-0">{{__('finance.Due')}}
                                                                :
                                                            </li>


                                                        </ul>
                                                    </td>

                                                    <td class="text-right mr-0 pr-2">
                                                        <ul>

                                                            <li class="nowrap">
                                                                {{ amountFormat($model->sub_total) }}
                                                            </li>

                                                            <li class="nowrap">
                                                                (-) {{ amountFormat($model->discount_amount) }}</li>

                                                            <li class="nowrap">
                                                                {{ amountFormat($model->net_total) }}
                                                            </li>

                                                            <li class="nowrap">
                                                                (+) {{ amountFormat($model->tax_amount) }}
                                                            </li>

                                                            <li class="nowrap">
                                                                {{ amountFormat($model->grand_total) }}
                                                            </li>


                                                            <li class="border-top-0">
                                                                {{ amountFormat($model->paid) }}
                                                            </li>
                                                            <li class="border-top-0">
                                                                {{ amountFormat($model->due) }}
                                                            </li>

                                                        </ul>
                                                    </td>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if(moduleStatusCheck('CustomField') and $model->customFields)
                            <div class="row">
                                @includeIf('customfield::details.show', ['customFields' => $model->customFields, 'file' => 'invoice'])

                            </div>
                        @endif

                        <div class="row mt-30 mb-60 pb-50">

                            @if($model->note)
                                <div class="col-lg-12 mt-10 text-justify">
                                    <h3>{{__('finance.Order Note')}}</h3>
                                    <p style="font-size:12px; font-weight:400; color:#828BB2; margin-top:5px">{!! $model->note !!}</p>
                                </div>
                            @endif

                                @if($model->invoice_type == 'income' and getConfig('terms_conditions'))
                                    <div class="col-lg-12 mt-10 text-justify mb-10">
                                        <p>{{__('finance.Terms & Condition')}}</p>
                                        <p style="font-size:12px; font-weight:400; color:#828BB2; margin-top:5px">{!! getConfig('terms_conditions') !!}</p>
                                    </div>
                                @endif

                            @if( getConfig('remarks_title') or getConfig('remarks_body'))
                                <div class="col-lg-12">
                                    <p class="text-center">{{ getConfig('remarks_title') }}</p>
                                    <span class="dashed-underline"></span>
                                    <p class="text-center">{!! getConfig('remarks_body') !!}</p>
                                </div>
                            @endif

                        </div>

                        <div class="extra-margin">

                        </div>
                        <div class="row mt-60 signature_bottom ">
                            <div class="col-md-6 text-center">
                                <img src="{{ asset('public/frontend/img/signature.png') }}" alt="">
                                <p>--------------------------</p>
                                <p>{{__('finance.'.$client)}}</p>
                                <p>{{__('finance.Signature')}}</p>
                            </div>

                            <div class="col-md-6 text-center">
                                <img
                                    src="{{ asset('public/frontend/img/signature.png') }}"
                                    alt="">
                                <p>--------------------------</p>
                                <p>{{__('finance.Authorized')}}</p>
                                <p>{{__('finance.Signature')}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-30 justify-content-center">
                        <a href="{{ route('invoice.'.$model->invoice_type.'s.index') }}"
                           class="primary-btn fix-gr-bg mr-20">{{__('finance.Back To Invoice List')}}</a>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <div class="modal fade animated payment_modal infix_biz_modal" id="remote_modal" tabindex="-1" role="dialog"
         aria-labelledby="remote_modal_label" aria-hidden="true" data-backdrop="static">
    </div>

    <div class="modal fade admin-query" id="payments">
        <div class="modal-dialog modal_1000px modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('finance.Payments History') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="ti-close "></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid p-0">
                        <div class="row mt-10">
                            <div class="col-12">

                                @includeIf('finance::invoice.payment_table')

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>



@endsection
@push("scripts")
    <script type="text/javascript">
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            setTimeout(function () {
                window.location.reload();
            }, 15000);
        }
    </script>
@endpush
