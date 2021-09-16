<?php

namespace App;

use App\Traits\HasCustomFields;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasCustomFields;

    protected $table = 'staffs';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
