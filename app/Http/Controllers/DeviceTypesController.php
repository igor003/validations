<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DeviceTypes;
use App\Devices;
class DeviceTypesController extends Controller
{
    public function show (Request $request){
   
    	
    	$device_types = DeviceTypes::all();
    	$dev_types_count =array();
    	$cnt = 0;
    	foreach($device_types as $device_type){
    		$dev_types_count[$cnt][]= $device_type->id;
    		$dev_types_count[$cnt][]= $device_type->name;
    		$dev_types_count[$cnt][]= Devices::where('id_type',$device_type->id)->count();
    		$dev_types_count[$cnt][]= $device_type->periodicity;
    		$cnt++;
    			
    	} 

    	return view('device_types_view',['device_types_counts'=>$dev_types_count]);

    }

}
