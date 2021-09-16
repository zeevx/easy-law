<div class="modal-dialog  modal-dialog-centered modal-lg">
    <div class="modal-content">


        <div class="modal-header">
            <h4 class="modal-title">{{ __('case.New Case Category') }}</h4>
            <button type="button" class="close " data-dismiss="modal">
                <i class="ti-close "></i>
            </button>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    {!! Form::open(['route' => 'category.case.store', 'class' => 'form-validate-jquery', 'id' => 'case_category_quick_add_form', 'files' => false, 'method' => 'POST']) !!}
                    <input type="hidden" name="quick_add" value="1">
                    <div class="primary_input">
                        {{Form::label('name', __('case.Name'),['class' => 'required'])}}
                        {{Form::text('name', null, ['required' => '', 'class' => 'primary_input_field', 'placeholder' => __('case.Case Category Name')])}}
                    </div>

                    <div class="primary_input">
                        {{Form::label('description', __('case.Description'))}}
                        {{Form::textarea('description', null, ['class' => 'primary_input_field', 'placeholder' =>
                         __('case.Case Category Description'), 'rows' => 5, 'maxlength' => 1500,
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
    _formValidation('#case_category_quick_add_form', true, 'case_category_add_modal');
</script>
