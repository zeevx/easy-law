@if($fields and $fields->count() > 0)
<!--    <div class="col-xl-12 mt-2">
        <div class="main-title d-flex">
            <h3 class="mb-0 mr-30">{{ __('custom_fields.more_info') }}</h3>
        </div>
    </div>
    <hr>-->
    <div class="row">
        @foreach($fields as $field)
            @php
                $value = $field->default_value;
                 if($model){
                     $model_field = $model->customFields()->where('custom_field_id', $field->id)->first();
                     if ($model_field) {
                         $value = $model_field->value;
                     }
                 }
            @endphp
            @includeIf('customfield::field.'.$field->type, ['field' => $field, 'value' => $value])

            @if($field->childs)
                @foreach($field->childs as $field)
                    @php
                        $value = $field->default_value;
                         if($model){
                             $model_field = $model->customFields()->where('custom_field_id', $field->id)->first();
                             if ($model_field) {
                                 $value = $model_field->value;
                             }
                         }
                    @endphp
                    @includeIf('customfield::field.'.$field->type, ['field' => $field, 'value' => trim($value)])
                @endforeach
            @endif

        @endforeach
    </div>
@endif
