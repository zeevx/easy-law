<?php

namespace Modules\Finance\Entities;

use App\Traits\HasCustomFields;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasCustomFields;
    protected $guarded = ['id'];

    public function transactions(){
        return $this->hasMany(Transaction::class, 'bank_account_id', 'id');
    }

    public function getBalanceAttribute(){

        $in = $this->transactions()->where('type', 'in')->sum('amount');
        $out = $this->transactions()->where('type', 'out')->sum('amount');
        return $in - $out;
    }
}
