@php
$file = isset($file) ? 'customfield::details.'.$file : 'customfield::details.single_info';

@endphp

@foreach($customFields as $field)
    @if(@$field->field->parent)
        @if(@$field->field->parent->type == 'checkbox' and in_array(@$field->field->controlled_field_value, explode(',', @$field->field->parent->responses[0]->show_value)))
            @includeIf($file)
        @else
            @if(@$field->field->parent->responses[0]->show_value == @$field->field->controlled_field_value)
                @includeIf($file)
            @endif
        @endif
    @else
        @includeIf($file)
    @endif
@endforeach
