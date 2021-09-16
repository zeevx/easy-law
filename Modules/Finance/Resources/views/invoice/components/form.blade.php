<div class="row">
    <input type="hidden" name="clientable_type" value="{{ $clientable_type }}">
    <input type="hidden" name="invoice_type" value="{{ $invoice_type }}" id="invoice_type">
    <input type="hidden" id="row" value="{{ isset($model) ? (count($model->items) + 1) : 1 }}">

    <div class="primary_input col-md-4">
        {{Form::label('clientable_id', __('finance.'.ucfirst($client_type)), ['class' => 'required'])}}
        {{Form::select('clientable_id', $clients,  null, ['required' => '', 'class' => 'primary_select', 'data-parsley-errors-container' => '#clientable_id_error'])}}
        <span id="clientable_id_error"></span>
    </div>

    @if($invoice_type == 'income')
        <div class="primary_input col-md-4" id="case_column">
            {{Form::label('case_id', __('finance.Select Case'))}}
            {{Form::select('case_id', $cases,  null, ['class' => 'primary_select', 'data-parsley-errors-container' => '#case_id_error'])}}
            <span id="case_id_error"></span>
        </div>
    @endif

    <div class="primary_input col-md-4">
        {{Form::label('invoice_no', __('finance.Invoice No'), ['class' => 'required'])}}
        {{Form::text('invoice_no', (isset($model) and $model->invoice_no) ? $model->invoice_no : $invoice_no, ['required', 'class' => 'primary_input_field primary-input form-control', 'placeholder' => __('finance.Invoice No')])}}
    </div>

    <div class="primary_input col-md-4">
        {{Form::label('invoice_date', __('finance.Invoice Date'), ['class' => 'required'])}}
        {{Form::text('invoice_date', (isset($model) and $model->due_date) ? $model->due_date :date('Y-m-d'), ['required' => '','class' => 'primary_input_field primary-input date form-control date', 'placeholder' => __('finance.Invoice Date')])}}
    </div>

    <div class="primary_input col-md-4">
        {{Form::label('due_date', __('finance.Due Date'))}}
        {{Form::text('due_date', (isset($model) and $model->due_date) ? $model->due_date :date('Y-m-d'), ['required' => '','class' => 'primary_input_field primary-input date form-control date', 'placeholder' => __('finance.Due Date')])}}
    </div>

    <div class="primary_input col-md-4">
        {{Form::label('discount_type', __('finance.Discount Type'))}}
        {{Form::select('discount_type', $discount_type,  null, ['class' => 'primary_select', 'data-parsley-errors-container' => '#discount_type_error'])}}
        <span id="discount_type_error"></span>
    </div>

    <div class="primary_input col-md-4">
        {{Form::label('discount', __('finance.Discount'))}}
        {{Form::text('discount', (isset($model) and $model->discount) ? $model->discount : 0, ['class' => 'primary_input_field primary-input form-control input_number', 'placeholder' => __('finance.Due Date')])}}
    </div>

    <div class="primary_input col-md-4">
        {{Form::label('tax_id', __('finance.Tax'))}}
        {{Form::select('tax_id', $taxes,  (isset($model) and $model->tax_id) ? ($model->tax_id.'-'.number_format($model->tax, 2)) : null, ['class' => 'primary_select', 'data-parsley-errors-container' => '#tax_id_error', 'id' => 'tax_id'])}}
        <span id="tax_id"></span>
    </div>

    <div class="primary_input col-md-4">
        <div class="d-flex justify-content-between">
            {{Form::label('service_type', __('finance.'.ucfirst($invoice_type == 'income' ? 'service' : 'expense').' Type'))}}
            @if(permissionCheck(($invoice_type == 'income' ? 'services' : 'expense_types').'.store'))
                <label class="primary_input_label green_input_label" for="">
                    <a href="{{ route(($invoice_type == 'income' ? 'services' : 'expense_types').'.create', ['quick_add' => true]) }}"
                       class="btn-modal"
                       data-container="service_type_add">{{ __('New '. ucfirst($invoice_type == 'income' ? 'service' : 'expense')) }}
                        <i class="fas fa-plus-circle"></i></a></label>
            @endif
        </div>

        {{Form::select('service_type', $service_types,  null, ['class' => 'primary_select', 'data-parsley-errors-container' => '#service_type_error'])}}
        <span id="service_type_error"></span>
    </div>
    @if(!isset($model))
        <div class="primary_input {{ $invoice_type == 'income' ? 'col-md-12' : 'col-md-4' }} " id="method_column"
             data-old_class="{{ $invoice_type == 'income' ? 'col-md-12' : 'col-md-4' }}"
             data-new_class="{{ $invoice_type == 'income' ? 'col-md-6' : 'col-md-4' }}">
            {{Form::label('payment_method', __('finance.Payment Method'))}}
            {{Form::select('payment_method', $payment_methods,  null, ['class' => 'primary_select', 'data-parsley-errors-container' => '#payment_method_error', 'id' => 'payment_method'])}}
            <span id="payment_method_error"></span>
        </div>

        <div class="primary_input {{ $invoice_type == 'income' ? 'col-md-6' : 'col-md-12' }}" id="bank_column"
             style="display: none;">
            {{Form::label('bank_account_id', __('finance.Bank Account'))}}
            {{Form::select('bank_account_id', $bank_accounts,  null, ['class' => 'primary_select', 'data-parsley-errors-container' => '#bank_account_id_error'])}}
            <span id="bank_account_id_error"></span>
        </div>
    @endif


