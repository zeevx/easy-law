@extends('layouts.master', ['title' => __('common.add_lawyer_to_case')])

@section('mainContent')
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header">
                        <div class="main-title d-flex  w-100">
                            <h3 class="mb-0 mr-30">{{__('common.add_lawyer_to_case')}}</h3>
                            <ul class="d-flex">
                                @if(permissionCheck('case.show'))
                                    <li><a class="primary-btn radius_30px mr-10 fix-gr-bg"
                                           href="{{ route('case.show', $case->id) }}"><i
                                                class="ti-list"></i> {{ __('common.back') }}</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="white_box_50px box_shadow_white">
                        {!! Form::open(['route' => ['case.add_lawyer', $case->id], 'class' => 'form-validate-jquery', 'id' => 'content_form', 'files' => false, 'method' => 'POST']) !!}
                        <div class="row">
                            <div class="primary_input col-md-12">
                                <div class="d-flex justify-content-between">

                                    <label for="lawyer_id">
                                        {{ __('case.Lawyer') }}
                                    </label>
                                    @if(permissionCheck('lawyer.store'))
                                        <label class="primary_input_label green_input_label" for="">
                                            <a href="{{ route('lawyer.create', ['quick_add' => true]) }}"
                                               class="btn-modal"
                                               data-container="lawyer_add_modal">{{ __('case.Create New') }}
                                                <i class="fas fa-plus-circle"></i></a></label>
                                    @endif
                                </div>
                                {{Form::select('lawyer_id[]', $lawyers, null, ['class' => 'primary_select', 'data-placeholder' => __('case.Lawyer'), 'required', 'multiple'])}}
                            </div>
                            <div class="primary_input col-md-12">
                                {{Form::hidden('case', $case->id)}}
                                {{Form::label('date', __('case.Date'), ['class' => 'required'])}}
                                {{Form::text('date', date('Y-m-d'), ['required' => '','class' => 'primary_input_field primary-input date form-control date', 'placeholder' => __('case.Date')])}}
                            </div>
                        </div>

                        <div class="text-center mt-3">
                            <button class="primary_btn_large submit" type="submit"><i
                                    class="ti-check"></i>{{ __('common.Add') }}
                            </button>
                            <button class="primary_btn_large submitting" type="submit" disabled style="display: none;">
                                <i class="ti-check"></i>{{ __('common.Adding') . '...' }}
                            </button>
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade animated lawyer_add_modal infix_advocate_modal" id="remote_modal" tabindex="-1" role="dialog"
         aria-labelledby="remote_modal_label" aria-hidden="true" data-backdrop="static">
    </div>

@stop
@push('admin.scripts')

    <script>
        $(document).ready(function () {
            _formValidation();
        });
    </script>
@endpush
