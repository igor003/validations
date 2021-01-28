<?php

namespace App\Http\Controllers;

use App\Validations;
use Illuminate\Http\Request;
use App\Devices;
class ValidationsController extends Controller
{
   
    public function show($id){
        $device_info = Devices::find($id);
       
        $validations = Validations::where('id_device',$id)->get();

        return view('validations_list_by_id',['validations'=>$validations,'device_info'=>$device_info]);
    }

    public function create(Request $request){
        //
    }

    public function edit(Request $requestl){
        //
    }

    public function update(Request $request){
        //
    }
    
}
