<div class="row">
    <div class="primary_input col-md-12">
        {{Form::label('bank_name', __('finance.bank_name'), ['class' => 'required'])}}
        {{Form::text('bank_name', null, ['required' => '', 'class' => 'primary_input_field', 'placeholder' => __('finance.bank_name')])}}
    </div>
    <div class="primary_input col-md-6">
        {{Form::label('branch_name', __('finance.branch_name'), ['class' => 'required'])}}
        {{Form::text('branch_name', null, ['required' => '', 'class' => 'primary_input_field', 'placeholder' => __('finance.branch_name')])}}
    </div>
    <div class="primary_input col-md-6">
        {{Form::label('account_name', __('finance.account_name'), ['class' => 'required'])}}
        {{Form::text('account_name', null, ['required' => '', 'class' => 'primary_input_field', 'placeholder' => __('finance.account_name')])}}
    </div>

    <div class="primary_input col-md-6">
        {{Form::label('account_number', __('finance.account_number'), ['class' => 'required'])}}
        {{Form::text('account_number', null, ['required' => '', 'class' => 'primary_input_field', 'placeholder' => __('finance.account_number')])}}
    </div>

    <div class="primary_input col-md-6">
        {{Form::label('opening_balance', __('finance.opening_balance'))}}
        {{Form::text('opening_balance', null, [ 'class' => 'primary_input_field', 'placeholder' => __('finance.opening_balance')])}}
    </div>
</div>
@includeIf('customfield::fields', ['fields' => $fields, 'model' => $model ?? null])
<div class="row">
    <div class="primary_input col-md-12">
        {{Form::label('description', __('finance.Description'))}}
        {{Form::text('description', null, ['class' => 'primary_textarea summernote', 'placeholder' => __('finance.Description')])}}
    </div>
</div>


