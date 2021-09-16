<?php

namespace Modules\Finance\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InvoicePaymentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'transaction_date' => ['required','date'],
            'paid' => ['required','numeric', 'min:1'],
            'due' => ['required','numeric'],
            'payment_method' => ['required', 'string', Rule::in(get_finance_var('list')['payment_method'])],
            'bank_account_id' => ['required_if:payment_method,bank', 'nullable', 'integer', Rule::exists('bank_accounts', 'id')],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'transaction_date.required' => __('finance.The transaction date field is required.'),
            'transaction_date.date' => __('finance.The transaction date is not a valid date.'),
            'paid.required' => __('finance.The paid field is required.'),
            'paid.numeric' => __('finance.The paid must be a number.'),
            'paid.min' => __('finance.The paid must be at least 1 characters.'),
            'due.required' => __('finance.The due field is required.'),
            'due.numeric' => __('finance.The due must be a number.'),
            'payment_method.required' => __('finance.The payment method field is required.'),
            'payment_method.string' => __('finance.The payment method must be a string.'),
            'payment_method.in' => __('finance.The selected payment method is invalid.'),
            'bank_account_id.required_if' => __('finance.The bank account id field is required when payment method is bank.'),
            'bank_account_id.integer' => __('finance.The bank account id must be an integer.'),
            'bank_account_id.exists' => __('finance.The selected bank account id is invalid.'),
        ];
    }
}
