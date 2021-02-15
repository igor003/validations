<?php

namespace App\Http\Controllers;
use App\Interventions;
use App\TypeMentenance;
use App\DeviceTypes;
use App\InterventionsModel;
use Illuminate\Http\Request;

class InterventionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type_mentenance = TypeMentenance::all();
        $types_machines = DeviceTypes::all();
        return view ('add_intervention',['types_mentenance'=>$type_mentenance,'device_types'=>$types_machines]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($request->report !=''){
            $file_decision = $request->file('report')->getClientOriginalName();
            $path = $request->file('report')->storeAs('public\\admin\\files\\reports\\', $file_decision);
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

    /**
     * Display the specified resource.
     *
     * @param  \App\InterventionsModel  $interventionsModel
     * @return \Illuminate\Http\Response
     */
    public function show(InterventionsModel $interventionsModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InterventionsModel  $interventionsModel
     * @return \Illuminate\Http\Response
     */
    public function edit(InterventionsModel $interventionsModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InterventionsModel  $interventionsModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InterventionsModel $interventionsModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InterventionsModel  $interventionsModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(InterventionsModel $interventionsModel)
    {
        //
    }
}
