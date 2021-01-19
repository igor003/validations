<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeviceTypes extends Model
{
    protected $table = 'device_types';
    protected $fillable = [
        'id', 'name', 'periodicity',
    ];
}
    
