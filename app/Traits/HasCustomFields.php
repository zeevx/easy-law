<?php


namespace App\Traits;


use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Modules\CustomField\Entities\CustomField;
use Modules\CustomField\Entities\CustomFieldResponse;
use Modules\CustomField\Validators\CustomFieldValidator;

trait HasCustomFields
{
    public function customFields(){
        return $this->morphMany(CustomFieldResponse::class, 'morphable')->with(['field', 'field.childs', 'field.parent', 'field.parent.responses' => function($q) {
            return $q->where('morphable_id', $this->id)->where('morphable_type', get_class($this));
        }]);
    }

}
