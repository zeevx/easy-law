<?php

namespace Modules\Finance\Http\Requests;

use App\Traits\ValidationMessage;
use Illuminate\Foundation\Http\FormRequest;

class ExpenseTypeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:191'],
            'description' => ['sometimes', 'nullable', 'string', 'max:500'],
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
            'name.string' => __('finance.The name must be a string.'),
            'name.max' => __('finance.The name must not be greater than 191 characters.'),
            'description.string' => __('finance.The description must be a string.'),
            'description.max' => __('finance.The description must not be greater than 500 characters.'),
        ];
    }
}
