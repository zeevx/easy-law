<?php

namespace Modules\Finance\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvoiceItem extends Model
{
    protected $guarded = ['id'];

    public function service(){
        return $this->belongsTo(Service::class, 'service_type_id', 'id');
    }

}
