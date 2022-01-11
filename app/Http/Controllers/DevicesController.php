<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Response;
use App\Validations;
use App\Devices;
use App\DeviceTypes;
use App\Interventions;
use App\TypeInterventions;
use App\CollaudoLocale;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DateTime;
use DateInterval;
use Carbon\Carbon;
class DevicesController extends Controller
{
    public function processing__maintenance_date($date, $type){
        $format = "Y-m-d";
        switch($type){
            case "dayli":
                return 'dayli';
                break;
            case "weekly":
                    $date_obj = new DateTime($date);
                    $date1 =  $date_obj->add(new DateInterval('P5D'))->format($format);
                    $date2 =  $date_obj->add(new DateInterval('P2D'))->format($format);
                    if($date === false) {
                        return 'secondary';
                    }elseif(date($format) < $date){
                        return 'info';
                    }elseif(date($format) == $date || date($format) > $date && $date1 > date($format) || $date1 == date($format) ){
                        return 'success';
                    }elseif( date($format) > $date && date($format) < $date2 && date($format) > $date || date($format) == $date2 ){
                        return 'warning';
                    }elseif(date($format)>$date){
                        return 'danger';
                    }else{
                        return 'false1';
                    }
                break;
            case "monthly":
                    $month_obj = new DateTime($date);
                    $month1 =  $month_obj->add(new DateInterval('P28D'))->format($format);
                    $month2 =  $month_obj->add(new DateInterval('P2D'))->format($format);
                    if($date === false) {
                        return 'secondary';
                    }elseif(date($format) < $date){
                        return 'info';
                    }elseif(date($format) == $date || date($format) > $date && $month1 > date($format) || $month1 == date($format) ){
                        return 'success';
                    }elseif( date($format) > $date && date($format) < $month2 && date($format) > $date || date($format) == $month2 ){
                        return 'warning';
                    }elseif(date($format)>$date){
                        return 'danger';
                    }else{
                        return 'false1';
                    }
                break;
            case "three_month":
                // $three_month_obj = new DateTime($date);
                // $three_month1 =  $three_month_obj->add(new DateInterval('P27D2M'))->format($format);
                // $three_month2 =  $three_month_obj->add(new DateInterval('P3D'))->format($format);
                return false;
                break;
            case "six_monthly":
                
                return false;
                break;
            case "yearly":
                $year_obj = new DateTime($date);
                $year1 =  $year_obj->add(new DateInterval('P11M28D'))->format($format);
                $year2 =  $year_obj->add(new DateInterval('P3D'))->format($format);
                if($date === false) {
                    return 'secondary';
                }elseif(date($format) < $date){
                    return 'info';
                }elseif(date($format) == $date || date($format) > $date && $year1 > date($format) || $year1 == date($format) ){
                    return 'success';
                }elseif( date($format) > $date && date($format) < $year2 && date($format) > $date || date($format) == $year2 ){
                    return 'warning';
                }elseif(date($format)>$date){
                    return 'danger';
                }else{
                    return 'false1';
                }
                return 'warning';
                break;
            case "machine_request":
                return false;
                break;
            case "number_of_shuts":
                return "success";
                break;
            case "hours":
                return false;
                break;
            

        }
    }
    public function get_machine_pices(Request $request){
        $machine_id = $request->id_machine;
        $machine = Devices::find($machine_id);
        $res = '--';
            if(CollaudoLocale::where('NomeBanco','=',$machine['number'])->first()){  
                $res = CollaudoLocale::where('NomeBanco','=',$machine['number'])->count();
            }else{
                $res = '--';
            }
        
        return Response::json($res); 
    }

