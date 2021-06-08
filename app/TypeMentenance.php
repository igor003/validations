<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeMentenance extends Model
{
    protected $table = 'type_mentenance';
    protected $fillable = [
        'id', 'name',
    ];

   public function interventions(){
       return $this->hasMany('App/TypeMentenance', 'id_type', 'id');
    }
}
