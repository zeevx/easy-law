<?php

namespace Modules\Finance\Http\Requests;

use App\Traits\CustomFields;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InvoiceRequest extends FormRequest
{
    use CustomFields;
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $client_table = 'clients';
        if ($this->invoice_type == 'expense') {
            $client_table = 'vendors';
        }



        $rules = [
            'clientable_id' => ['required', 'integer', Rule::exists($client_table, 'id')],
            'case_id' => ['sometimes', 'nullable', 'integer', Rule::exists('cases', 'id')],
            'bank_account_id' => ['required_if:payment_method,bank', 'nullable', 'integer', Rule::exists('bank_accounts', 'id')],
            'tax_id' => ['sometimes', 'nullable', 'string'],
            'invoice_no' => ['required', 'string'],
            'due_date' => ['sometimes', 'nullable', 'date'],
            'discount' => ['sometimes', 'nullable', 'numeric'],
            'invoice_date' => ['required', 'date'],
            'sub_total' => ['required', 'numeric'],
            'discount_amount' => ['required', 'numeric'],
            'net_total' => ['required', 'numeric'],
            'tax_amount' => ['required', 'numeric'],
            'grand_total' => ['required', 'numeric'],
            'paid' => ['required', 'numeric'],
            'due' => ['required', 'numeric'],
            'discount_type' => ['required', 'string', Rule::in(get_finance_var('list')['discount_type'])],
            'item_row' => ['present'],
            'item_row.*.service' => ['required', 'numeric', Rule::exists('services', 'id')],
            'item_row.*.qty' => ['required', 'numeric'],
            'item_row.*.amount' => ['required', 'numeric'],
            'item_row.*.line_total' => ['required', 'numeric'],
        ];

        if ($this->income or $this->expense) {
            $rules['payment_method'] = ['sometimes', 'nullable', 'string', Rule::in(get_finance_var('list')['payment_method'])];
        } else {
            $rules['payment_method'] = ['required', 'string', Rule::in(get_finance_var('list')['payment_method'])];
        }

        if (moduleStatusCheck('CustomField')){
            $rules = array_merge($rules, $this->generateValidateRules($this->invoice_type. '_invoice'));
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'item_row.present' => __('finance.Please Select at list one ' . ($this->invoice_type == 'income' ? 'Service' : 'Expense type')),
            'clientable_id.required' => __('finance.The ' . ($this->invoice_type == 'income' ? 'Client' : 'Vendor').' field is required.'),
            'clientable_id.integer' => __('finance.The ' . ($this->invoice_type == 'income' ? 'Client' : 'Vendor').' must be an integer.'),
            'clientable_id.exists' => __('finance.The selected ' . ($this->invoice_type == 'income' ? 'Client' : 'Vendor').' is invalid.'),
            'case_id.integer' => __('finance.The case id must be an integer.'),
            'case_id.exists' => __('finance.The selected case id is invalid.'),
            'tax_id.string' => __('finance.The tax id must be a string.'),
            'invoice_no.required' => __('finance.The invoice no field is required.'),
            'invoice_no.string' => __('finance.The invoice no must be a string.'),
            'due_date.date' => __('finance.The due date is not a valid date.'),
            'discount.numeric' => __('finance.The discount must be a number.'),
            'invoice_date.date' => __('finance.The invoice date is not a valid date.'),
            'sub_total.required' => __('finance.The sub total field is required.'),
            'sub_total.numeric' => __('finance.The sub total must be a number.'),
            'discount_amount.required' => __('finance.The discount amount field is required.'),
            'discount_amount.numeric' => __('finance.The discount amount must be a number.'),
            'net_total.required' => __('finance.The net total field is required.'),
            'net_total.numeric' => __('finance.The net total must be a number.'),
            'tax_amount.required' => __('finance.The tax amount field is required.'),
            'tax_amount.numeric' => __('finance.The tax amount must be a number.'),
            'grand_total.required' => __('finance.The grand total field is required.'),
            'grand_total.numeric' => __('finance.The grand total must be a number.'),
            'paid.required' => __('finance.The paid field is required.'),
            'paid.numeric' => __('finance.The paid must be a number.'),
            'due.required' => __('finance.The due field is required.'),
            'due.numeric' => __('finance.The due must be a number.'),
            'discount_type.required' => __('finance.The discount type field is required.'),
            'discount_type.string' => __('finance.The discount type must be a string.'),
            'discount_type.in' => __('finance.The selected discount type is invalid.'),
            'item_row.*.service.required' => __('finance.The item row service field is required.'),
            'item_row.*.service.numeric' => __('finance.The item row service must be a number.'),
            'item_row.*.service.exists' => __('finance.The selected item row service is invalid.'),
            'item_row.*.qty.required' => __('finance.The item row qty field is required.'),
            'item_row.*.qty.numeric' => __('finance.The item row qty must be a number.'),
            'item_row.*.amount.required' => __('finance.The item row amount field is required.'),
            'item_row.*.amount.numeric' => __('finance.The item row amount must be a number.'),
            'item_row.*.line_total.required' => __('finance.The item row line total field is required.'),
            'item_row.*.line_total.numeric' => __('finance.The item row line total must be a number.'),
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
}
