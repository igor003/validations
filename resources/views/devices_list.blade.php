@extends('layouts.app')

@section('content')

<div class="container">
   

    <div class="row justify-content-center">
      <div class="col-md-2 text-left">
          <a href="{{url()->previous()}}"><button class="btn btn-primary" type="submit">Back</button></a>
       </div>
        <div class="col-md-8 text-center">
           <h2><b>MACHINES LIST: {{$device_type->name}} </b></h2>
       </div>
      <div class="col-md-2 text-right">
          <a href="/home"><button class="btn btn-primary" type="submit">Home</button></a>
       </div>

 
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
                       <th class='text-center' scope="col">Inventory number</th>
                      <th class='text-center' scope="col">Serial number</th>
                     
                      <th class='text-center' scope="col">Maker</th>
                      <th class='text-center' scope="col">Model</th>
                      <th class='text-center' scope="col">Date of registration</th>
                      <th class='text-center' scope="col">Last validation date</th>
                      @if($device_type['periodicity'] == 0)

                      @else
                         <th class='text-center' scope="col">Next validation date</th>
                      @endif
                      <th class='text-center' scope="col">Status</th>
                      <th class='text-center' scope="col">Note</th>
                    </tr>
                </thead>
                <tbody>
                  

                   @foreach($devices as $device)
          
                        <tr>

                            <td class='text-center'><a href="/device/validation/{{$device['id']}}"><button type="button" class="btn btn-outline-info">{{$device['number']}}</button></a></td> 
                            <td class='text-center'>{{$device['inventory_number']}}</td>
                            <td class='text-center'>{{$device['serial_number']}}</td>
                            <td class='text-center'>{{$device['maker']}}</td>
                            <td class='text-center'>{{$device['model']}}</td>
                            <td class='text-center'>{{$device['start_date']}}</td>
                            <td class='text-center'>{{$device['prev_date']}}</td>
                            @if($device_type['periodicity'] == 0)
                             
                            @else
                                @if($device['range'] && $device_type['periodicity'] > 0)
                                    @if(date("Y-m-d")<$device['next_date'] && date("Y-m-d")<$device['range'])
                                        <td class='text-center bg-success'>{{$device['next_date']}}</td>
                                    @elseif(date("Y-m-d")<$device['next_date'] && date("Y-m-d")>$device['range'])
                                        <td class='text-center bg-warning '>{{$device['next_date']}}</td>
                                    @elseif(date("Y-m-d")>$device['next_date'] && date("Y-m-d")>$device['range'] && $device['status'] == 'Production')
                                        <td class='text-center bg-danger '>{{$device['next_date']}}</td>
                                    @elseif(date("Y-m-d")>$device['next_date'] && date("Y-m-d")>$device['range'] && ($device['status'] == 'Reserve' || $device['status'] == 'Send') )
                                        <td class='text-center'>{{$device['next_date']}}</td>
                                    @else
                                        <td class='text-center bg-danger'>{{$device['next_date']}}</td>
                                    @endif
                                        
                                @elseif($device['status'] == 'Reserve' || $device['status'] == 'Send')
                                    <td class='text-center'>{{$device['next_date']}}</td>
                                @else
                                    <td class='text-center bg-danger'>{{$device['next_date']}}</td>
                                @endif
                            @endif
                            <td class='text-center'>{{$device['status']}}</td>
                            <td class='text-center'>{{$device['note']}}</td>
                        </tr>
                    @endforeach
                   
                 </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
