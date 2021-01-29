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
                          <td class='text-center'><a href="/device/validation/{{$device['id']}}"><button type="button" class="btn btn-outline-info">{{$device['number']}}</button></a></td> 
                          <td class='text-center'>{{$device['serial_number']}}</td>
                          <td class='text-center'>{{$device['inventory_number']}}</td>
                          <td class='text-center'>{{$device['maker']}}</td>
                          <td class='text-center'>{{$device['model']}}</td>
                          <td class='text-center'>{{$device['start_date']}}</td>
                          <td class='text-center'>{{$device['prev_date']}}</td>
                          @if($device['range'])
                              @if(date("Y-m-d")<$device['next_date'] && date("Y-m-d")<$device['range'])
                              <td class='text-center bg-success'>{{$device['next_date']}}</td>
                              @elseif(date("Y-m-d")<$device['next_date'] && date("Y-m-d")>$device['range'])
                               <td class='text-center bg-warning'>{{$device['next_date']}}</td>
                              @elseif(date("Y-m-d")>$device['next_date'] && date("Y-m-d")>$device['range'])
                              <td class='text-center bg-danger'>{{$device['next_date']}}</td>
                              @else
                              <td class='text-center bg-danger'>{{$device['next_date']}}</td>
                              @endif
                              <td class='text-center'>{{$device['status']}}</td>
                           @else
                           <td class='text-center bg-danger'>{{$device['next_date']}}</td>
                          <td class='text-center'>{{$device['status']}}</td>
                        @endif



                        </tr>
                    @endforeach
                   
                 </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
