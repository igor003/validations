@extends('layouts.app')

@section('content')

<div class="container">
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
    <a href="/devices/{{$id}}">
      <button type="button" class="btn btn-success btn-lg btn-block">
       <h3> Validations </h3>
      </button>
    </a>
    </div> 
  </div>
 <div class="col text-center">
  <div>
     <img height='250px' src="{{asset('img/maintenance.png')}}" alt="">
  </div>
  <br>
   <div>
     <a href="devices/{{$id}}">
      <button type="button" class="btn btn-primary btn-lg btn-block"> <h3>Mentenance</h3></button>
    </a> 
   </div>
    
 </div>
</div>
   
</div>
@endsection
