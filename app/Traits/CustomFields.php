<?php

namespace App\Traits;

use Modules\CustomField\Entities\CustomField;
use Modules\CustomField\Entities\CustomFieldResponse;

trait CustomFields
{
    public function storeFields($model, $fields, $form_name){

        if ($fields){
            $model_class = get_class($model);
            $model_id = $model->id;
            foreach ($fields as $field_id => $field_value){

                $field = CustomField::where(['id' =>$field_id, 'form_name' => $form_name, 'status' => 1])->first();
                $list = get_custom_field_var('list');
                if ($field){

                    $field_response = CustomFieldResponse::where(['custom_field_id'=> $field_id, 'morphable_id' => $model_id, 'morphable_type' => $model_class])->first();
                    if (!$field_response){
                        $field_response = new CustomFieldResponse();

                        $field_response->custom_field_id = $field_id;
                        $field_response->morphable_id = $model_id;
                        $field_response->morphable_type = $model_class;
                    }

                    if ($field->type == 'file'){
                        if ($field_value){
                            if (!file_exists('public/uploads/custom-file')) {
                                mkdir('public/uploads/custom-file', 0777, true);
                            }

                            $fileName = time() .'-'.uniqid('infix-custom-').'.'. $field_value->getClientOriginalExtension();
                            $field_value->move('public/uploads/custom-file/', $fileName);
                            $path = 'public/uploads/custom-file/' . $fileName;
                            $field_value = asset($path);
                        } else {
                            $field_value = '';
                        }

                    }
                    if ($field->type == 'checkbox'){
                        if ($field_value){
                            $field_value = implode(',', $field_value);
                        } else {
                            $field_value = '';
                        }

                    }

                    if (in_array($field->type, $list['field_type_integer'])){
                        $field_response->integer = $field_value;
                    } else if (in_array($field->type, $list['field_type_date'])){
                        $field_response->date = $field_value;
                    } else if (in_array($field->type, $list['field_type_text'])){
                        $field_response->text = $field_value;
                    } else {
                        $field_response->string = $field_value;
                    }

                    $field_response->save();
                }
            }
        }

    }

    public function generateValidateRules($form_name): array
    {
        $fields = CustomField::where(['form_name' => $form_name, 'status' => 1])->get();
        $rules = [];
        if (count($fields)) {
            $list = get_custom_field_var('list');
            foreach ($fields as $field) {
                $field_rule = [];
                (!$field->parent and $field->required) ? array_push($field_rule, 'required') : array_push($field_rule, 'nullable');

                ($field->parent and $field->required) ? array_push($field_rule, 'required_if:custom_field.' . $field->controlled_field.',controlled_field_value') : array_push($field_rule, 'nullable');

                $field->min ? array_push($field_rule, 'min:' . $field->min) : '';
                $field->max ? array_push($field_rule, 'max:' . $field->max) : '';

                if (in_array($field->type, $list['field_type_integer'])) {
                    array_push($field_rule, 'integer');
                } else if (in_array($field->type, $list['field_type_date'])) {
                    array_push($field_rule, 'date');
                } else if ($field->type == 'file') {
                    array_push($field_rule, 'mimes:jpg,bmp,png,doc,docx,pdf,jpeg,txt');
                } else if (in_array($field->type, $list['field_type_text'])) {
                    array_push($field_rule, 'string');
                }

                $rules['custom_field.' . $field->id] = $field_rule;
            }
        }
        return $rules;
    }

}
