<?php

namespace App\Http\Controllers;

use App\Interventions;
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
        return view ('add_intervention');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
