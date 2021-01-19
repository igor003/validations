<?php

namespace App\Http\Controllers;

use App\Devices;
use App\DeviceTypes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DevicesController extends Controller
{
    public function show($id){
        $devices = Devices::where("type_id",$id);
        $device_type = DeviceTypes::find($id);
        return view('devices_list',['devices'=>$devices,'device_type'=>$device_type]);
    }

    public function create()
    {
        //
    }

    public function edit(Devices $devices)
    {
        //
    }

    public function update(Request $request, Devices $devices)
    {
        //
    }

 
}
