<?php

namespace Modules\Finance\Http\Requests;

use App\Traits\ValidationMessage;
use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'charge' => ['sometimes', 'nullable', 'numeric'],
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
            'name.max' => __('finance.The name must not be greater than 191 characters.'),
            'name.string' => __('finance.The name must be a string.'),
            'description.max' => __('finance.The description must not be greater than 500 characters.'),
            'description.string' => __('finance.The description must be a string.'),
            'charge.numeric' => __('finance.The charge must be a number.'),
        ];
    }
}
