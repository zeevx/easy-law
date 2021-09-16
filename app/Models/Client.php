<?php

namespace App\Models;

use App\Traits\HasCustomFields;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Finance\Entities\Invoice;
use Modules\Finance\Entities\Transaction;

class Client extends Model {

    use HasCustomFields;

	protected $table = 'clients';
	protected $primaryKey = 'id';
	protected $fillable = ['country_id', 'state_id', 'city_id','client_category_id','email', 'mobile', 'gender', 'address', 'name', 'description'];

	public function country() {
		return $this->belongsTo(Country::class);
	}

	public function state() {
		return $this->belongsTo(State::class);
	}

	public function city() {
		return $this->belongsTo(City::class);
	}

	public function category()
    {
        return $this->belongsTo(ClientCategory::class,'client_category_id');
    }

    public function user(){
	    return $this->belongsTo(User::class);
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

    public function plaintiffs(){
	    return $this->hasMany(Cases::class, 'plaintiff', 'id');
    }

    public function opposites(){
	    return $this->hasMany(Cases::class, 'opposite', 'id');
    }
}
