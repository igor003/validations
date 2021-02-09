<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeInterventions extends Model
{
      protected $table = 'type_interventions';
    protected $fillable = [
        'id','id_type', 'name'
    ];
}
