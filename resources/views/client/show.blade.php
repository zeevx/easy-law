@extends('layouts.master', ['title' => __('client.Client Details')])
@section('mainContent')
    <section class="mb-40 student-details">
        @if(session()->has('message-success'))
            <div class="alert alert-success">
                {{ session()->get('message-success') }}
            </div>
        @elseif(session()->has('message-danger'))
            <div class="alert alert-danger">
                {{ session()->get('message-danger') }}
            </div>
        @endif
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-3">
                    <!-- Start Student Meta Information -->
                    <div class="main-title">
                        <h3 class="mb-20">@lang('client.Client Details')</h3>
                    </div>
                    <div class="student-meta-box">
                        <div class="student-meta-top"></div>
                        <img class="student-meta-img img-100"
                             src="{{ file_exists($model->avatar) ? asset($model->avatar) : asset('public\backEnd/img/staff.jpg') }}"
                             alt="">
                        <div class="white-box">
                            <div class="single-meta mt-10">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        {{ __('client.Name') }}
                                    </div>
                                    <div class="value">
                                        @if(isset($model)){{@$model->name}}@endif
                                    </div>
                                </div>
                            </div>

                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        {{ __('client.Mobile') }}
                                    </div>
                                    <div class="value">
                                        @if(isset($model)){{@$model->mobile}}@endif
                                    </div>
                                </div>
                            </div>

                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        {{ __('client.Email') }}
                                    </div>
                                    <div class="value">
                                        @if(isset($model)){{@$model->email}}@endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- End Student Meta Information -->
                </div>
                <!-- Start Student Details -->
                <div class="col-lg-9 staff-details">
                    <ul class="nav nav-tabs tabs_scroll_nav" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#studentProfile" role="tab"
                               data-toggle="tab">{{ __('client.Profile') }}</a>
                        </li>

                        @if(moduleStatusCheck('Finance'))
                            <li class="nav-item">
                                <a class="nav-link" href="#invoicesTab" role="tab"
                                   data-toggle="tab">{{ __('finance.Invoices') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="#transactionsTab" role="tab"
                                   data-toggle="tab">{{ __('finance.Transactions') }}</a>
                            </li>
                        @endif

                        <li class="nav-item edit-button">
                            <a href="{{ route('client.edit', $model->id) }}" class="primary-btn small fix-gr-bg"
                            >{{ __('common.Edit') }}
                            </a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <!-- Start Profile Tab -->
                        <div role="tabpanel" class="tab-pane fade show active" id="studentProfile">
                            <div class="white-box">
                                <h4 class="stu-sub-head">{{ __('client.Client Info') }}</h4>
                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                {{ __('client.Name') }}
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                                @if(isset($model)){{$model->name}}@endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                {{ __('client.Mobile') }}
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                                @if(isset($model)){{$model->mobile}}@endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                {{ __('client.Email') }}
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                                @if(isset($model)){{$model->email}}@endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                {{ __('client.Client Category') }}
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                                @if(isset($model->category)){{@$model->category->name}}@endif
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                {{ __('client.Address') }}
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                                @if(isset($model)){{$model->address}}@endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                {{ __('client.Country') }}
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                                {{ $model->country ? $model->country->name : '' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                {{ __('client.State') }}
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                                {{ $model->state ? $model->state->name : '' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                {{ __('client.City') }}
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                                {{ $model->city ? $model->city->name : '' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                {{ __('client.Description') }}
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                                @if(isset($model)){!! $model->description !!}@endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if(moduleStatusCheck('CustomField') and $model->customFields)
                                    @includeIf('customfield::details.show', ['customFields' => $model->customFields])
                                @endif


                            </div>
                        </div>


                        @if(moduleStatusCheck('Finance'))
                            <div role="tabpanel" class="tab-pane fade" id="invoicesTab">
                                <div class="white-box">
                                    <div class="QA_section QA_section_heading_custom check_box_table">
                                        <div class="QA_table ">
                                    <table class="check_box_table table table-sm Crm_table_active ">
                                        <thead>
                                        <tr>
                                            <th scope="col">{{ __('common.SL') }}</th>
                                            <th>{{ __('finance.Date') }}</th>
                                            <th>{{ __('finance.Invoice No') }}</th>
                                            <th>{{ __('case.Case') }}</th>
                                            <th>{{ __('finance.Total Amount') }}</th>
                                            <th>{{ __('finance.Paid') }}</th>
                                            <th>{{ __('finance.Due') }}</th>
                                            <th class="d-print-none text-center">{{ __('common.Actions') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($model->invoices as $invoice)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>
                                                    {{ formatDate($invoice->transaction_date) }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('invoice.incomes.show', $invoice->id) }}"
                                                       target="_blank"> {{ $invoice->invoice_no }} </a>
                                                </td>
                                                <td>

                                                    @if($invoice->case)
                                                        <a href="{{ route('case.show', $invoice->case_id) }}" target="_blank">{{ $invoice->case->title }}</a>
                                                    @endif
                                                </td>
                                                <td>{{ amountFormat($invoice->grand_total) }}</td>
                                                <td>{{ amountFormat($invoice->paid) }}</td>
                                                <td>{{ amountFormat($invoice->due) }}</td>


                                                <td class="d-print-none text-center">

                                                    <div class="dropdown CRM_dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle"
                                                                type="button"
                                                                id="dropdownMenu2" data-toggle="dropdown"
                                                                aria-haspopup="true"
                                                                aria-expanded="false">
                                                            {{ __('common.Select') }}
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right"
                                                             aria-labelledby="dropdownMenu2">
                                                            @if(permissionCheck('invoice.incomes.show'))
                                                                <a href="{{ route('invoice.incomes.show', $invoice->id) }}"
                                                                   class="dropdown-item edit_brand">{{__('common.Show')}}</a>
                                                            @endif

                                                            @if(permissionCheck('invoice.incomes.show'))
                                                                <a
                                                                    class="dropdown-item edit_brand print_window"
                                                                    href="{{ route('invoice.print',$invoice->id) }}">{{__('common.Print')}}</a>
                                                            @endif

                                                            @if($invoice->due >  0 and permissionCheck('invoice.payment.add'))
                                                                <a class="dropdown-item edit_brand btn-modal"
                                                                   data-container="payment_modal"
                                                                   href="{{ route('invoice.payment.add',$invoice->id) }}">{{__('finance.Add Payment')}}</a>
                                                            @endif

                                                            @if(permissionCheck('invoice.incomes.edit'))
                                                                <a href="{{ route('invoice.incomes.edit', $invoice->id) }}"
                                                                   class="dropdown-item edit_brand">{{__('common.Edit')}}</a>
                                                            @endif
                                                            @if(permissionCheck('invoice.incomes.destroy'))
                                                                <span id="delete_item"
                                                                      data-id="{{ $invoice->id }}"
                                                                      data-url="{{ route('invoice.incomes.destroy', $invoice->id)}}"
                                                                      class="dropdown-item"><i
                                                                        class="icon-trash"></i>
                                                                        {{ __('common.Delete') }} </span>
                                                            @endif


                                                        </div>
                                                    </div>


                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="transactionsTab">
                                <div class="white-box">

                                    @php
                                        $model->invoice_type = 'income';
                                    @endphp
                                    @includeIf('finance::invoice.payment_table', ['dataTable' => 'Crm_table_active '])
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>
@if(moduleStatusCheck('Finance'))
    <div class="modal fade animated payment_modal infix_biz_modal" id="remote_modal" tabindex="-1" role="dialog"
         aria-labelledby="remote_modal_label" aria-hidden="true" data-backdrop="static">
    </div>
    @endif
@endsection
@push('admin.scripts')
    <script type="text/javascript">

    </script>
@endpush

