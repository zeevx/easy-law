<?php

namespace Modules\CustomField\Entities;

use Illuminate\Database\Eloquent\Model;

class CustomFieldResponse extends Model
{
    protected $table = 'custom_field_responses';

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'value',
    ];

    public function model()
    {
        return $this->morphTo();
    }

    public function field()
    {
        return $this->belongsTo(CustomField::class, 'custom_field_id');
    }

    public function getValueAttribute(){
        if ($this->date){
            return $this->date;
        } else if ($this->integer){
            return $this->integer;
        } else if ($this->text){
            return $this->text;
        }

        return $this->string;

    }

    public function getShowValueAttribute(){
        $value =$this->string;

        if ($this->date){
            $value = formatDate($this->date);
        } else if ($this->integer){
            $value = $this->integer;
        } else if ($this->text){
            $value = $this->text;
        }

        if ($this->field->type == 'file'){
            $value = "<a href='{$value}' download target='_blank'>{$value}</a>";
        } else if($this->field->type == 'url'){
            $value = "<a href='{$value}' target='_blank'>{$value}</a>";
        }

        return $value;
    }

    protected $casts = [
        'date' => 'date'
    ];

}
