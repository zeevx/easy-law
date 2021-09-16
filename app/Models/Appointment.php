<?php

namespace App\Models;

use App\Traits\HasCustomFields;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasCustomFields;

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

}
