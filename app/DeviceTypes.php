<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeviceTypes extends Model
{
    protected $table = 'device_types';
    protected $fillable = [
        'id','index_number', 'name','img_path','instruction_path', 'periodicity','daily','weekly','monthly','three_month','six_month','yearly','machine_request','number of shuts','hours'
    ];

    public function devices(){
       return $this->hasMany('App/Devices', 'id_type', 'id');
    }
    public function type_intervention(){
       return $this->hasMany('App/TypeInterventions', 'id_type', 'id');
    }
}
    
