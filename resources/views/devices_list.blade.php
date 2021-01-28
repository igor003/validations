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
                  
                    @foreach($devices as $device)
                       <tr>
                          <td class='text-center'><a href="/device/validation/{{$device->id}}"><button type="button" class="btn btn-outline-info">{{$device->number}}</button></a></td> 
                          <td class='text-center'>{{$device->serial_number}}</td>
                          <td class='text-center'>{{$device->inventory_number}}</td>
                          <td class='text-center'>{{$device->maker}}</td>
                          <td class='text-center'>{{$device->model}}</td>
                          <td class='text-center'>{{$device->start_date}}</td>
                          <td class='text-center'>{{$device->start_date}}</td>
                          <td class='text-center'>{{$device->next_valid_date}}</td>
                          <td class='text-center'>{{$device->status}}</td>
                        </tr>
                    @endforeach
                 </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
