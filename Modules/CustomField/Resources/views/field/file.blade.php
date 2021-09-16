<div class="{{ $field->width }}"
     @if($field->parent)
     id="controlled_field_{{$field->id}}"
     style="display: none;"
     data-controlled_field_value="{{ $field->controlled_field_value }}"
     @if($field->required) data-required="required" @endif
    @endif
>
    <div class="primary_input mb-15">
        <label class="primary_input_label {{ $field->required ? 'required' : '' }}" for="custom_field_{{ $field->id }}">
            {{ $field->title }}
            @if($value)
                <small><a href='{{ $value}}' download target='_blank'> {{ __('common.Download') }} </a></small>
            @endif
            @if($field->description)
                <i class="ti-help help_icon" data-toggle="tooltip" title="{!! $field->description !!}"></i>
            @endif

        </label>
        <div class="primary_file_uploader">
            <input class="primary-input" type="text" id="custom_field_{{ $field->id }}_placeholder"
                   placeholder="{{ __('common.Browse file') }}" readonly>
            <button class="" type="button">
                <label class="primary-btn small fix-gr-bg"
                       for="custom_field_{{ $field->id }}">{{__("common.Browse")}} </label>
                <input type="file" class="d-none custom_field" name="custom_field[{{ $field->id }}]"
                       id="custom_field_{{ $field->id }}"
                       @if(!$field->parent and $field->required)
                       required
                       @endif
                       data-parsley-errors-container="#custom_field_{{ $field->id }}_error"
                       onchange="getFileName(this.value, '#custom_field_{{ $field->id }}_placeholder')">
            </button>
        </div>
        <span id="custom_field_{{ $field->id }}_error"></span>
    </div>
</div>
