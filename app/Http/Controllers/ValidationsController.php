<?php

namespace App\Http\Controllers;

use App\Validations;
use Illuminate\Http\Request;
use App\Devices;
use App\DeviceTypes;
class ValidationsController extends Controller
{
   
    public function show($id){
        $device_info = Devices::find($id);
        $device_type = DeviceTypes::find($device_info->id_type);
       
        $validations = Validations::where('id_device',$id)->orderBy('start_date', 'asc')->get();
        $type_val = array('ordinary'=>0,'extraordinary'=>0);
        if($device_info->id_type == 3){
            foreach($validations as $validation){
                if($validation['type'] == 'Ordinary'){
                    $type_val['ordinary'] +=1;
                }
                if($validation['type'] == 'Extraordinary'){
                    $type_val['extraordinary'] +=1;
                }
            }
              
        }


       
        return view('validations_list_by_id',['validations'=>$validations,'device_info'=>$device_info,'device_type'=>$device_type,'type_valid'=>$type_val]);
    }

    public function download($id){
        $validations = Validations::find($id);

        $file = 'storage/admin/'.$validations->validation_path;


        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-disposition' => 'attachment; filename=result',
        ];

        return response()->download($file,basename($validations->validation_path), $headers);
    }

    public function edit(Request $requestl){
        //
    }

    public function update(Request $request){
    }
    
}
