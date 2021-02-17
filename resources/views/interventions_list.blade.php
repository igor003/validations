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
          <a href="/home"><button class="btn btn-primary" type="submit">Home</button></a>
       </div>

      <input id='id_type_machine' type="hidden" value='{{$id}}'>
    </div>
    <div class="row justify-content-center">
         <img height='250px'  src="{{ asset('storage/admin/'.$type_machine->img_path) }}" alt="">
    </div>
    <br>  
    <div class="row justify-content-center">
        <div class="col-md-10">
            <table class="table table-bordered">
                <thead>
                    <tr>
                      <th class='text-center' scope="col">Date</th>
                      <th class='text-center' scope="col">Type</th>
                      <th class='text-center' scope="col">Inventory number</th>
                      <th class='text-center' scope="col">Intervention description</th>
                      <th class='text-center' scope="col">Duration</th>
                      <th class='text-center' scope="col">Note</th>
                      <th class='text-center' scope="col">Executor</th>
                      <th class='text-center' scope="col">Download Report</th>
                    </tr>
                </thead>
                <tbody id='interventions_table'>
                  

      
                   
                </tbody>
            </table>
            
        </div>
        <div class="col-md-2">  
          <div class="form-group">
            <label for="filter_interv">Select date from</label>
            <input value='{{old("date_timepicker_start")}}' name='date_timepicker_start' id="date_timepicker_start" type="text" class="form-control ">
          </div>
          <div class="form-group">
            <label for="filter_interv">Select date to</label>
            <input value='{{old("date_timepicker_end")}}' name='date_timepicker_end' id="date_timepicker_end" type="text" class="form-control ">
          </div>
       <div class="form-group">
          <label for="type_mentenance">Select type of mentenance</label>
          <select name='type_mentenance' class="form-control" id="type_mentenance">
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
          <label for="type_mcahine">Select type machine</label>
          <select name='type_machine' class="form-control" id="type_machine">
              <option value ='' selected></option>
            @foreach($device_types as $type_device)
                <option value="{{$type_device->id}}">{{$type_device->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="devices">Select inventory number</label>
          <select disabled='disabled' name='device' class="form-control" id="devices">
              <option value ='' selected></option>
          </select>
        </div>
        <div class="form-group">
          <label for="type_mcahine">Select intervention</label>
          <select disabled='disabled' name='intervention' class="form-control" id="intervention">
              <option value ='' selected></option>
          </select>
        </div>
        <div class="form-group">
          <label for="type_mcahine">Select executor</label>
          <select  name='user' class="form-control" id="user">
            @foreach($users as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
             >
          </select>
        </div>
        </div>  
    </div>
</div>
@endsection
