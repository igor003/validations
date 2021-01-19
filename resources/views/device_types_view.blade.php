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
                      <th class='text-center' scope="col">Periodicity (months)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($device_types as $device_type)
                        <tr>
                          <td class='text-center'><a href="/devices/{{$device_type->id}}"><button type="button" class="btn btn-outline-info">{{$device_type->name}}</button></a></td>
                          <td class='text-center'>{{$device_type->periodicity}}</td>
                        </tr>
                    @endforeach
                 </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
