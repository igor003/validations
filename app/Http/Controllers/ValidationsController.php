<?php

namespace App\Http\Controllers;

use App\Validations;
use Illuminate\Http\Request;
use App\Devices;
class ValidationsController extends Controller
{
   
    public function show($id){
        $device_info = Devices::find($id);
       
        $validations = Validations::where('id_device',$id)->orderBy('start_date', 'asc')->get();

        return view('validations_list_by_id',['validations'=>$validations,'device_info'=>$device_info]);
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
        //
    }
    
}
