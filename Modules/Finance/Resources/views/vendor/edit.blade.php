@extends('finance::layouts.master', ['title' => __('vendor.Update Vendor')])

@section('mainContent')

    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header">
                        <div class="main-title d-flex justify-content-between">
                            <h3 class="mb-0 mr-30">{{ __('vendor.Update Vendor') }}</h3>
                            @if(permissionCheck('vendors.index'))
                                <li><a class="primary-btn radius_30px mr-10 fix-gr-bg" href="{{ route('vendors.index') }}"><i class="ti-list"></i>{{ __
                        ('vendor.Vendor List') }}</a></li>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="white_box_50px box_shadow_white">
                        {!! Form::model($model, ['route' => ['vendors.update', $model->id], 'class' => 'form-validate-jquery', 'id' => 'content_form', 'files' => false, 'method' => 'put']) !!}
                        @includeIf('finance::vendor.components.form')
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

@stop
@push('admin.scripts')

    <script>
        $(document).ready(function () {
            _componentAjaxChildLoad('#content_form', '#country_id', '#state_id', 'state')
            _componentAjaxChildLoad('#content_form', '#state_id', '#city_id', 'city')
            _formValidation();

        });
    </script>
@endpush
