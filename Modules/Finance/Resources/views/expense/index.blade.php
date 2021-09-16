@extends('finance::layouts.master')

@section('mainContent')


    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header common_table_header xs_mb_0">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{ __('finance.Expense List') }}</h3>
                            <ul class="d-flex">
                                @if(permissionCheck('expenses.store'))
                                    <li><a class="primary-btn radius_30px mr-10 fix-gr-bg"
                                           href="{{ route('expenses.create') }}"><i class="ti-plus"></i>{{ __('finance.New Expense') }}</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table ">
                            <!-- table-responsive -->
                            <div class="">
                                <table class="table Crm_table_active3">
                                    <thead>
                                    <tr>
                                        <th scope="col">{{ __('common.SL') }}</th>
                                        <th>{{ __('finance.Title') }}</th>
                                        <th>{{ __('finance.Type') }}</th>
                                        <th>{{ __('finance.Amount') }}</th>
                                        <th>{{ __('finance.Date') }}</th>
                                        <th>{{ __('finance.Payment By') }}</th>
                                        <th>{{ __('finance.Description') }}</th>
                                        <th>{{ __('common.Actions') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($models as $model)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>
                                                {{ $model->title }}
                                            </td>
                                            <td>
                                                {{ $model->morphable->name }}
                                            </td>
                                            <td>{{ amountFormat($model->amount) }}</td>
                                            <td>{{ formatDate($model->transaction_date) }}</td>
                                            <td>

                                                    @if ($model->payment_method == 'bank')
                                                    {{ __('list.'.$model->payment_method) . "  ({$model->bank->bank_name})" }}
                                                @else
                                                {{__('list.'.$model->payment_method)}}
                                                        @endif

                                            </td>
                                            <td>
                                                {!!  $model->description !!}
                                            </td>

                                            <td>


                                                <div class="dropdown CRM_dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                            id="dropdownMenu2" data-toggle="dropdown"
                                                            aria-haspopup="true"
                                                            aria-expanded="false">
                                                        {{ __('common.Select') }}
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right"
                                                         aria-labelledby="dropdownMenu2">
                                                        @if($model->file)
                                                            <a href="{{ asset('public/uploads/file/'.$model->file) }}" download=""
                                                               class="dropdown-item ">{{__('finance.Download File')}}</a>
                                                            @endif
                                                            @if(permissionCheck('expenses.index'))
                                                                <a href="{{ route('expenses.show', $model->id) }}"
                                                                   class="dropdown-item edit_brand">{{__('common.Show')}}</a>
                                                            @endif
                                                        @if(permissionCheck('expenses.edit'))
                                                            <a href="{{ route('expenses.edit', $model->id) }}"
                                                               class="dropdown-item edit_brand">{{__('common.Edit')}}</a>
                                                        @endif
                                                        @if(permissionCheck('expenses.destroy'))
                                                            <span id="delete_item" data-id="{{ $model->id }}" data-url="{{ route('expenses.destroy', $model->id)}}"
                                                                  class="dropdown-item"><i class="icon-trash"></i>
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


                @include('partials.delete_modal')
            </div>
        </div>
    </section>

@stop


@push('admin.scripts')


    <script>
        $(document).ready(function () {
        });

    </script>
@endpush
