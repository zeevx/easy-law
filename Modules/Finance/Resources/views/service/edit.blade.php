@extends('finance::layouts.master', ['title' => __('finance.Update Service')])

@section('mainContent')

    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header">
                        <div class="main-title d-flex justify-content-between ">
                            <h3 class="mb-0 mr-30">{{ __('finance.Update Service') }}</h3>
                            <ul class="d-flex">
                                @if(permissionCheck('services.index'))
                                    <li><a class="primary-btn radius_30px mr-10 fix-gr-bg" href="{{ route('services.index') }}"><i class="ti-list"></i>{{ __
                        ('finance.Service List') }}</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="white_box_50px box_shadow_white">
                        {!! Form::model($model, ['route' => ['services.update', $model->id], 'class' => 'form-validate-jquery', 'id' => 'content_form', 'files' => false, 'method' => 'Put']) !!}
                        @includeIf('finance::service.components.form')
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
            _formValidation();

        });
    </script>
@endpush
