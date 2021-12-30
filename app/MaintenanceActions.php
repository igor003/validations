<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaintenanceActions extends Model
{
    protected $table = 'maintenance_actions';
    protected $fillable = [
        'id','id_type_machine','id_type_maintenance','id_periodicity','description'
    ];
}
