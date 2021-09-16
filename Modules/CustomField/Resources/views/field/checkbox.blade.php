<div class="{{ $field->width }}"
     @if($field->parent)
     id="controlled_field_{{$field->id}}"
     style="display: none;"
     data-controlled_field_value="{{ $field->controlled_field_value }}"
     @if($field->required) data-required="required" @endif
    @endif
>
    <div class="primary_input">
        <p class="{{ $field->required ? 'required' : '' }}">{{ $field->title }} @if($field->description)
                <i class="ti-help help_icon" data-toggle="tooltip" title="{!! $field->description !!}"></i>
            @endif</p>
        @php
        $field_values = explode(',', $field->values);
        $value = explode(',', $value);
        @endphp
        @foreach($field_values as $field_value)
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input custom_field" @if($field->childs) data-controlled_fields="{{ implode(',', $field->childs()->pluck('id')->toArray()) }}" @endif
                       name="custom_field[{{ $field->id }}][]"
                       id="custom_field_{{ $field->id }}_{{$loop->index}}"
                       @if(!$field->parent and $field->required)
                       required
                       @endif
                       value="{{ trim($field_value) }}"
                       @if($field->min) min="{{ $field->min }}" @endif
                       @if($field->max) max="{{ $field->max }}" @endif {{ in_array($field_value, $value) ? 'checked' : '' }}>
                {{ trim($field_value) }}
            </label>
        </div>
        @endforeach
    </div>
</div>
