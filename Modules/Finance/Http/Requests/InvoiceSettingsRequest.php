<?php

namespace Modules\Finance\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceSettingsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'income_invoice_prefix' => ['required', 'string'],
            'expense_invoice_prefix' => ['required', 'string'],
            'invoice_number_padding' => ['required', 'numeric'],
            'invoice_number_separator' => ['required', 'string'],
            'invoice_format' => ['required', 'integer'],
            'remarks_title' => ['sometimes', 'nullable', 'string'],
            'remarks_body' => ['sometimes', 'nullable', 'string'],
            'terms_conditions' => ['sometimes', 'nullable', 'string'],
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
            'income_invoice_prefix.required' => __('finance.The income invoice prefix field is required.'),
            'income_invoice_prefix.string' => __('finance.The income invoice prefix must be a string.'),
            'expense_invoice_prefix.required' => __('finance.The expense invoice prefix field is required.'),
            'expense_invoice_prefix.string' => __('finance.The expense invoice prefix must be a string.'),
            'invoice_number_padding.required' => __('finance.The invoice number padding field is required.'),
            'invoice_number_padding.numeric' => __('finance.The invoice number padding must be a number.'),
            'invoice_number_separator.required' => __('finance.The invoice number separator field is required.'),
            'invoice_number_separator.string' => __('finance.The invoice number separator must be a string.'),
            'invoice_format.required' => __('finance.The invoice format field is required.'),
            'invoice_format.integer' => __('finance.The invoice format must be an integer.'),
            'remarks_title.string' => __('finance.The remarks title must be a string.'),
            'remarks_body.string' => __('finance.The remarks body must be a string.'),
            'terms_conditions.string' => __('finance.The terms conditions must be a string.'),
        ];
    }
}
