<div class="row">
    <div class="primary_input col-md-4">
        {{Form::label('name', __('finance.Service Name'), ['class' => 'required'])}}
        {{Form::text('name', null, ['required' => '', 'class' => 'primary_input_field', 'placeholder' => __('finance.Service Name')])}}
    </div>
    <div class="primary_input col-md-4">
        {{Form::label('charge', __('finance.Service Charge'))}}
        {{Form::number('charge', null, ['class' => 'primary_input_field', 'placeholder' => __('finance.Service Charge')])}}
    </div>
    <div class="primary_input col-md-4">
        {{Form::label('description', __('finance.Description'))}}
        {{Form::text('description', null, ['class' => 'primary_input_field', 'placeholder' => __('finance.Description')])}}
    </div>
</div>
