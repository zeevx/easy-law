<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactCategory extends Model
{
    public function contacts()
    {
        return $this->hasMany(Contact::class, 'contact_category_id', 'id');
    }
}
