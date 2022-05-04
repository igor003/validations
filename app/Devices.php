<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Devices extends Model
{
    protected $table = 'devices';
    protected $fillable = [
        'id', 'id_type', 'number','serial_number','inventory_number','maker','model','status','info_img','start_date','next_valid_date','note','project','data_sheet_path','cycles','push_back','tail','ordin_nmb'
    ];

    public function device_type(){
        return $this->belongsTo('App\DeviceTypes','id_type', 'id');
    }

    public function validation(){
       return $this->hasMany('App\Validations', 'id_device', 'id');
    }
     
}
