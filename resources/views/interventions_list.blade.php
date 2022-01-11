@extends('layouts.app')

@section('content')

<div class="container">
   

    <div class="row justify-content-center">
      <div class="col-md-2 text-left">
          <a href="{{url()->previous()}}"><button class="btn btn-primary" type="submit">Back</button></a>
       </div>
        <div class="col-md-8 text-center">
           <h2><b>INTERVENTIONS LIST: {{$type_machine->name}} </b></h2>
       </div>
      <div class="col-md-2 text-right">
          <a href="/home"><button class="btn btn-primary mr-4" type="submit">Home</button></a>
         <a href="/type_inregistration/{{$type_machine->id}}"><button class="btn btn-primary" type="submit">Main</button></a>
        
         
       </div>

     
    </div>
    <div class="row justify-content-center">        
      <img class='mr-4' height='250px'  src="{{ asset('storage/admin/'.$type_machine->img_path) }}" alt="">

      <img  height='250px' src="{{asset('img/maintenance.png')}}" alt="">
    </div>
    <br>  
    <div class="row justify-content-center">
        <div class="col-md-10">
            <table class="table table-bordered">
                <thead>
                    <tr>
                      <th class='text-center' scope="col">Date</th>
                      <th class='text-center' scope="col">Inventory number</th>
                      <th class='text-center' scope="col">Type</th>
                      
                      <th class='text-center' scope="col">Intervention description</th>
                      <th class='text-center' scope="col">Duration</th>
                      <th class='text-center' scope="col">Note</th>
                      @if($type_machine->id == 9)
                        <th class='text-center' scope="col">Temperature</th>
                      @endif
                      @if($type_machine->id == 3)
                        <th class='text-center' scope="col">Number of shuts</th>
                      @endif
                      <th class='text-center' scope="col">Executor</th>
                      <th class='text-center' scope="col">Optional attached file</th>
                    </tr>
                </thead>
                <tbody id='interventions_table'>
                  

      
                   
                </tbody>
            </table>
            
        </div>
        <div class="col-md-2"> 
      

          @if($type_machine->instruction_path)
           <div class='text-center'><img height='140px' src="{{asset('img/mainten_instruction.png')}}" alt=""><br> <a href="/download__machine_instruction/{{$type_machine->id}}"><button class="btn btn-success" type="submit"> Download work instruction</button></a></div>
           <br>
           @endif
          <form action="/gener_excell_rep_filter" method='POST'>
            <div class="form-group">
              <div class="form-check ">
                <input class="form-check-input" type="checkbox" value='0' id="flexCheckDefault">
                <label class="form-check-label"  for="flexCheckDefault">
                  Time interventions summ
                </label>
              </div>
            </div> 
             <div id='card2' class="form-group">
              <div  class="card text-white bg-info mb-3" style="max-width: 18rem;">
                <div id='sum_time' class=" text-center card-header">Sum of time</div>
              </div>
            </div>
              <div class="form-group">
                <label for="filter_interv">Select date from</label>
                <input value='{{old("date_timepicker_start")}}' name='date_timepicker_start' id="date_timepicker_start" type="text" class="form-control ">
              </div>
              <div class="form-group">
                <label for="filter_interv">Select date to</label>
                <input disabled='disabled' value='{{old("date_timepicker_end")}}' name='date_timepicker_end' id="date_timepicker_end" type="text" class="form-control ">
              </div>
           <div class="form-group">
              <label for="type_mentenance">Select type of mentenance</label>
              <select name='type_mentenance_filter' class="form-control" id="type_mentenance_filter">
                  <option value ='{{old("type_mentenance")}}' selected></option>
                @foreach($types_mentenance as $type_mentenance)
                @if($type_mentenance->id == old("type_mentenance") )
                    <option selected value="{{$type_mentenance->id}}">{{$type_mentenance->name}}</option>
                @endif
                    <option value="{{$type_mentenance->id}}">{{$type_mentenance->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="devices">Select inventory number</label>
              <select  name='device_filter' class="form-control" id="devices_filter">
                 <option value ='' selected></option>
                  @foreach($devices as $device)
                  @if($machine)
                    @if($device->id == $machine->id)
                      <option selected value="{{$device->id}}">{{$device->inventory_number}}</option>
                    @endif
                  @endif
                  
                      <option value="{{$device->id}}">{{$device->inventory_number}}</option>
                  @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="intervention_filter">Select intervention</label>
              <select disabled='disabled' name='intervention_filter' class="form-control" id="intervention_filter">
                  <option value ='' selected></option>
              </select>
            </div>
            <div class="form-group">
              <label for="type_mcahine">Select executor</label>
              <select  name='user' class="form-control" id="user">
                <option selected value=""></option>
                @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
                 
              </select>
            </div>
             <input name='id_type_machine' id='id_type_machine' type="hidden" value='{{$id}}'>
              <div class="form-group">
                  <button type="submit" class="btn btn-outline-success btn-lg btn-block">Generate Excell</button>
            </div>
          </form>
        </div>  
    </div>
</div>
@endsection
