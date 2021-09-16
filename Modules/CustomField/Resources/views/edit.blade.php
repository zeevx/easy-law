@extends('customfield::layouts.master')

@section('mainContent')

    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header">
                        <div class="main-title d-flex justify-content-between ">
                            <h3 class="mb-0 mr-30">{{__('custom_fields.update_field')}}</h3>
                            <ul class="d-flex">
                                @if(permissionCheck('custom_fields.index'))
                                    <li><a class="primary-btn radius_30px mr-10 fix-gr-bg" href="{{ route('custom_fields.index') }}"><i class="ti-list"></i>{{ __
                        ('custom_fields.field_lists') }}</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="white_box_50px box_shadow_white">

                        {!! Form::model($model, ['route' => ['custom_fields.update', $model->id], 'class' => 'form-validate-jquery', 'id' => 'content_form', 'files' => false, 'method' => 'PUT']) !!}
                        @includeIf('customfield::components._form')
                        <div class="text-center mt-3">
                            <button type="submit" class="primary-btn semi_large2 fix-gr-bg submit" id="submit"
                                    value="submit"> {{ __('Update') }} </button>

                            <button type="button" class="primary-btn semi_large2 fix-gr-bg submitting" id="submit"
                                    disabled style="display: none;"> {{ __ ('Updating') }}...
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
            // getControlledFields($('#form_name').val());
            showHideFields($('#type').val());

            $(document).on('change', '#type', function () {
                showHideFields($(this).val());
            })

            $(document).on('change', '#controlled_field', function () {
                var field = $(this).val();
                if (field) {
                    $('#controlled_field_value').attr('disabled', false);
                    var form_name = $('#form_name').val();
                    $.ajax({
                        url: '{{ route('get_field_by_form_name_and_form_id') }}',
                        data: {
                            form_name: form_name,
                            field: field,
                            id : '{{ $model->id }}'
                        },
                        dataType: 'json',
                        success: function (data) {
                            let model = data.model;
                            let controlled_field_value_col = $('#controlled_field_value_col');

                            if (data.html) {
                                controlled_field_value_col.show();
                                controlled_field_value_col.html(data.html);
                            } else {
                                controlled_field_value_col.hide();
                                controlled_field_value_col.html('');
                            }
                            if (model.type === 'dropdown'){
                                $('#controlled_field_value').niceSelect()
                            }

                        },
                        error: function (data) {
                            ajax_error(data)
                        }
                    })
                } else {
                    $('#controlled_field_value_col').html('')
                }

            });

            $(document).on('change', '.controlled_field_value', function(){
                let type = $(this).attr('type');

                if (type == 'checkbox'){
                    $('.controlled_field_value').prop('checked', false);
                    $(this).prop('checked', true);
                }
            })

            $(document).on('change', '#form_name', function () {
                var form_name = $(this).val();
                if (form_name) {
                    getControlledFields(form_name);
                } else {
                    let child = $('#controlled_field');
                    child.html("<option value='' >{{ __('custom_fields.select_controlled_field') }}</option>");
                    child.trigger('change');
                    child.niceSelect('update');
                }

            });

            function getControlledFields(form_name) {
                $.ajax({
                    url: '{{ route('get_field_by_form_name') }}',
                    dataType: 'json',
                    data: {
                        form_name: form_name,
                        id : '{{ $model->id }}'
                    },
                    success: function (data) {
                        let child = $('#controlled_field');
                        child.html("<option value='' >" + data.select_text + "</option>");
                        $.each(data.models, function (i, v) {
                            child.append(
                                $('<option>', {
                                    value: v.id,
                                    text: v.title
                                })
                            );
                            if (data.controlled_field == v.id){
                                child.val(data.controlled_field)
                            }
                        })
                        child.trigger('change');
                        child.niceSelect('update');
                    },
                    error: function (data) {
                        ajax_error(data)
                    }
                })
            }

            function showHideFields(value){
                if (value == 'mask'){
                    $('#mask_column').show();
                    $('#pattern').attr('required', true);
                } else{
                    $('#mask_column').hide();
                    $('#pattern').attr('required', false);
                }

                if (value == 'checkbox' || value == 'radio' || value == 'dropdown'){
                    $('#values_row').show();
                    $('#values').attr('required', true);
                } else{
                    $('#values_row').hide();
                    $('#values').attr('required', false);
                }

                if (value == 'date' || value == 'checkbox' || value == 'dropdown' || value == 'radio' || value == "file" || value == 'mask'){
                    $('.max_min_col').hide();
                    $('.width_col').removeClass('col-md-4').addClass('col-12');
                } else{
                    $('.max_min_col').show();
                    $('.width_col').removeClass('col-12').addClass('col-md-4');
                }
            }
        });
    </script>
@endpush
