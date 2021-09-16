<?php

namespace Modules\Finance\Http\Requests;

use App\Traits\CustomFields;
use App\Traits\ValidationMessage;
use Illuminate\Foundation\Http\FormRequest;

class BankAccountRequest extends FormRequest
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
            'bank_name' => ['required', 'string', 'max:191'],
            'branch_name' => ['required', 'string', 'max:191'],
            'account_name' => ['required', 'string', 'max:191'],
            'account_number' => ['required', 'string', 'max:191', 'unique:bank_accounts,account_number,'.$this->bank_account],
            'opening_balance' => ['sometimes', 'nullable', 'numeric'],
            'description' => ['sometimes', 'nullable', 'string', 'max:500']
        ];

        if (moduleStatusCheck('CustomField')){
            $validate_rules = array_merge($validate_rules, $this->generateValidateRules('bank_account'));
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
            'bank_name.required' => __('finance.The bank name field is required.'),
            'bank_name.string' => __('finance.The bank name must be a string.'),
            'bank_name.max' => __('finance.The bank name must not be greater than 191 characters.'),
            'branch_name.required' => __('finance.The branch name field is required.'),
            'branch_name.string' => __('finance.The branch name must be a string.'),
            'branch_name.max' => __('finance.The branch name must not be greater than 191 characters.'),
            'account_name.required' => __('finance.The account name field is required.'),
            'account_name.string' => __('finance.The account name must be a string.'),
            'account_name.max' => __('finance.The account name must not be greater than 191 characters.'),
            'account_number.required' => __('finance.The account number field is required.'),
            'account_number.string' => __('finance.The account number must be a string.'),
            'account_number.max' => __('finance.The account number must not be greater than 191 characters.'),
            'account_number.unique' => __('finance.The account number has already been taken.'),
            'opening_balance.numeric' => __('finance.The opening balance must be a number.'),
            'description.string' => __('finance.The description must be a string.'),
            'description.max' => __('finance.The description must not be greater than 500 characters.'),
        ];
    }
}
