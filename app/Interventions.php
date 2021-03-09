<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interventions extends Model
{
    protected $table = 'interventions';
    protected $fillable = [
        'id','date','id_type_mentenance','id_machine','id_type_machine','id_type','id_user','durations', 'report_path_','note'
    ];
   	public function type_mentenance(){
        return $this->belongsTo('App\TypeMentenance','id_type_mentenance', 'id');
    }
    public function device_type(){
        return $this->belongsTo('App\DeviceTypes','id_type_machine', 'id');
    }
    public function device(){
        return $this->belongsTo('App\Devices','id_machine', 'id');
    }
    public function user(){
        return $this->belongsTo('App\User','id_user', 'id');
    }
    public function intervention(){
        return $this->belongsTo('App\TypeInterventions','id_type', 'id');
    }

    public function scopeLinks($query){
        return $query->with('type_mentenance','device_type','device','user','intervention');
    }

    public function scopeUser($query,$id){
        return $query->where('id_user','=',$id);
    }
    public function scopeMachineType($query,$id){
    	return $query->where('id_type_machine','=',$id);
    }
    public function scopeIntervention($query,$id){
        return $query->where('id_type','=',$id);
    }

    public function scopeMaintenance($query,$id){
        return $query->where('id_type_mentenance','=',$id);
    }
    public function scopeMachine($query,$id){
        return $query->where('id_machine','=',$id);
    }
    public function scopeDate($query, $date_from , $date_to){
        return $query->whereBetween('date', [$date_from, $date_to]);
    }
}