    public function show($id){
        //тип машины
        $device_type = DeviceTypes::find($id)->toArray();
        //поля с типом ментенанцы там где указано true
        $fields = array();
        foreach($device_type AS $key=>$value){
            //исключаем id и  index_number у которых значение тоже может быть 1
            if($value === 1 && $key !== 'id' && $key !== 'index_number'){
                $fields[] = $key;
            }
         
        }
       
        //список машин по определённому типу
        $devices_collect = Devices::where("id_type",$id)->orderBy('start_date', 'DESC')->orderBy('inventory_number', 'DESC')->get()->toArray();
       

        $devices = array();
        $cnt = 0;
        // перебираем все машины
        foreach($devices_collect as $cur_device){
           
            $type_date = array();
            //перебираем все поля с типом ментенанцы
            foreach($fields as $field){
                //узнаем id типа ментенанцы
                $type = TypeInterventions::where('name','=',$field)->where('id_device','=',$id)->get()->toArray();
                //если есть записи с таким типом ментенанцы
                if($type){
                    //достаём последнюю запись ментенанцы
                    $interventions = Interventions::where('id_machine','=',$cur_device['id'])->where('id_type','=',$type['0']['id'])->latest('date')->first();
                }else{
                       $interventions = false;
                }
                //если нет записи с таким типом ментенанцы
             
                //если есть последняя запись ментенанцы
                if( $interventions){
                    $type_date[$field] = substr($interventions->date,0,10);
                    //если нет последнеё записи ментенанцы
                }else{
                    $type_date[$field] = false;
                }
            }
     
            $max_date = Validations::select('start_date')->where('id_device',$cur_device['id'])->orderBy('start_date', 'desc')->first();
            $cur_device_period = DeviceTypes::where('id',$cur_device['id_type'])->get();
             $res = '--';
            if($cur_device['id_type'] == '4' && $cur_device['model'] == 'LE Solution'){
                if(CollaudoLocale::where('NomeBanco','=',$cur_device['number'])->first()){
                    set_time_limit(0);
                    $res = CollaudoLocale::where('NomeBanco','=',$cur_device['number'])->count();

                     
                }else{
                    $res = '--';
                }
            }
          
            $device_period_month = $cur_device_period[0]->periodicity;
            $devices[$cnt]['id'] = $cur_device['id'];
            $devices[$cnt]['number'] = $cur_device['number'];
            $devices[$cnt]['serial_number'] = $cur_device['serial_number'];
            $devices[$cnt]['inventory_number'] = $cur_device['inventory_number'];
            $devices[$cnt]['maker'] = $cur_device['maker'];
            $devices[$cnt]['model'] = $cur_device['model'];
            $devices[$cnt]['start_date'] = $cur_device['start_date'];
            $devices[$cnt]['status'] = $cur_device['status'];
            $devices[$cnt]['note'] = $cur_device['note'];
            $devices[$cnt]['project'] = $cur_device['project'];
            // $devices[$cnt]['note'] = $res; 
            
         
            $devices[$cnt]['info_img'] = $cur_device['info_img'];
            
            foreach($type_date as $key=>$value){
        
                if($key == 'weekly'){
                    $devices[$cnt][$key] = $value;
                    $devices[$cnt]['lights_w'] = $this->processing__maintenance_date($value,$key);
                }elseif($key == 'monthly'){
                    $devices[$cnt][$key] = $value;
                    $devices[$cnt]['lights_m'] = $this->processing__maintenance_date($value,$key);
                }elseif($key == 'yearly'){
                    $devices[$cnt][$key] = $value;
                    $devices[$cnt]['lights_y'] = $this->processing__maintenance_date($value,$key);
                }elseif($key == 'number_of_shuts'){ 
                    $devices[$cnt][$key] = $value; 
                    if($cur_device['id_type'] == '4'){
                        $intervent = Interventions::where('id_machine','=',$cur_device["id"])->orderBy('date', 'DESC')->first();
                        if($intervent['nmb_of_pices'] !== NULL ){
                            $interv_cnt = $intervent['nmb_of_pices'];
                        }else{
                             $interv_cnt = 0;
                        }
                        $cur_count = CollaudoLocale::where('NomeBanco','=',$cur_device['number'])->count();
                        $difference = (int)$cur_count - (int)$interv_cnt;
                        $devices[$cnt]['pce_cnt'] = $difference;
                    }
                    if($cur_device['id_type'] == '3'){
                        $intervent = Interventions::where('id_machine','=',$cur_device["id"])->orderBy('date', 'DESC')->first();
                        $devices[$cnt]['mini_cnt'] = $intervent['nmb_of_shuts'];
                    }
                }
                else{
                    $devices[$cnt][$key] = $value;
                }
            }
                
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
         
            $devices[$cnt]['status'] = $cur_device['status'];
             
            $cnt++;
             
        }
 
        $device_type = DeviceTypes::find($id);
        $date = new DateTime();
        $date->add(new DateInterval('P7D'));

       
       
        return view('devices_list',['menten_date'=>$date->format('Y-m-d'),'fields'=>$fields,'devices'=>$devices,'device_type'=>$device_type]);
    }
    public function type_inregistration_view($id_disp,$id_type){
        $device_type = DeviceTypes::find($id_type);
        $device = Devices::find($id_disp);

        return view('type_inregistration',['device'=>$device,'id'=>$id_type,'device_types'=>$device_type]);
    }

    public function download_info ($id){
        $device = Devices::find($id);

        $file = 'storage/admin/'.$device->info_img;


        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-disposition' => 'attachment; filename=result',
        ];

        return response()->download($file,basename($device->info_img), $headers);

    }

    public function get_by_id_type(Request $request)
    {

        $machines_by_type = Devices::where('id_type','=',$request->id)->where('status','=','Production')->get(['inventory_number','id']);
        $maintenented_machines = Interventions::where('id_type_machine','=',$request->id)
                                              ->where('id_type','=','55')
                                              ->whereBetween('date',[Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])
                                              ->with('device')
                                              ->get()->ToArray();
                     

         // $diff = array_intersect($maintenented_machines,$machines_by_type);
 // var_dump($machines_by_type);   
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
