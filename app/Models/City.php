<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public $timestamps = false;

    public function state(){
        return $this->belongsTo(State::class);
    }

    public function clients()
    {
        return $this->hasMany(Client::class, 'city_id', 'id');
    }

    public function courts()
    {
        return $this->hasMany(Court::class, 'city_id', 'id');
    }
}
