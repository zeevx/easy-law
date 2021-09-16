<?php

namespace App\Models;

use App\Traits\HasCustomFields;
use Illuminate\Database\Eloquent\Model;

class Court extends Model {

    use HasCustomFields;

	protected $with = ['court_category'];
	protected $table = 'courts';
	protected $primaryKey = 'id';
	protected $fillable = ['country_id', 'state_id', 'city_id', 'court_category_id', 'location', 'name', 'description'];

	public function court_category() {
		return $this->belongsTo(CourtCategory::class);
	}

	public function country() {
		return $this->belongsTo(Country::class);
	}

	public function state() {
		return $this->belongsTo(State::class,'state_id');
	}

	public function city() {
		return $this->belongsTo(City::class,'city_id');
	}

	public function cases(){
	    return $this->hasMany(Cases::class, 'court_id', 'id');
    }

}
