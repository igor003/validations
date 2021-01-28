<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Validations extends Model
{
     protected $table = 'validations';
    protected $fillable = [
        'id', 'id_device','executor', 'start_date','validations_path','decision', 'id_user',''
    ];

 	public function device(){
        return $this->belongsTo('App\Device');
    }
     
}
