<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    public $timestamps = false;

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function cities(){
        return $this->hasMany(City::class);
    }

    public function clients()
    {
        return $this->hasMany(Client::class, 'state_id', 'id');
    }

    public function courts()
    {
        return $this->hasMany(Court::class, 'state_id', 'id');
    }
}
