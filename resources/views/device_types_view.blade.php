@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
      
        <img height='250' src="img/validation_devices.png" alt="">
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <table class="table table-bordered">
                <thead>
                    <tr>
                      <th class='text-center' scope="col">Type</th>
                      <th class='text-center' scope="col">Quantity</th>
                      <th class='text-center' scope="col">Periodicity (months)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($device_types_counts as $device_type_count)
                        <tr>
                          <td class='text-center'><a href="/devices/{{$device_type_count['0']}}"><button type="button" class="btn btn-outline-info">{{$device_type_count['1']}}</button></a></td>
                          <td class='text-center'>{{$device_type_count['2']}}</td>
                           <td class='text-center'>{{$device_type_count['3']}}</td>
                        </tr>
                    @endforeach
                 </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
