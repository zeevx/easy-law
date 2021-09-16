<div class="row">
    <div class="primary_input col-md-6">
        {{Form::label('name', __('finance.Tax Name'), ['class' => 'required'])}}
        {{Form::text('name', null, ['required' => '', 'class' => 'primary_input_field', 'placeholder' => __('finance.Tax Name')])}}
    </div>
    <div class="primary_input col-md-6">
        {{Form::label('rate', __('finance.Rate'), ['class' => 'required'])}}
        {{Form::text('rate', null, ['required' => '', 'class' => 'primary_input_field', 'placeholder' => __('finance.Rate')])}}
    </div>

    <div class="primary_input col-md-12">
        {{Form::label('description', __('finance.Description'))}}
        {{Form::text('description', null, ['class' => 'primary_textarea summernote', 'placeholder' => __('finance.Description')])}}
    </div>
</div>