</div>

<div class="row mt-5">

    <div class="col-lg-12">
        <table class="table product_table">
            <thead>
            <tr>
                <th width="30%">{{ $invoice_type == 'income' ? 'service' : 'expense' }}</th>
                <th width="30%">{{ __('finance.Description') }}</th>
                <th width="10%">{{ __('finance.Qty/Hr') }}</th>
                <th width="10%">{{ __('finance.Unit Price') }}</th>
                <th width="15%">{{ __('finance.Sub Total') }}</th>
                <th width="5%">{{ __('common.Action') }}</th>
            </tr>
            </thead>
            <tbody id="service_row">

            @isset($model)
                @forelse ( $model->items as $key => $item )
                    @includeIf('finance::invoice.edit_item_row', ['item' => $item, 'row' => $key + 1])
                @empty
                    <tr id="row_0">
                        <td colspan="6"
                            class="text-center"> {{ __('finance.Please Select '.ucfirst($invoice_type == 'income' ? 'service' : 'expense').' to add.') }}</td>
                    </tr>
                @endforelse
            @else
                <tr id="row_0">
                    <td colspan="6"
                        class="text-center"> {{ __('finance.Please Select '.ucfirst($invoice_type == 'income' ? 'service' : 'expense').' to add.') }}</td>
                </tr>
            @endisset

            </tbody>

        </table>
    </div>
    <div class="col-12">
        <div class="row justify-content-end">
            @if(isset($model) and count($model->transactions))
                <div class="col-lg-8 col-md-6">
                    @includeIf('finance::invoice.payment_table')
                </div>
            @endif
            <div class="col-lg-4 col-md-6">
                <div class="primary_input grid_input">
                    <label class="font_13 theme_text f_w_500 mb-0"
                           for="sub_total">{{__('finance.SubTotal')}}</label>
                    <input type="text" id="sub_total" placeholder="{{__('finance.SubTotal')}}"
                           class="primary_input_field sub_total input_number"
                           value="{{ (isset($model) and $model->sub_total) ? $model->sub_total : 0 }}" name="sub_total"
                           readonly="readonly">

                </div>

                <div class="primary_input grid_input">
                    <label class="font_13 theme_text f_w_500 mb-0"
                           for="discount_amount">{{__('finance.Discount')}}</label>
                    <input name="discount_amount"
                           type="text"
                           value="{{ (isset($model) and $model->discount_amount) ? $model->discount_amount : 0 }}"
                           id="discount_amount"
                           class="primary_input_field input_number" placeholder="{{__('finance.Discount')}}"
                           readonly>

                </div>

                <div class="primary_input grid_input">
                    <label class="font_13 theme_text f_w_500 mb-0"
                           for="net_total">{{__('finance.Net Total')}}</label>
                    <input type="text" id="net_total" placeholder="{{__('finance.Net Total')}}"
                           class="primary_input_field net_total input_number"
                           value="{{ (isset($model) and $model->net_total) ? $model->net_total : 0 }}" name="net_total"
                           readonly="readonly">

                </div>

                <div class="primary_input grid_input">
                    <label class="font_13 theme_text f_w_500 mb-0"
                           for="tax_amount">{{__('finance.Order Tax')}}</label>
                    <input name="tax_amount" type="text" id="tax_amount"
                           step="0.01" value="{{ (isset($model) and $model->tax_amount) ? $model->tax_amount : 0 }}"
                           placeholder="{{__('finance.Order Tax')}}"
                           class="primary_input_field input_number" readonly>
                </div>

                <div class="primary_input grid_input">
                    <label class="font_13 theme_text f_w_500 mb-0"
                           for="grand_total">{{__('finance.Grand Total')}}</label>
                    <input type="text" id="grand_total" placeholder="{{__('finance.Grand Total')}}"
                           class="primary_input_field grand_total input_number"
                           value="{{ (isset($model) and $model->grand_total) ? $model->grand_total : 0 }}"
                           name="grand_total" readonly="readonly">

                </div>

                <div class="primary_input grid_input">
                    <label class="font_13 theme_text f_w_500 mb-0"
                           for="paid">{{__('finance.Paid Amount')}}</label>
                    <input type="text" value="{{ (isset($model) and $model->paid) ? $model->paid : 0 }}" id="paid"
                           @isset($model) readonly @endisset
                           class="primary_input_field paid input_number" placeholder="{{__('finance.Paid Amount')}}"
                           name="paid">

                </div>

                <div class="primary_input grid_input">
                    <label class="font_13 theme_text f_w_500 mb-0"
                           for="due">{{__('finance.Due Amount')}}</label>
                    <input type="text" value="{{ (isset($model) and $model->due) ? $model->due : 0 }}" id="due"
                           placeholder="{{__('finance.Due Amount')}}" readonly
                           class="primary_input_field due input_number"
                           name="due">

                </div>
            </div>
        </div>
    </div>
</div>

@includeIf('customfield::fields', ['fields' => $fields, 'model' => $model ?? null])

<div class="row">

    <div class="col-lg-12">
        {{Form::label('note', __('finance.Order Note'))}}
        {{Form::textarea('note', null, ['class' => 'primary_input_field summernote', 'placeholder' => __('finance.Order Note')])}}

    </div>
    @isset($model)
        <div class="col-lg-12 text-center">
            <p class="alert alert-danger">
                *** {{ __('finance.If Invoice Total is less than paid amount, Transactions will be adjusted for this Invoice') }}</p>

        </div>
    @endif

</div>



