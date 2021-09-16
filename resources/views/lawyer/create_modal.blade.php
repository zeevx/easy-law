<div class="modal-dialog  modal-dialog-centered modal-lg">
    <div class="modal-content">


        <div class="modal-header">
            <h4 class="modal-title">{{ __('lawyer.Add lawyer') }}</h4>
            <button type="button" class="close " data-dismiss="modal">
                <i class="ti-close "></i>
            </button>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    {!! Form::open(['route' => 'lawyer.store', 'class' => 'form-validate-jquery', 'id' => 'lawyer_quick_add_form', 'files' => false, 'method' => 'POST']) !!}
                    <input type="hidden" name="quick_add" value="1">
                    <div class="primary_input">
                        {{Form::label('name', __('lawyer.Name'),['class' => 'required'])}}
                        {{Form::text('name', null, ['required' => '', 'class' => 'primary_input_field', 'placeholder' => __
                        ('lawyer.Name')])}}
                    </div>
                    <div class="primary_input">
                        {{Form::label('mobile_no', __('lawyer.Mobile No'),['class' => 'required'] )}}
                        {{Form::number('mobile_no', null, ['required' => '', 'class' => 'primary_input_field', 'placeholder' => __('lawyer.Lawyer Mobile No')])}}
                    </div>

                    @if(moduleStatusCheck('EmailtoCL'))
                        <div class="primary_input">
                            {{Form::label('email', __('case.Email'))}}
                            {{Form::email('email', null, ['class' => 'primary_input_field', 'placeholder' => __('case.Email')])}}
                        </div>
                    @endif

                    @includeIf('customfield::fields', ['fields' => $fields, 'model' => null])

                    <div class="primary_input">
                        {{Form::label('description', __('lawyer.Description'))}}
                        {{Form::textarea('description', null, ['class' => 'primary_textarea summernote', 'placeholder' =>
                        __('lawyer.Lawyer Description'), 'rows' => 15, 'maxlength' => 1500,
                        'data-parsley-errors-container' =>
                        '#description_error' ])}}
                        <span id="description_error"></span>
                    </div>

                    <div class="text-center mt-3">
                        <button class="primary_btn_large submit" type="submit"><i
                                class="ti-check"></i>{{ __('common.Create') }}
                        </button>

                        <button class="primary_btn_large submitting" type="submit" disabled style="display: none;">
                            <i class="ti-check"></i>{{ __('common.Creating') . '...' }}
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    _formValidation('#lawyer_quick_add_form', true, 'lawyer_add_modal');
</script>
