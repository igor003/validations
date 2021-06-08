<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeviceTypes extends Model
{
    protected $table = 'device_types';
    protected $fillable = [
        'id', 'name','img_path', 'periodicity',
    ];

    public function devices(){
       return $this->hasMany('App/Devices', 'id_type', 'id');
    }
    public function type_intervention(){
       return $this->hasMany('App/TypeInterventions', 'id_type', 'id');
    }
}
    
