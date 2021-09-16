<div class="row">
    <div class="col-md-6">
        <div class="primary_input">
            {{Form::label('form_name', __('custom_fields.form_name'), ['class' => 'required'])}}
            {{Form::select('form_name', $forms, null, ['class' => 'primary_select', 'data-parsley-errors-container' => '#custom_fields_form_name_error'])}}
            <span id="custom_fields_form_name_error"></span>
        </div>
    </div>

    <div class="col-md-6">
        <div class="primary_input">
            {{Form::label('type', __('custom_fields.type'), ['class' => 'required'])}}
            {{Form::select('type', $field_types, null, ['class' => 'primary_select', 'data-parsley-errors-container' => '#custom_fields_type_error'])}}
            <span id="custom_fields_type_error"></span>
        </div>
    </div>
</div>


<div class="row">
    <div class="primary_input col-md-6">
        {{Form::label('title', __('custom_fields.title'), ['class' => 'required'])}}
        {{Form::text('title', null, ['required' => '','class' => 'primary_input_field required', 'placeholder' => __('custom_fields.title')])}}
    </div>
    <div class="primary_input col-md-6">
        {{Form::label('default_value', __('custom_fields.default_value'))}}
        {{Form::text('default_value', null, ['class' => 'primary_input_field ', 'placeholder' => __('custom_fields.default_value')])}}
    </div>
    <div class="primary_input col-md-12" id="mask_column" style="display: none;">
        {{Form::label('pattern', __('custom_fields.pattern'), ['class' => 'required'])}}
        {{Form::text('pattern', null, ['class' => 'primary_input_field ', 'placeholder' => __('custom_fields.pattern')])}}
    </div>
    <div class="primary_input col-md-4 max_min_col">
        {{Form::label('min', __('custom_fields.min'))}}
        {{Form::number('min', null, ['class' => 'primary_input_field', 'placeholder' => __('custom_fields.min')])}}
    </div>
    <div class="primary_input col-md-4 max_min_col">
        {{Form::label('max', __('custom_fields.max'))}}
        {{Form::number('max', null, ['class' => 'primary_input_field', 'placeholder' => __('custom_fields.max')])}}
    </div>
    <div class="primary_input col-md-4 width_col">
        {{Form::label('width', __('custom_fields.width'), ['class' => 'required'])}}
        {{Form::select('width', $field_widths, null, ['class' => 'primary_select'])}}
    </div>
</div>
<div class="row" style="display: none;" id="values_row">
    <div class="col-12">
        <div class="primary_input">
            <label for="values" class="required">
                {{ __('custom_fields.values') }}
                <small>{{ __('custom_fields.use_comma_or_press_enter_for_separate_values') }}</small>
            </label>
            <div class="tagInput_field">
                {{Form::text('values', null, ['class' => 'sr-only', 'placeholder' => __('custom_fields.values'), 'data-role' => 'tagsinput', 'id' => 'values' ])}}
            </div>

        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-6">
        <div class="primary_input">
            <label for="controlled_field">
                {{ __('custom_fields.controlled_field') }}
            </label>
            {{ Form::select('controlled_field', $controlled_fields, null, ['class' => 'primary_select', 'id' => 'controlled_field' ]) }}

        </div>
    </div>

    <div class="col-md-6" id="controlled_field_value_col" @isset($model) @else style="display: none;" @endif>
        @isset($model)
            @if($model->parent)
                @php
                    if (in_array($model->parent->type, ['radio', 'dropdown', 'checkbox'])){
                           $field = $model->parent->type;
                       } else{
                            $field = 'text';
                       }
                @endphp
                @include('customfield::controlled_fields.'.$field, ['field' => $model->parent, 'value' => $model->controlled_field_value])
            @endif
        @endif
    </div>
</div>


<div class="row">
    <div class="col-6">
        <div class="primary_input">
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="required"
                           id="required" value="1" {{ (isset($model) and $model->required) ? 'checked' : '' }}>
                    {{ __('custom_fields.required') }}
                </label>
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="primary_input">
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="status"
                           id="status" value="1" {{ (isset($model) and !$model->status) ? '' : 'checked' }}>
                    {{ __('custom_fields.active') }}
                </label>
            </div>
        </div>
    </div>
</div>
<div class="primary_input">
    {{Form::label('description', __('custom_fields.description'))}}
    {{Form::textarea('description', null, ['class' => 'primary_textarea', 'placeholder' => __('custom_fields.description'), 'rows' => 3, 'data-parsley-errors-container' =>
    '#description_error' ])}}
    <span id="description_error"></span>
</div>
