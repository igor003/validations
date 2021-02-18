<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreInterventionRequest;
use App\Interventions;
use App\TypeMentenance;
use App\DeviceTypes;
use App\Devices;
use App\User;
use App\InterventionsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
class InterventionsController extends Controller
{
    public function index()
    {
        $type_mentenance = TypeMentenance::all();
        $types_machines = DeviceTypes::all();
        return view ('add_intervention',['types_mentenance'=>$type_mentenance,'device_types'=>$types_machines]);
    }

    public function store(StoreInterventionRequest $request)
    {
        if($request->report !=''){
            $file_decision = $request->file('report')->getClientOriginalName();
            $path = $request->file('report')->storeAs('public\\admin\\files\\reports', $file_decision);
        }
        $intervention = new Interventions;

        $intervention->date = $request->date;
        $intervention->id_type_mentenance = $request->type_mentenance;
        $intervention->id_machine = $request->device;
        $intervention->id_type_machine = $request->type_machine;
        $intervention->id_type = $request->intervention; 
        $intervention->duration = $request->duration;
        $intervention->id_user =  Auth::user()->id;
        if($request->report !=''){
            $intervention->report_path = $path ;
        }
        $intervention->note = $request->note;
        $intervention->save();

         return redirect(route('interv_list',['id'=>$request->type_machine]));
    }

    public function get_by_machine_type_id( Request $request )
    {
        $interventions = Interventions::where('id','>','0');
        if($request->user != ''){
            $interventions->user($request->user);
        }
        if($request->id_mentenance != ''){
           $interventions->maintenance($request->id_mentenance);
        }
        if($request->id_device != ''){
            $interventions->machine($request->id_device);
        }
        if($request->start_date !='' && $request->end_date !=''){
            $interventions->date($request->start_date,$request->end_date);
        }
      
        
        return Response::json($interventions->where('id_type_machine','=',$request->id)->links()->orderBy('date','Desc')->get());
    }

    public function show($id)
    {
        $type_mentenance = TypeMentenance::all();
        
        $type_machine = DeviceTypes::find($id);
        $diveces = Devices::where('id_type','=',$id)->get();
        $users = User::all();
        return view('interventions_list',['users'=>$users,'types_mentenance'=>$type_mentenance,'devices'=>$diveces,'id'=>$id,'type_machine'=>$type_machine]);
    }
}
