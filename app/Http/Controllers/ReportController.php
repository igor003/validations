<?php

namespace App\Http\Controllers;

use App\Validations;
use Illuminate\Http\Request;
use App\Devices;
use App\DeviceTypes;
class ReportController extends Controller
{
   
    public function show(){
          $minis = Devices::where('id_type','=',3)->where('status','Production')->orderBy('start_date','DESC')->get();
 
          $results =array();
          foreach($minis as $mini){
               $validations = Validations::where('id_device','=',$mini->id)->orderBy('start_date','ASC')->get();
               $valid_dates = array();
              
               foreach($validations as $validation){
                    $valid_dates[$mini->inventory_number ][] = ['type'=>$validation->type,'date'=>$validation->start_date];
                
               }
               $result[] =  $valid_dates;
            
              
          }
         
        return view('report_mini',['params'=>$result]);
    }
    public function edit(Request $requestl){
        //
    }

    public function update(Request $request){

    }
    
}
