@extends('layouts.app')

@section('content')

<div class="container">
   

    <div class="row justify-content-center">
       <h2>{{$device_type->name}}</h2>

 
    </div>
    <div class="row justify-content-center">
        <img height='250px'  src="{{ asset('storage/admin/'.$device_type->img_path) }}" alt="">
   
      
    </div>
    <br>  
    <div class="row justify-content-center">
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                      <th class='text-center' scope="col">Number</th>
                      <th class='text-center' scope="col">Serial number</th>
                      <th class='text-center' scope="col">Inventory number</th>
                      <th class='text-center' scope="col">Maker</th>
                      <th class='text-center' scope="col">Model</th>
                      <th class='text-center' scope="col">Start date</th>
                      <th class='text-center' scope="col">Previos validation date</th>
                      <th class='text-center' scope="col">Next validation date</th>
                      <th class='text-center' scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                   
                 </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
