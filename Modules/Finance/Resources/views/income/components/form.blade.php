<div class="row">
    <div class="primary_input col-md-6">
        {{Form::label('title', __('finance.Income Title'), ['class' => 'required'])}}
        {{Form::text('title', null, ['required' => '', 'class' => 'primary_input_field', 'placeholder' => __('finance.Income Title')])}}
    </div>

    <div class="primary_input col-md-6">
        <div class="d-flex justify-content-between">
            {{Form::label('income_type', __('finance.Income Type'), ['class' => 'required'])}}
            @if(permissionCheck('services.store'))
                <label class="primary_input_label green_input_label" for="income_type">
                    <a href="{{ route('income_types.create', ['quick_add' => true]) }}"
                       class="btn-modal"
                       data-container="income_type_add">{{ __('finance.New Income Type') }}
                        <i class="fas fa-plus-circle"></i></a></label>
            @endif
        </div>
        {{Form::select('income_type', $service_types,  ((isset($model) and $model) ? $model->morphable_id : null), ['required' => '', 'class' => 'primary_select', 'data-parsley-errors-container' => '#income_type_error', 'id' => 'income_type'])}}
        <span id="income_type_error"></span>
    </div>

    <div class="primary_input col-md-6">
        {{Form::label('payment_method', __('finance.Payment Method'), ['class' => 'required'])}}
        {{Form::select('payment_method', $payment_methods,  null, ['required' => '', 'class' => 'primary_select', 'data-parsley-errors-container' => '#payment_method_error'])}}
        <span id="payment_method_error"></span>
    </div>

    <div class="primary_input col-md-6" id="bank_column">
        {{Form::label('bank_account_id', __('finance.Bank Account'), ['class' => 'required'])}}
        {{Form::select('bank_account_id', $bank_accounts,  null, ['required' => '', 'class' => 'primary_select', 'data-parsley-errors-container' => '#bank_account_id_error'])}}
        <span id="bank_account_id_error"></span>
    </div>

    <div class="primary_input col-md-6">
        {{Form::label('amount', __('finance.Income Amount'), ['class' => 'required'])}}
        {{Form::text('amount', null, ['required' => '', 'class' => 'primary_input_field', 'placeholder' => __('finance.Income Amount')])}}
    </div>
    <div class="primary_input col-md-6">
        {{Form::label('transaction_date', __('finance.Transaction Date'), ['class' => 'required'])}}
        {{Form::text('transaction_date', (isset($model) and $model->transaction_date) ? $model->transaction_date :date('Y-m-d'), ['required' => '','class' => 'primary_input_field primary-input date form-control date', 'placeholder' => __('finance.Transaction Date')])}}

    </div>

    <div class="col-md-6">
        <div class="primary_input mb-15">
            <label class="primary_input_label" for="">{{ __('common.File') }}</label>
            <div class="primary_file_uploader">
                <input class="primary-input" type="text" id="placeholderFileTwoName" placeholder="{{ __('common.Browse file') }}"
                       readonly="">
                <button class="" type="button">
                    <label class="primary-btn small fix-gr-bg" for="document_file_2">{{ __('common.Browse') }}</label>
                    <input type="file" class="d-none" name="file" id="document_file_2">
                </button>
            </div>
        </div>
    </div>
</div>

@includeIf('customfield::fields', ['fields' => $fields, 'model' => $model ?? null])
<div class="row">

    <div class="primary_input col-md-12">
        {{Form::label('description', __('finance.Description'))}}
        {{Form::textarea('description', null, ['class' => 'primary_input_field summernote', 'placeholder' => __('finance.Description')])}}
    </div>
</div>



