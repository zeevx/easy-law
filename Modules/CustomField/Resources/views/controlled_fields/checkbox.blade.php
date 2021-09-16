
    <div class="primary_input">
        <label class="required d-block">
            {{ __('custom_fields.controlled_field_value') }}
        </label>
        @php
        $field_values = explode(',', $field->values);
        $value = explode(',', $value);
        @endphp
        @foreach($field_values as $field_value)
        <div class="form-check d-inline mr-3">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input controlled_field_value"
                       name="controlled_field_value"
                       id="controlled_field_value_{{ $field->id }}_{{$loop->index}}"
                       @if($field->required) required @endif
                       value="{{ trim($field_value) }}"
                        {{ in_array($field_value, $value) ? 'checked' : '' }}>
                {{ trim($field_value) }}
            </label>
        </div>
        @endforeach
    </div>

