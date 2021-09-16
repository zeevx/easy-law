<div class="primary_input {{ $field->width }}"
     @if($field->parent)
     id="controlled_field_{{$field->id}}"
     style="display: none;"
     data-controlled_field_value="{{ $field->controlled_field_value }}"
     @if($field->required) data-required="required" @endif
    @endif
>
    <label for="custom_field_{{ $field->id }}" class="{{ $field->required ? 'required' : '' }}">
        {{ $field->title }}
        @if($field->description)
            <i class="ti-help help_icon" data-toggle="tooltip" title="{!! $field->description !!}"></i>
        @endif
    </label>
    <textarea
        class="primary_textarea custom_field"
        name="custom_field[{{ $field->id }}]"
        id="custom_field_{{ $field->id }}"
        @if(!$field->parent and $field->required)
        required
        @endif
        @if($field->childs) data-controlled_fields="{{ implode(',', $field->childs()->pluck('id')->toArray()) }}" @endif
        placeholder="{{ $field->title }}"
        @if($field->min) minlength="{{ $field->min }}" @endif
        @if($field->max) maxlength="{{ $field->max }}" @endif
        data-parsley-errors-container="#custom_field_{{ $field->id }}_error"
    >{{ $value }}</textarea>
    <span id="custom_field_{{ $field->id }}_error"></span>
</div>
