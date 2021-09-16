<?php

namespace Modules\Finance\Entities;

use App\Models\Cases;
use App\Traits\HasCustomFields;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasCustomFields;
   protected $guarded = ['id'];

   public function items(){
       return $this->hasMany(InvoiceItem::class);
   }

   public function transactions(){
       return $this->morphMany(Transaction::class, 'morphable');
   }

   public function clientable (){
       return $this->morphTo();
   }

   public function creator(){
       return $this->belongsTo(User::class, 'created_by', 'id');
   }

   public function case(){
       return $this->belongsTo(Cases::class, 'case_id', 'id');
   }

    public function getBalanceAttribute(){

        $in = $this->transactions()->where('type', 'in')->sum('amount');
        $out = $this->transactions()->where('type', 'out')->sum('amount');
        if ($this->invoice_type == 'income'){
            return $in - $out;
        }

        return $out - $in;

    }
}
