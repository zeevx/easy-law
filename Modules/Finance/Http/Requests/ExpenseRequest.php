<?php

namespace Modules\Finance\Http\Requests;

use App\Traits\CustomFields;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ExpenseRequest extends FormRequest
{
    use CustomFields;
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $validate_rules = [
            'expense_type' => ['required', 'integer',
                Rule::exists('services', 'id')
            ],
            'bank_account_id' => ['required_if:payment_method,bank', 'nullable', 'integer',
                Rule::exists('bank_accounts', 'id')
            ],
            'payment_method' => ['required', 'string', 'max:50',
                Rule::in(get_finance_var('list')['payment_method'])
            ],
            'title' => ['required', 'string', 'max:191'],
            'amount' => ['required', 'numeric'],
            'transaction_date' => ['required', 'date'],
            'description' => ['sometimes', 'nullable', 'string', 'max:500'],
            'file' => ['sometimes', 'nullable', 'file']
        ];
        if (moduleStatusCheck('CustomField')){
            $validate_rules = array_merge($validate_rules, $this->generateValidateRules('expense'));
        }

        return $validate_rules;
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
            'expense_type.required' => __('finance.The expense type field is required.'),
            'expense_type.integer' => __('finance.The expense type must be an integer.'),
            'expense_type.exists' => __('finance.The selected expense type is invalid.'),
            'bank_account_id.required' => __('finance.The bank account id field is required.'),
            'bank_account_id.integer' => __('finance.The bank account id must be an integer.'),
            'bank_account_id.exists' => __('finance.The selected bank account id is invalid.'),
            'payment_method.required' => __('finance.The payment method field is required.'),
            'payment_method.integer' => __('finance.The payment method must be an integer.'),
            'payment_method.in' => __('finance.The selected payment method is invalid.'),
            'title.required' => __('finance.The title field is required.'),
            'title.string' => __('finance.The title must be a string.'),
            'title.max' => __('finance.The title must not be greater than 191 characters.'),
            'amount.required' => __('finance.The amount field is required.'),
            'amount.numeric' => __('finance.The amount must be a number.'),
            'transaction_date.required' => __('finance.The transaction date field is required.'),
            'transaction_date.date' => __('finance.The transaction date is not a valid date.'),
            'description.string' => __('finance.The description must be a string.'),
            'description.max' => __('finance.The description must not be greater than 500 characters.'),
            'file.file' => __('finance.The file must be a file.'),
        ];
    }
}
