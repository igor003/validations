<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\DeviceTypes;
use App\Devices;
use App\User;
class DeviceTypesController extends Controller
{
    public function show (Request $request){

    
     if($request->api_token){
        $user = User::where('api_token','=',$request->api_token)->get();

        $user = User::find($user['0']->id);
        Auth::login($user);
     }
    	
    	$device_types = DeviceTypes::orderBy('index_number')->get();
    	$dev_types_count =array();
    	$cnt = 0;
       
    	foreach($device_types as $device_type){
    		$dev_types_count[$cnt][]= $device_type->id;
    		$dev_types_count[$cnt][]= $device_type->name;
    		$dev_types_count[$cnt][]= Devices::where('id_type',$device_type->id)->count();
    		$dev_types_count[$cnt][]= $device_type->periodicity;
            $dev_types_count[$cnt][]= $device_type->daily;
            $dev_types_count[$cnt][]= $device_type->weekly;
            $dev_types_count[$cnt][]= $device_type->monthly;
            $dev_types_count[$cnt][]= $device_type->three_month;
            $dev_types_count[$cnt][]= $device_type->six_month;
            $dev_types_count[$cnt][]= $device_type->yearly;
            $dev_types_count[$cnt][]= $device_type->machine_request;
            $dev_types_count[$cnt][]= $device_type->number_of_shuts;
            $dev_types_count[$cnt][]= $device_type->hours;
    		$cnt++;
    			
    	} 

    	return view('device_types_view',['device_types_counts'=>$dev_types_count]);

    }

    public function download_instruction ($id){
      $dev_type = DeviceTypes::find($id);

        $file = 'storage/admin/'.$dev_type->instruction_path;


        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-disposition' => 'attachment; filename=result',
        ];

        return response()->download($file,basename($dev_type->instruction_path), $headers);
    }
    public function download_validation_instruction($id){
      $dev_type = DeviceTypes::find($id);

        $file = 'storage/admin/'.$dev_type->valid_instruction_path;


        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-disposition' => 'attachment; filename=result',
        ];

        return response()->download($file,basename($dev_type->valid_instruction_path), $headers);
    }

}
