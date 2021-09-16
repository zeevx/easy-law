<div class="row">
    <div class="primary_input col-md-6">
        {{Form::label('name', __('vendor.Vendor Name'), ['class' => 'required'])}}
        {{Form::text('name', null, ['required' => '', 'class' => 'primary_input_field', 'placeholder' => __('vendor.Vendor Name')])}}
    </div>
    <div class="primary_input col-md-6">
        {{Form::label('mobile', __('vendor.Vendor Mobile'))}}
        {{Form::text('mobile', null, ['class' => 'primary_input_field', 'placeholder' => __('vendor.Vendor Mobile')])}}
    </div>
</div>
<div class="row">
    <div class="primary_input col-md-6">
        {{Form::label('email', __('vendor.Vendor Email'))}}
        {{Form::email('email', null, ['class' => 'primary_input_field', 'placeholder' => __('vendor.Vendor Email')])}}
    </div>



    <div class="primary_input col-md-6">
        {{Form::label('country_id', __('vendor.Country'))}}
        {{Form::select('country_id', $countries, config('configs')->where('key','country_id')->first()->value, ['class' => 'primary_select', 'id' => 'country_id', 'data-placeholder' => __('vendor.Select country'),  'data-parsley-errors-container' => '#country_id_error'])}}
        <span id="country_id_error"></span>
    </div>

    <div class="primary_input col-md-6">
        {{Form::label('state_id', __('vendor.State'))}}
        {{Form::select('state_id', $states, null, ['class' => 'primary_select','id' => 'state_id', 'data-placeholder' => __('vendor.Select state'), 'data-parsley-errors-container' => '#state_id_error'])}}
        <span id="state_id_error"></span>
    </div>

    <div class="primary_input col-md-6">
        {{Form::label('city_id', __('vendor.City'))}}
        {{Form::select('city_id',$cities, null, ['class' => 'primary_select','id' => 'city_id', 'data-placeholder' => __('vendor.Select city'), 'data-parsley-errors-container' => '#city_id_error'])}}
        <span id="city_id_error"></span>
    </div>

</div>

<div class="primary_input">
    {{Form::label('address', __('vendor.Vendor Address'))}}
    {{Form::textarea('address', null, ['class' => 'primary_input_field', 'placeholder' => __('vendor.Vendor Address'), 'rows' => 3])}}
</div>
@includeIf('customfield::fields', ['fields' => $fields, 'model' => (isset($model) ? $model : null)])
<div class="primary_input">
    {{Form::label('description', __('vendor.Description'))}}
    {{Form::textarea('description', null, ['class' => 'primary_input_field summernote', 'placeholder' => __('vendor.Vendor Description'), 'rows' => 5, 'maxlength' => 1500, 'data-parsley-errors-container' =>
    '#description_error' ])}}
    <span id="description_error"></span>
</div>

