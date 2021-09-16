@extends('layouts.print')

@push('css_before')
    <style>
        .invoice_heading {
            border-bottom: 1px solid black;
            padding: 20px;
            text-transform: capitalize;
        }

        body {
            font-family: "Poppins", sans-serif;
        }

        .invoice_logo {
            width: 50%;
            float: left;
            text-align: left;
        }

        .invoice_no {
            text-align: right;
            color: #415094;
        }

        .invoice_info {
            padding: 20px;
            width: 100%;
            text-transform: capitalize;
        }

        .t-100 {
            min-height: 100px;
        }

        .billing_info {
            margin-top: 115px;
        }

        .table tbody td {
            padding: 8px 15px !important;
        }

        .table td, .table th {
            padding: .75rem;
            vertical-align: top;
            border-top: 1px solid #ddd !important;
        }

        table {
            text-align: left;
            font-family: "Poppins", sans-serif;
        }

        td, th {
            color: #828bb2;
            font-size: 13px;
            font-weight: 400;
            font-family: "Poppins", sans-serif;
        }

        th {
            font-weight: 600;
            font-family: "Poppins", sans-serif;
        }

        li {
            list-style-type: none;
            text-align: right;
        }

        .sale_note {
            width: 45%;
            float: left;
            text-align: left;
        }

        .notes {
            color: #415094;
            font-size: 18px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .note_details {
            font-size: 12px;
            font-weight: 600;
            color: #828BB2 !important;
        }

        .margin_120 {
            margin-top: 120px;
            font-size: 12px;
        }

        .margin_12 {
            margin-bottom: 120px;
            font-size: 12px;
        }

        .invoice_footer {
            /* position: absolute;
            left: 0;
            bottom: 180px; */
            width: 100%;
        }

        .invoice_info_footer {
            padding: 0px;
            width: 100%;
            left: 0;
            text-transform: capitalize;
            position: inherit;
        }

        p {
            font-size: 10px;
            color: #454545;
            line-height: 16px;
        }

        /* .extra_div {
            height:500px;
        } */
        .a4_width {
            max-width: 210mm;
            margin: auto;
        }

        .nowrap {
            white-space: nowrap;
        }

        .hpb-1 {
            padding-bottom: 5px;
        }

        .dashed-underline {
            display: block;
            border-bottom: 1px dashed #000;
            margin: 5px 0;
            width: 100%;
        }

        html {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .invoice_info {
            padding: 20px;
            width: 100%;
            flex: 1 0 auto;
            text-transform: capitalize;
        }

        .flex_auto_div {
            padding: 20px;
            display: flex;
            width: 100%;
            flex: 1 0 auto;
            text-transform: capitalize;
            flex-direction: column;
            justify-content: flex-end;
            align-items: center;

        }
    </style>
@endpush

@section('mainContent')
    <div class="container-fluid ">
        <div class="invoice_heading">
            <div class="invoice_logo">
                @if (getConfig('site_logo'))
                    <img src="{{ asset(getConfig('site_logo')) }}" width="100px" alt="">
                @else
                    <img src="{{ asset('public/uploads/settings/logo.png')}}" width="100px" alt="">
                @endif
            </div>
            <div class="invoice_no">
                <h5 class="hpb-1">{{ getConfig('site_title') }}</h5>
                <h5 class="hpb-1">{{ getConfig('phone') }}</h5>
                <h5 class="hpb-1">{{ getConfig('email') }}</h5>
                <h5>{{ getConfig('address') }}</h5>
            </div>
        </div>
        <div class="invoice_info">
            @if($model->case)
                <div class="text-center font-weight-bold">
                    {{ __('finance.Case Title') . ' : '.@$model->case->title }}
                </div>
            @endif
            <div class="invoice_logo" style="width:75%">
                <table class="table-borderless">

                    <tr>
                        <td>{{ __('finance.Invoice No') }}</td>
                        <td class="p-1">: {{ $model->invoice_no }}</td>
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
            <div class="invoice_logo" style="width:25%">
                <table class="table-borderless mr_0 ml_auto">
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
        </div>

        <div class="invoice_info">
            <table class="table billing_info">
                <tr>
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

        <div class="invoice_info margin_12 custom_margin"
             style="display: flex;justify-content: space-between; width:100%;">

            @if($model->note)
                <div class="col-lg-12 mt-10 text-justify">
                    <h3>{{__('finance.Order Note')}}</h3>
                    <p style="font-size:12px; font-weight:400; color:#828BB2; margin-top:5px">{!! $model->note !!}</p>
                </div>
            @endif

        </div>
        <div class="invoice_info">

            @if(getConfig('terms_conditions'))
                <div class="col-lg-12 mt-10 text-justify">
                    <p>{{__('finance.Terms & Condition')}}</p>
                    <p style="font-size:12px; font-weight:400; color:#828BB2; margin-top:5px">{!! getConfig('terms_conditions') !!}</p>
                </div>
            @endif
        </div>
    </div>




    @if( getConfig('remarks_title') or getConfig('remarks_body'))
        <div class="flex_auto_div">
            <p class="text-center">Remarks: {{ getConfig('remarks_title') }}</p>
            <span class="dashed-underline"></span>
            <p class="text-center">{{ getConfig('remarks_body') }}</p>
        </div>
    @endif



    <footer class="invoice_footer">
        <div class="invoice_info_footer">
            <div class="invoice_logo text-center">
                <img src="{{ asset('public/frontend/img/signature.png') }}" alt="">
                <p>--------------------------</p>
                <p style="margin-bottom:0; line-height:14px;">{{__('finance.'.$client)}}</p>
                <p>{{__('finance.Signature')}}</p>
            </div>
            <div class="invoice_logo text-center">
                <img
                    src="{{ asset('public/frontend/img/signature.png') }}"
                    alt="">
                <p>--------------------------</p>
                <p style="margin-bottom:0; line-height:14px;">{{__('finance.Authorized')}}</p>
                <p>{{ __('finance.Signature')}}</p>
            </div>
        </div>
    </footer>
@endsection
