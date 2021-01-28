<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Validations extends Model
{
     protected $table = 'validations';
    protected $fillable = [
        'id', 'id_device','executor', 'start_date','validations_path','decision', 'id_user',''
    ];

 	public function devices(){
        return $this->belongsTo('App\Devices','id_device', 'id');
    }
     
}
