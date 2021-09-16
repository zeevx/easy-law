@extends('finance::layouts.master', ['title' => __('finance.Bank Account Details')])

@section('mainContent')

    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header">
                        <div class="main-title d-flex justify-content-between">
                            <h3 class="mb-0 mr-30">{{ __('finance.Bank Account Details') }}</h3>
                            <ul class="d-flex">
                                @if(permissionCheck('bank_accounts.index'))
                                    <li><a class="primary-btn radius_30px mr-10 fix-gr-bg"
                                           href="{{ route('bank_accounts.index') }}"><i class="ti-list"></i>{{ __
                        ('finance.Bank Account List') }}</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="white_box_50px box_shadow_white">

                        <table>
                            <tbody>

                            <tr>
                                <td class="p-2">{{__('finance.bank_name')}} </td>
                                <td>:</td>
                                <td> {{ $model->bank_name }}</td>
                            </tr>

                            <tr>
                                <td class="p-2">{{__('finance.branch_name')}} </td>
                                <td>:</td>
                                <td> {{ $model->branch_name }}</td>
                            </tr>

                            <tr>
                                <td class="p-2">{{__('finance.account_name')}} </td>
                                <td>:</td>
                                <td> {{ $model->account_name }}</td>
                            </tr>
                            <tr>
                                <td class="p-2">{{__('finance.account_number')}} </td>
                                <td>:</td>
                                <td> {{ $model->account_number }}</td>
                            </tr>

                            <tr>
                                <td class="p-2">{{__('finance.opening_balance')}} </td>
                                <td>:</td>
                                <td> {{ amountFormat($model->opening_balance) }}</td>
                            </tr>

                            <tr>
                                <td class="p-2">{{__('court.Description')}} </td>
                                <td>:</td>
                                <td>{!! $model->description !!}</td>
                            </tr>
                            @if(moduleStatusCheck('CustomField') and $model->customFields)
                                @includeIf('customfield::details.show', ['customFields' => $model->customFields, 'file' => 'tr'])
                            @endif

                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </section>

@stop


@push('admin.scripts')

@endpush
