<div class="modal-dialog  modal-dialog-centered modal-lg">
    <div class="modal-content">


        <div class="modal-header">
            <h4 class="modal-title">{{ __('contact.Add Contact') }}</h4>
            <button type="button" class="close " data-dismiss="modal">
                <i class="ti-close "></i>
            </button>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    {!! Form::open(['route' => 'contact.store', 'class' => 'form-validate-jquery', 'id' => 'contact_quick_add_form', 'files' => false, 'method' => 'POST']) !!}
                    <input type="hidden" name="quick_add" value="1">
                    <div class="row">
                        <div class="primary_input col-md-12">

                            <div class="d-flex justify-content-between">
                                {{Form::label('contact_category_id', __('contact.Category'))}}

                            </div>
                            {{Form::select('contact_category_id', $contact_categories, null, ['class' => 'primary_select', 'data-parsley-errors-container' => '#contact_category_id_error'])}}
                            <span id="contact_category_id_error"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="primary_input col-md-12">
                            {{Form::label('name', __('contact.Name'), ['class' => 'required'])}}
                            {{Form::text('name', null, ['required' => '','class' => 'primary_input_field required', 'placeholder' => __('contact.Name')])}}
                        </div>
                        <div class="primary_input col-md-6">
                            {{Form::label('mobile_no', __('contact.Mobile No'))}}
                            {{Form::number('mobile_no', null, ['class' => 'primary_input_field ', 'placeholder' => __('contact.Mobile No')])}}
                        </div>
                        <div class="primary_input col-md-6">
                            {{Form::label('email', __('contact.Email'))}}
                            {{Form::email('email', null, ['class' => 'primary_input_field', 'placeholder' => __('contact.Email')])}}
                        </div>
                    </div>

                    @includeIf('customfield::fields', ['fields' => $fields, 'model' => null])
                    <div class="primary_input">
                        {{Form::label('description', __('contact.Description'))}}
                        {{Form::textarea('description', null, ['class' => 'primary_input_field summernote', 'placeholder' => __('contact.Contact Description'), 'rows' => 5, 'data-parsley-errors-container' =>
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
    _formValidation('#contact_quick_add_form', true, 'contact_add_modal');
</script>
