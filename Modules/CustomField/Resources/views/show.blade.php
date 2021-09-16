@extends('customfield::layouts.master')

@section('mainContent')

    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header">
                        <div class="main-title d-flex justify-content-between">
                            <h3 class="mb-0 mr-30">{{__('custom_fields.field_details')}}</h3>
                            <ul class="d-flex">
                                @if(permissionCheck('custom_fields.index'))
                                    <li><a class="primary-btn radius_30px mr-10 fix-gr-bg"
                                           href="{{ route('custom_fields.index') }}"><i class="ti-list"></i>{{ __
                        ('custom_fields.custom_fields') }}</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="white_box_50px box_shadow_white">

                        <div class="row">
                            <div class="col-12">
                                <table class="table-sm">
                                    <tbody>
                                    <tr>
                                        <td>{{__('custom_fields.form_name')}} </td>
                                        <td>:</td>
                                        <td>{{ __('list.'.$model->form_name) }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{__('custom_fields.type')}} </td>
                                        <td>:</td>
                                        <td>{{ __('list.'.$model->type) }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{__('custom_fields.default_value')}} </td>
                                        <td>:</td>
                                        <td>{{ $model->values }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{__('custom_fields.min')}} </td>
                                        <td>:</td>
                                        <td>{{ $model->min }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{__('custom_fields.max')}} </td>
                                        <td>:</td>
                                        <td>{{ $model->max }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{__('custom_fields.width')}} </td>
                                        <td>:</td>
                                        <td>{{ __('list.'.$model->width) }}</td>
                                    </tr>

                                    <tr>
                                        <td>{{__('custom_fields.required')}} </td>
                                        <td>:</td>
                                        <td>{{ $model->required ? __('custom_fields.yes') :  __('custom_fields.no') }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{__('custom_fields.status')}} </td>
                                        <td>:</td>
                                        <td>{{ $model->status ? __('custom_fields.active') :  __('custom_fields.de-active') }}</td>
                                    </tr>

                                    <tr>
                                        <td>{{__('custom_fields.description')}} </td>
                                        <td>:</td>
                                        <td>{!! $model->description !!}</td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>


@stop
@push('admin.scripts')

@endpush
