<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeInterventions extends Model
{
      protected $table = 'type_interventions';
    protected $fillable = [
        'id','id_type','id_device','name'
    ];

     public function type_mentenance(){
        return $this->belongsTo('App\TypeMentenance','id_type', 'id');
    }
    public function device_type(){
        return $this->belongsTo('App\DeviceTypes','id_device', 'id');
    }
}
