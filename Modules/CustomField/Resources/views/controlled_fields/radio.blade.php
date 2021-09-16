<div class="primary_input">
    <label class="required d-block">
        {{ __('custom_fields.controlled_field_value') }}
    </label>
    @php
        $field_values = explode(',', $field->values)
    @endphp

    @foreach($field_values as $field_value)
        <div class="form-check d-inline mr-3">
            <label class="form-check-label">
                <input type="radio" class="form-check-input"
                       name="controlled_field_value"
                       id="controlled_field_value_{{ $field->id }}_{{$loop->index}}"
                       required
                       value="{{ trim($field_value) }}"
                       @if($field->min) min="{{ $field->min }}" @endif
                       @if($field->max) max="{{ $field->max }}" @endif {{ $field_value ==$value ? 'checked' : '' }}>
                {{ trim($field_value) }}
            </label>
        </div>
    @endforeach
</div>


