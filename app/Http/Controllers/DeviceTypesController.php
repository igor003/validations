<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DeviceTypes;

class DeviceTypesController extends Controller
{
    public function show (Request $request){
    	$device_types = DeviceTypes::all();

    	return view('device_types_view',['device_types'=>$device_types]);

    }

}
