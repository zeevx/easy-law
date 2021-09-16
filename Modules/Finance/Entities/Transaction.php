<?php

namespace Modules\Finance\Entities;

use App\Traits\HasCustomFields;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasCustomFields;
    protected $guarded = ['id'];

    public function morphable(){
        return $this->morphTo();
    }

    public function bank(){
        return $this->belongsTo(BankAccount::class, 'bank_account_id', 'id');
    }

    public function getPaymentMethodDisplayAttribute(){
        $method = __('list.'.$this->payment_method);
        if ($this->payment_method == 'bank'){
            return "{$method} ({$this->bank->bank_name})";
        }

        return $method;
    }



}
