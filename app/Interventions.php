<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interventions extends Model
{
    protected $table = 'interventions';
    protected $fillable = [
        'id','id_type','id_device','name'
    ];

}
