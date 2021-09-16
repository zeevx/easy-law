<?php

namespace App\Models;

use App\Traits\HasCustomFields;
use Illuminate\Database\Eloquent\Model;
use Modules\CustomField\Entities\CustomFieldResponse;

class Contact extends Model
{
    use HasCustomFields;

    public function category()
    {
        return $this->belongsTo(ContactCategory::class,'contact_category_id');
    }

    public function appointments(){
        return $this->hasMany(Appointment::class, 'contact_id', 'id');
    }

}
