<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public $timestamps = false;

    public function states(){
        return $this->hasMany(State::class);
    }


    public function clients()
    {
        return $this->hasMany(Client::class, 'country_id', 'id');
    }

    public function courts()
    {
        return $this->hasMany(Court::class, 'country_id', 'id');
    }
}
