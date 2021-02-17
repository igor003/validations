<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreInterventionRequest;
use App\Interventions;
use App\TypeMentenance;
use App\DeviceTypes;
use App\User;
use App\InterventionsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
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

    public function get_by_machine_type_id( Request $request)
    {
        $interventions = Interventions::where('id_type_machine','=',$request->id)->links()->get();
        return Response::json($interventions->toArray());
    }

    public function show($id)
    {
        $type_mentenance = TypeMentenance::all();
        $types_machines = DeviceTypes::all();
        $type_machine = DeviceTypes::find($id);
        $users = User::all();
        // $interventions = Interventions::where('id_machine','')
        return view('interventions_list',['users'=>$users,'types_mentenance'=>$type_mentenance,'device_types'=>$types_machines,'id'=>$id,'type_machine'=>$type_machine]);
    }
}
