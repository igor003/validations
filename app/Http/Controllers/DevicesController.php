<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Response;
use App\Validations;
use App\Devices;
use App\DeviceTypes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DateTime;
use DateInterval;

class DevicesController extends Controller
{
    public function show($id){

        $devices_collect = Devices::where("id_type",$id)->orderBy('inventory_number', 'DESC')->get();
        $devices = array();
        $cnt = 0;
        foreach($devices_collect as $cur_device){
            
            $max_date = Validations::select('start_date')->where('id_device',$cur_device->id)->orderBy('start_date', 'desc')->first();
            $cur_device_period = DeviceTypes::where('id',$cur_device->id_type)->get();
            
            $device_period_month = $cur_device_period[0]->periodicity;
            $devices[$cnt]['id'] = $cur_device->id;
            $devices[$cnt]['number'] = $cur_device->number;
            $devices[$cnt]['serial_number'] = $cur_device->serial_number;
            $devices[$cnt]['inventory_number'] = $cur_device->inventory_number;
            $devices[$cnt]['maker'] = $cur_device->maker;
            $devices[$cnt]['model'] = $cur_device->model;
            $devices[$cnt]['start_date'] = $cur_device->start_date;
            $devices[$cnt]['status'] = $cur_device->status;
            $devices[$cnt]['note'] = $cur_device->note;
            
            if($max_date == NULL){
                $devices[$cnt]['prev_date'] = '---';
                $devices[$cnt]['next_date'] = '---';
                $devices[$cnt]['range'] = 0;
            }else{
                     
                $devices[$cnt]['prev_date'] = $max_date->start_date;
                $date =  new DateTime($max_date->start_date);
                $date->add(new DateInterval('P'.$device_period_month.'M'));
                $devices[$cnt]['next_date'] = $date->format('Y-m-d');
                $date2 =  new DateTime( $date->format('Y-m-d'));
                $date2->sub(new DateInterval('P15D'));
                $devices[$cnt]['range'] = $date2->format('Y-m-d');

            }
         
            $devices[$cnt][] = $cur_device->status;
            $cnt++;
        }

        $device_type = DeviceTypes::find($id);
        return view('devices_list',['devices'=>$devices,'device_type'=>$device_type]);
    }
    public function type_inregistration_view($id)
    {
        return view('type_inregistration',['id'=>$id]);
    }

    public function get_by_id_type(Request $request)
    {

        $machines_by_type = Devices::where('id_type','=',$request->id)->get();

        return Response::json($machines_by_type);
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
