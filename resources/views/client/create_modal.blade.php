<div class="modal-dialog  modal-dialog-centered modal-lg">
    <div class="modal-content">


        <div class="modal-header">
            <h4 class="modal-title">{{ __('case.New '.($plaintiff ? 'Plaintiff' : 'Accused')) }}</h4>
            <button type="button" class="close " data-dismiss="modal">
                <i class="ti-close "></i>
            </button>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    {!! Form::open(['route' => 'client.store', 'class' => 'form-validate-jquery', 'id' => 'client_quick_add_form', 'files' => false, 'method' => 'POST']) !!}
                    <input type="hidden" name="quick_add" value="1">
                    <input type="hidden" name="plaintiff" value="{{ $plaintiff }}">
                    <div class="row">
                        <div class="primary_input col-md-6">
                            {{Form::label('name', __('client.Client Name'), ['class' => 'required'])}}
                            {{Form::text('name', null, ['required' => '', 'class' => 'primary_input_field', 'placeholder' => __('client.Client Name')])}}
                        </div>
                        <div class="primary_input col-md-6">
                            {{Form::label('mobile', __('client.Client Mobile'))}}
                            {{Form::text('mobile', null, ['class' => 'primary_input_field', 'placeholder' => __('client.Client Mobile')])}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="primary_input col-md-6">
                            {{Form::label('email', __('client.Client Email'), ['class' => ($enable_login ? 'required' : '')])}}
                            {{Form::email('email', null, ['class' => 'primary_input_field', 'placeholder' => __('client.Client Email'), ($enable_login ? 'required' : '')])}}
                        </div>
                        @if($enable_login)
                            <div class="primary_input col-md-6">
                                {{Form::label('password', __('client.Password'), ['class' => ($enable_login ? 'required' : '')])}}
                                {{Form::text('password', null, ['class' => 'primary_input_field', 'placeholder' => __('client.Password'), ($enable_login ? 'required' : ''), 'min' => 8])}}
                            </div>
                        @endif

                    </div>


                    <div class="row">
                        <div class="primary_input col-md-6">
                            {{Form::label('gender', __('client.Gender'))}}
                            {{Form::select('gender', ['Male' => 'Male', 'FeMale' => 'FeMale'], null, ['class' => 'primary_select', 'data-placeholder' => __('client.Select Gender'), 'data-parsley-errors-container' => '#gender_error'])}}
                            <span id="gender_error"></span>
                        </div>
                        <div class="primary_input col-md-6">
                            <div class="d-flex justify-content-between">
                                {{Form::label('client_category_id', __('client.Client Category'))}}

                            </div>
                            {{Form::select('client_category_id', $client_categories, null, ['class' => 'primary_select', 'data-placeholder' => __('client.Select Division'),  'data-parsley-errors-container' => '#client_category_id_error'])}}
                            <span id="client_category_id_error"></span>
                        </div>

                    </div>

                    <div class="row">

                        <div class="primary_input col-md-4">
                            {{Form::label('country_id', __('client.Country'))}}
                            {{Form::select('country_id', $countries, config('configs')->where('key','country_id')->first()->value, ['class' => 'primary_select', 'id' => 'country_id', 'data-placeholder' => __('client.Select country'),  'data-parsley-errors-container' => '#country_id_error'])}}
                            <span id="country_id_error"></span>
                        </div>

                        <div class="primary_input col-md-4">
                            {{Form::label('state_id', __('client.State'))}}
                            {{Form::select('state_id', $states, null, ['class' => 'primary_select','id' => 'state_id', 'data-placeholder' => __('client.Select state'), 'data-parsley-errors-container' => '#state_id_error'])}}
                            <span id="state_id_error"></span>
                        </div>

                        <div class="primary_input col-md-4">
                            {{Form::label('city_id', __('client.City'))}}
                            {{Form::select('city_id',[''=> __('common.Select State First')], null, ['class' => 'primary_select','id' => 'city_id', 'data-placeholder' => __('client.Select city'), 'data-parsley-errors-container' => '#city_id_error'])}}
                            <span id="city_id_error"></span>
                        </div>

                    </div>


                    <div class="primary_input">
                        {{Form::label('address', __('client.Client Address'))}}
                        {{Form::textarea('address', null, ['class' => 'primary_input_field', 'placeholder' => __('client.Client Address'), 'rows' => 3])}}
                    </div>

                    @includeIf('customfield::fields', ['fields' => $fields, 'model' => null])

                    <div class="primary_input">
                        {{Form::label('description', __('client.Description'))}}
                        {{Form::textarea('description', null, ['class' => 'primary_input_field summernote', 'placeholder' => __('client.Client Description'), 'rows' => 5, 'maxlength' => 1500, 'data-parsley-errors-container' =>
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
    _formValidation('#client_quick_add_form', true, 'client_add_modal');
</script>
