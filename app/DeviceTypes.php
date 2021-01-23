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
}
    
