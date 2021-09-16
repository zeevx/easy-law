<div class="modal-dialog  modal-dialog-centered modal-lg">
    <div class="modal-content">


        <div class="modal-header">
            <h4 class="modal-title">{{ __('court.New Court') }}</h4>
            <button type="button" class="close " data-dismiss="modal">
                <i class="ti-close "></i>
            </button>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    {!! Form::open(['route' => 'master.court.store', 'class' => 'form-validate-jquery', 'id' => 'court_quick_add_form', 'files' => false, 'method' => 'POST']) !!}
                    <input type="hidden" name="quick_add" value="1">

                    <div class="row">
                        <div class="primary_input col-md-4">
                            {{Form::label('country_id', __('court.Country'))}}
                            {{Form::select('country_id', $countries, config('configs')->where('key','country_id')->first()->value, ['class' => 'primary_select', 'id' => 'country_id', 'data-placeholder' => __('court.Select country'),  'data-parsley-errors-container' => '#country_id_error'])}}
                            <span id="country_id_error"></span>
                        </div>

                        <div class="primary_input col-md-4">
                            {{Form::label('state_id', __('court.State'))}}
                            {{Form::select('state_id', $states, null, ['class' => 'primary_select','id' => 'state_id', 'data-placeholder' => __('court.Select state'), 'data-parsley-errors-container' => '#state_id_error'])}}
                            <span id="state_id_error"></span>
                        </div>

                        <div class="primary_input col-md-4">
                            {{Form::label('city_id', __('court.City'))}}
                            {{Form::select('city_id',[''=> __('common.Select State First')], null, ['class' => 'primary_select','id' => 'city_id', 'data-placeholder' => __('court.Select city'), 'data-parsley-errors-container' => '#city_id_error'])}}
                            <span id="city_id_error"></span>
                        </div>

                    </div>
                    <div class="row">

                        <div class="primary_input col-md-6">
                            {{Form::label('court_category_id', __('court.Court Category'))}}
                            {{Form::select('court_category_id', $court_categories, $court_category_id, ['class' => 'primary_select', 'data-placeholder' => __('court.Court Category'), 'data-parsley-errors-container' => '#court_category_error', 'disabled'])}}
                            <span id="court_category_error"></span>
                        </div>
                        <div class="primary_input col-md-6">
                            {{Form::label('location', __('court.Location/ Police Station'))}}
                            {{Form::text('location', null, ['class' => 'primary_input_field', 'placeholder' => __('court.Location/ Police Station')])}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="primary_input col-md-6">
                            {{Form::label('name', __('court.Court Name'),['class' => 'required'])}}
                            {{Form::text('name', null, ['required' => '', 'class' => 'primary_input_field', 'placeholder' => __('court.Court Name')])}}
                        </div>
                        <div class="primary_input col-md-6">
                            {{Form::label('room_number', __('court.Court Room Number'))}}
                            {{Form::text('room_number', null, ['class' => 'primary_input_field', 'placeholder' => __('court.Court Room Number')])}}
                        </div>
                    </div>
                    @if(moduleStatusCheck('EmailtoCL'))
                        <div class="row">

                            <div class="primary_input  col-12">
                                {{Form::label('email', __('case.Email'))}}
                                {{Form::email('email', null, [ 'class' => 'primary_input_field', 'placeholder' => __('case.Email')])}}
                            </div>

                        </div>
                    @endif
                    @includeIf('customfield::fields', ['fields' => $fields, 'model' => null])
                    <div class="primary_input">
                        {{Form::label('description', __('court.Description'))}}
                        {{Form::textarea('description', null, ['class' => 'primary_input_field summernote', 'placeholder' => __('court.Court  Description'), 'rows' => 5, 'maxlength' => 1500, 'data-parsley-errors-container' =>
                        '#description_error' ])}}
                        <span id="description_error"></span>
                    </div>

                    <input type="hidden" name="court_category_id" value="{{ $court_category_id }}">
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
        _formValidation('#court_quick_add_form', true, 'court_add_modal');
    </script>
