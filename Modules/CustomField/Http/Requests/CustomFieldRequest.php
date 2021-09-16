<?php

namespace Modules\CustomField\Http\Requests;

use App\Traits\ValidationMessage;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\ModuleManager\Entities\Module;

class CustomFieldRequest extends FormRequest
{
    public function rules()
    {
        $list = get_custom_field_var('list');

        $forms = $list['form_name'];
        $modules = Module::all();
        foreach($modules as $module){
            if (moduleStatusCheck($module->name) ){
                $module_list = getModuleVar($module->name, 'custom_field');

                if ($list and gv($module_list, 'form_name')){
                    $forms = array_merge($forms, $module_list['form_name']);
                }
            }
        }

        $field_types = $list['field_type'];
        $field_widths = $list['field_width'];

        return [
            'form_name' => ['required', 'string', Rule::in($forms)],
            'type' => ['required', 'string', Rule::in($field_types)],
            'title' => ['required', 'string', 'max:191'],
            'default_value' => ['sometimes', 'nullable', 'string'],
            'min' => ['sometimes', 'nullable', 'integer'],
            'max' => ['sometimes', 'nullable', 'integer'],
            'width' => ['required', 'string', Rule::in($field_widths)],
            'values' => ['sometimes', 'nullable', 'string'],
            'required' => ['sometimes', 'nullable', 'boolean'],
            'active' => ['sometimes', 'nullable', 'boolean'],
            'description' => ['sometimes', 'nullable', 'string', 'max:500'],
            'pattern' => ['required_if:type,mask', 'nullable', 'string'],
            'controlled_field' => ['sometimes', 'nullable', 'integer', Rule::exists('custom_fields', 'id')],
            'controlled_field_value' => ['required_with:controlled_field', 'nullable', 'string'],
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
            'form_name.required' => __('custom_fields.The form name field is required.'),
            'form_name.string' => __('custom_fields.The form name must be a string.'),
            'form_name.in' => __('custom_fields.The selected form name is invalid.'),
            'type.required' => __('custom_fields.The type field is required.'),
            'type.string' => __('custom_fields.The type must be a string.'),
            'type.in' => __('custom_fields.The selected type is invalid.'),
            'title.required' => __('custom_fields.The title field is required.'),
            'title.string' => __('custom_fields.The title must be a string.'),
            'title.max' => __('custom_fields.The title must not be greater than 191 characters.'),
            'default_value.string' => __('custom_fields.The default value must be a string.'),
            'min.integer' => __('custom_fields.The min must be an integer.'),
            'max.integer' => __('custom_fields.The max must be an integer.'),
            'width.required' => __('custom_fields.The width field is required.'),
            'width.string' => __('custom_fields.The width must be a string.'),
            'width.in' => __('custom_fields.The selected width is invalid.'),
            'values.string' => __('custom_fields.The values must be a string.'),
            'string.string' => __('custom_fields.The pattern must be a string.'),
            'required.boolean' => __('custom_fields.The required field must be true or false.'),
            'active.boolean' => __('custom_fields.The active field must be true or false.'),
            'description.string' => __('custom_fields.The description must be a string.'),
            'description.max' => __('custom_fields.The description must not be greater than 500 characters.'),
            'pattern.required_if' => __('custom_fields.The Pattern field is required when the form type is mask')
        ];
    }
}
