<?php

namespace Modules\Finance\Http\Requests;

use App\Traits\CustomFields;
use App\Traits\ValidationMessage;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VendorRequest extends FormRequest
{
    use ValidationMessage, CustomFields;
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $validate_rules = [
            'country_id' => ['sometimes', 'nullable', 'integer', Rule::exists('countries', 'id')],
            'state_id' => ['sometimes', 'nullable', 'integer', Rule::exists('states', 'id')],
            'city_id' => ['sometimes', 'nullable', 'integer', Rule::exists('cities', 'id')],
            'email' => 'sometimes|nullable|email|max:191',
            'mobile' => 'sometimes|nullable|string|max:191',
            'name' => 'required|max:191|string',
            'address' => 'sometimes|nullable|max:191|string',
            'description' => 'sometimes|nullable|max:1500|string',
        ];
        if (moduleStatusCheck('CustomField')) {
            $validate_rules = array_merge($validate_rules, $this->generateValidateRules('client'));
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
}
