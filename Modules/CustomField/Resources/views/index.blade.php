@extends('customfield::layouts.master')

@section('mainContent')
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header common_table_header xs_mb_0">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px" >{{ __('custom_fields.custom_fields') }}</h3>
                            <ul class="d-flex">
                                @if(permissionCheck('custom_fields.store'))
                                    <li><a class="primary-btn radius_30px mr-10 fix-gr-bg" href="{{ route('custom_fields.create') }}"><i class="ti-plus"></i>{{ __
                        ('custom_fields.add_custom_new_fields') }}</a></li>
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
                                        <th scope="col">{{ __('custom_fields.form_name') }}</th>
                                        <th scope="col">{{ __('custom_fields.type') }}</th>
                                        <th scope="col">{{ __('custom_fields.title') }}</th>
                                        <th scope="col">{{ __('custom_fields.values') }}</th>
                                        <th scope="col">{{ __('custom_fields.status') }}</th>
                                        <th scope="col">{{ __('common.Actions') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($models as $model)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ __('list.'.$model->form_name) }}
                                            </td>
                                            <td>{{ __('list.'.$model->type) }}</td>
                                            <td>
                                                <a href="{{ route('custom_fields.show', $model->id) }}" class="{{ $model->required ? 'required' : '' }}">{{ $model->title }}</a>
                                                @if($model->parent)
                                                    <br>
                                                    {{ __('custom_fields.controlled_by') }} : {{ $model->parent->title }}
                                                    <br>
                                                    {{ __('custom_fields.controlled_value') }} : {{ $model->controlled_field_value }}
                                                @endif
                                            </td>
                                            <td>{{ $model->values }}</td>
                                            <td>{!! populate_status($model->status) !!}</td>
                                            <td>
                                                <div class="dropdown CRM_dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                            id="dropdownMenu2" data-toggle="dropdown"
                                                            aria-haspopup="true"
                                                            aria-expanded="false">
                                                        {{ __('common.Select') }}
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                                        @if(permissionCheck('custom_fields.show'))
                                                            <a href="{{ route('custom_fields.show', $model->id) }}" class="dropdown-item edit_brand">{{__('common.View')}}</a>
                                                        @endif
                                                        @if(permissionCheck('custom_fields.edit'))
                                                            <a href="{{ route('custom_fields.edit', $model->id) }}" class="dropdown-item edit_brand">{{__('common.Edit')}}</a>
                                                        @endif

                                                        @if(permissionCheck('custom_fields.destroy'))
                                                            <span style="cursor: pointer;" data-url="{{route('custom_fields.destroy', $model->id)}}" id="delete_item" class="dropdown-item edit_brand" >{{__('common.Delete')}}</span>
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
            </div>
        </div>
    </section>
@endsection
