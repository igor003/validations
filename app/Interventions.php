<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interventions extends Model
{
    protected $table = 'interventions';
    protected $fillable = [
        'id','date','id_type_mentenance','id_machine','id_type','durations', 'report_path_','note'
    ];

}
