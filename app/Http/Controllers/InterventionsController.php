<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreInterventionRequest;
use App\Interventions;
use App\TypeMentenance;
use App\DeviceTypes;
use App\InterventionsModel;
use Illuminate\Http\Request;

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
        $intervention->id_type = $request->intervention;
        $intervention->duration = $request->duration;
        if($request->report !=''){
            $intervention->report_path = $path ;
        }
        $intervention->note = $request->note;
        $intervention->save();
    }

    public function show($id)
    {
        $interventions = Interventions::where('id_machine','')
        return view('interventions_list');
    }
}
