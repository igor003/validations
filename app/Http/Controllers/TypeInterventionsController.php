<?php

namespace App\Http\Controllers;
use App\TypeInterventions;
use App\DeviceTypes;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\TypeMentenance;
class TypeInterventionsController extends Controller
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
    public function list_by_machine_mentenance_type(Request $request)
    {

        $interventions_list = TypeInterventions::where('id_type','=',$request->id_mentenance)->where('id_device','=',$request->id_machine_type)->orderBy('name', 'asc')->get();
       
        return Response::json($interventions_list);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Interventions  $interventions
     * @return \Illuminate\Http\Response
     */
    public function show(Interventions $interventions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Interventions  $interventions
     * @return \Illuminate\Http\Response
     */
    public function edit(Interventions $interventions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Interventions  $interventions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Interventions $interventions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Interventions  $interventions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Interventions $interventions)
    {
        //
    }
}
