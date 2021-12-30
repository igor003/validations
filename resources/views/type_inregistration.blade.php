@extends('layouts.app')

@section('content')

<div class="container">
      <div class="row justify-content-center">
       
      
    </div>
     <div class="row justify-content-center">

      <div class="col-md-2 text-left">
          <a href="{{url()->previous()}}"><button class="btn btn-primary" type="submit">Back</button></a>
       </div>
        <div class="col-md-8 text-center">
        
       </div>
      <div class="col-md-2 text-right">
          <a href="/home"><button class="btn btn-primary" type="submit">Home</button></a>
       </div>

 
    </div>

<div class="row justify-content-center">
  <div  class="col text-center">
    <div>
     <img height='250px' src="{{asset('img/validations.png')}}" alt="">
    </div>
    <br>
  <div>
    <a href="/device/validation/{{$device->id}}">
      <button type="button" class="btn btn-success btn-lg btn-block">
       <h3> Validations </h3>
      </button>
    </a>
    </div> 
  </div>
  <div class="col text-center"> 
       <img height="250px" src="{{ asset('storage/admin/'.$device_types->img_path) }}" alt="">
      

            <h5>Type: <b> {{$device_types->name}}</b></h5>
            <h5>Number: <b> {{$device->number}}</b></h5>
            <h5>Serial number:<b> {{$device->serial_number}}</b></h5>
            <h5>Inventory number: <b> {{$device->inventory_number}}</b></h5>
            <h5>Model: <b> {{$device->model}}</b></h5>
  </div>  
 <div class="col text-center">
  <div>
     <img height='250px' src="{{asset('img/maintenance.png')}}" alt="">
  </div>
  <br>
   <div>
     <a href="/interventions_list/{{$id}}">
      <button type="button" class="btn btn-primary btn-lg btn-block"> <h3>Maintenance</h3></button>
    </a> 
   </div>
    
 </div>
</div>
   
</div>
@endsection
