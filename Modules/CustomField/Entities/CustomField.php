<?php

namespace Modules\CustomField\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class CustomField extends Model
{
    use HasFactory;


    protected $table = 'custom_fields';

    protected $with = ['parent'];

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'form_name',
        'type',
        'title',
        'default_value',
        'pattern',
        'min',
        'max',
        'width',
        'values',
        'required',
        'active',
        'description'
    ];

    public function responses(){
        return $this->hasMany(CustomFieldResponse::class);
    }

    public function parent(): ?BelongsTo
    {
        return $this->belongsTo(CustomField::class, 'controlled_field', 'id')->where('status', 1);
    }

    public function childs(): ?HasMany
    {
        return $this->hasMany(CustomField::class, 'controlled_field', 'id')->where('status', 1);
    }
}
