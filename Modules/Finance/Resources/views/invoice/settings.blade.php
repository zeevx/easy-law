@extends('finance::layouts.master', ['title' => __('finance.Invoice Settings')])

@section('mainContent')
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row ">
                <div class="col-12">
                    <div class="box_header">


                    <div class="main-title ">
                        <h3 class="mb-0">{{ __('finance.Invoice Settings') }}</h3>
                    </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="white_box_50px box_shadow_white">
                        <form action="{{ route('invoice.settings') }}" method="POST" enctype="multipart/form-data"
                              id="content_form">
                            @csrf
                            <div class="single_system_wrap">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="primary_input ">
                                            <label class="primary_input_label required"
                                                   for="income_invoice_prefix">{{ __('finance.Income Invoice Prefix') }}</label>
                                            <input class="primary_input_field"
                                                   placeholder="{{ __('finance.Income Invoice Prefix') }}" type="text"
                                                   id="income_invoice_prefix" required
                                                   name="income_invoice_prefix"
                                                   value="{{ getConfig('income_invoice_prefix') }}">
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="primary_input ">
                                            <label class="primary_input_label required"
                                                   for="expense_invoice_prefix">{{ __('finance.Expense Invoice Prefix') }}</label>
                                            <input class="primary_input_field" required
                                                   placeholder="{{ __('finance.Expense Invoice Prefix') }}" type="text"
                                                   id="expense_invoice_prefix"
                                                   name="expense_invoice_prefix"
                                                   value="{{ getConfig('expense_invoice_prefix') }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="primary_input ">
                                            <label class="primary_input_label required"
                                                   for="invoice_number_padding">{{ __('finance.Invoice Number Padding') }}</label>
                                            <input class="primary_input_field input_number" required
                                                   placeholder="{{ __('finance.Invoice Number Padding') }}" type="text"
                                                   id="invoice_number_padding"
                                                   name="invoice_number_padding"
                                                   value="{{ getConfig('invoice_number_padding') }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="primary_input ">
                                            <label class="primary_input_label required"
                                                   for="invoice_number_separator">{{ __('finance.Invoice Number Separator') }}</label>
                                            <input class="primary_input_field" required
                                                   placeholder="{{ __('finance.Invoice Number Separator') }}"
                                                   type="text"
                                                   id="invoice_number_separator"
                                                   name="invoice_number_separator"
                                                   value="{{ getConfig('invoice_number_separator') }}">
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="primary_input ">
                                            <label class="primary_input_label"
                                                   for="next_income_invoice_number">{{ __('finance.Next Income Invoice Number') }}</label>
                                            <input class="primary_input_field"
                                                   placeholder="{{ __('finance.Next Income Invoice Number') }}"
                                                   type="text"
                                                   id="next_income_invoice_number" readonly disabled
                                                   value="{{ $next_income_invoice_no }}"
                                                   name="next_income_invoice_number">
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="primary_input ">
                                            <label class="primary_input_label"
                                                   for="next_expense_invoice_number">{{ __('finance.Next Expense Invoice Number') }}</label>
                                            <input class="primary_input_field"
                                                   placeholder="{{ __('finance.Next Expense Invoice Number') }}"
                                                   type="text"
                                                   id="next_expense_invoice_number" readonly disabled
                                                   value="{{ $next_expense_invoice_no }}"
                                                   name="next_expense_invoice_number">
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <div class="primary_input ">
                                            <label class="primary_input_label required"
                                                   for="invoice_format">{{ __('finance.Invoice Number Format') }}</label>
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="primary_input mb-25">
                                                    <label class="primary_checkbox d-flex mr-12 w-100">
                                                        <input name="invoice_format" value="1" type="radio"
                                                               required {{ getConfig('invoice_format') == 1 ? 'checked' : '' }}>
                                                        <span class="checkmark"></span>
                                                        <span class="ml-2">{{ __('finance.Number Based') }} (<span
                                                                class="format_number">{{ $preview_number }}</span>)  </span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="primary_input mb-25">
                                                    <label class="primary_checkbox d-flex mr-12 w-100">
                                                        <input name="invoice_format" value="2" type="radio"
                                                               required {{ getConfig('invoice_format') == 2 ? 'checked' : '' }}>
                                                        <span class="checkmark"></span>
                                                        <span class="ml-2">{{ __('finance.Year Based') }} (YYYY<span
                                                                class="number_separator">{{ getConfig('invoice_number_separator') }}</span><span
                                                                class="format_number">{{ $preview_number }}</span>) </span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="primary_input mb-25">
                                                    <label class="primary_checkbox d-flex mr-12 w-100">
                                                        <input name="invoice_format" value="3" type="radio"
                                                               required {{ getConfig('invoice_format') == 3 ? 'checked' : '' }}>
                                                        <span class="checkmark"></span>
                                                        <span class="ml-2"><span
                                                                class="format_number">{{ $preview_number }}</span><span
                                                                class="number_separator">{{ getConfig('invoice_number_separator') }}</span>YY  </span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="primary_input mb-25">
                                                    <label class="primary_checkbox d-flex mr-12 w-100">
                                                        <input name="invoice_format" value="4" type="radio"
                                                               required {{ getConfig('invoice_format') == 4 ? 'checked' : '' }}>
                                                        <span class="checkmark"></span>
                                                        <span class="ml-2"><span
                                                                class="format_number">{{ $preview_number }}</span><span
                                                                class="number_separator">{{ getConfig('invoice_number_separator') }}</span>MM<span
                                                                class="number_separator">{{ getConfig('invoice_number_separator') }}</span>YY</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                    <div class="col-xl-12">
                                        <div class="primary_input ">
                                            <label class="primary_input_label"
                                                   for="">{{ __('finance.Remark Title') }}</label>
                                            <input class="primary_input_field"
                                                   placeholder="{{ __('finance.Remark Title') }}" type="text"
                                                   id="remarks_title"
                                                   name="remarks_title" value="{{ getConfig('remarks_title') }}">
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <div class="primary_input ">
                                            <label class="primary_input_label"
                                                   for="">{{__('finance.Remark Body')}}</label>
                                            <textarea class="primary_textarea"
                                                      placeholder="{{__('finance.Remark Body')}}"
                                                      id="remarks_body" cols="30" rows="5"
                                                      name="remarks_body">{{ getConfig('remarks_body') }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <div class="primary_input ">
                                            <label class="primary_input_label"
                                                   for="">{{__('finance.Terms & Condition')}}</label>
                                            <textarea class="primary_textarea"
                                                      placeholder="{{__('finance.Terms & Condition')}}"
                                                      id="terms_conditions" cols="30" rows="10"
                                                      name="terms_conditions">{{ getConfig('terms_conditions') }}</textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="submit_btn text-center mt-4">
                                <button class="primary_btn_large submit" type="submit"><i
                                        class="ti-check"></i> {{ __('common.Save') }}</button>

                                <button class="primary_btn_large submitting" type="button" disabled
                                        style="display: none; ">
                                    <i class="ti-check"></i> {{ __('common.Saving') }}</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection

@push("scripts")
    <script>
        _formValidation();
        $(document).on('keyup', '#invoice_number_separator', function () {
            $('.number_separator').text($(this).val());
        });

        $(document).on('keyup', '#invoice_number_padding', function () {
            let val = parseInt($(this).val());

            if (isNaN(val)){
                val = 1;
                $(this).val(val);
            }

            if(val > 8){
                val = 8;
                toastr.error('Maximum padding value is '+val);
                $(this).val(val);
            }
            $('.format_number').text(formatWithPadding(1, val));
        });

        function formatWithPadding(n, width, z=0){
            z = z || '0';
            n = n + '';
            return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
        }
    </script>
@endpush
