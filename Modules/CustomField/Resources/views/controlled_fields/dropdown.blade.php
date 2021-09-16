<div class="primary_input {{ $field->width }}">
    <label for="controlled_field_value" class="required">
        {{ __('custom_fields.controlled_field_value') }}
    </label>
    @php
        $field_values = explode(',', $field->values);
    @endphp

    <select name="controlled_field_value"
            id="controlled_field_value" class="primary_select" data-parsley-errors-container="#controlled_field_value_error">

        @foreach($field_values as $field_value)
            <option value="{{ trim($field_value) }}" @if($value == $field_value) selected @endif>{{ trim($field_value) }}</option>
        @endforeach
    </select>
    <span id="controlled_field_value_error"></span>
</div>
