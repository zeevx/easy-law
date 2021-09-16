<?php

namespace Modules\Finance\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaxRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'name' => ['required', 'string', 'max:191', 'unique:taxes,name,'.$this->tax],
            'rate' => ['required', 'numeric'],
            'description' => ['sometimes', 'nullable', 'string', 'max:500']
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
            'name.required' => __('finance.The name field is required.'),
            'name.max' => __('finance.The name must not be greater than 191 characters.'),
            'name.string' => __('finance.The name must be a string.'),
            'name.unique' => __('finance.The name has already been taken.'),
            'rate.required' => __('finance.The rate field is required.'),
            'rate.numeric' => __('finance.The rate must be a number.'),
            'description.string' => __('finance.The description must be a string.'),
            'description.max' => __('finance.The description must not be greater than 500 characters.'),
        ];
    }
}
