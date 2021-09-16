<?php

namespace Modules\Finance\Entities;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Traits\HasCustomFields;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
   use HasCustomFields;

    protected $table = 'vendors';
    protected $primaryKey = 'id';
    protected $fillable = ['country_id', 'state_id', 'city_id','email', 'mobile', 'address', 'name', 'description'];

    public function country() {
        return $this->belongsTo(Country::class);
    }

    public function state() {
        return $this->belongsTo(State::class);
    }

    public function city() {
        return $this->belongsTo(City::class);
    }

    public function invoices(){
        return $this->morphMany(Invoice::class, 'clientable');
    }

    public function transactions(){
        return $this->hasManyThrough(
            Transaction::class,
            Invoice::class,
            'clientable_id',
            'morphable_id',
            'id',
            'id'
        )->where(['invoices.clientable_type' => __CLASS__, 'transactions.morphable_type' => get_class(new Invoice())]);
    }
}
