<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    public function dates(){
        return $this->hasMany(HearingDate::class, 'stage_id', 'id');
    }
}
