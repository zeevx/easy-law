@extends('finance::layouts.master', ['title' => __('finance.Update Income')])

@section('mainContent')

    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header">
                        <div class="main-title d-flex justify-content-between ">
                            <h3 class="mb-0 mr-30">{{ __('finance.Update Income') }}</h3>
                            <ul class="d-flex">
                                @if(permissionCheck('incomes.index'))
                                    <li><a class="primary-btn radius_30px mr-10 fix-gr-bg" href="{{ route('incomes.index') }}"><i class="ti-list"></i>{{ __
                        ('finance.Income List') }}</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="white_box_50px box_shadow_white">
                        {!! Form::model($model, ['route' => ['incomes.update', $model->id], 'class' => 'form-validate-jquery', 'id' => 'content_form', 'files' => false, 'method' => 'Put']) !!}
                        @includeIf('finance::income.components.form')
                        <div class="text-center mt-3">
                            <button class="primary_btn_large submit" type="submit"><i
                                    class="ti-check"></i>{{ __('common.Update') }}
                            </button>

                            <button class="primary_btn_large submitting" type="submit" disabled style="display: none;">
                                <i class="ti-check"></i>{{ __('common.Updating') . '...' }}
                            </button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade animated income_type_add infix_biz_modal" id="remote_modal" tabindex="-1" role="dialog"
         aria-labelledby="remote_modal_label" aria-hidden="true" data-backdrop="static">
    </div>

@stop
@push('admin.scripts')

    <script>
        $(document).ready(function () {
            _formValidation();
            bankOrCash($('#payment_method').val());

        });
    </script>
@endpush
