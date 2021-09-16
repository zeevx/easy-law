<div class="primary_input">
    <label for="controlled_field_value" class="required">
        {{ __('custom_fields.controlled_field_value') }}
    </label>
    {{Form::text('controlled_field_value', null, ['class' => 'primary_input_field', 'placeholder' => __('custom_fields.controlled_field_value'), 'id' => 'controlled_field_value', 'required' ])}}

</div>
