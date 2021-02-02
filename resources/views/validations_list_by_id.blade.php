@extends('layouts.app')

@section('content')

<div class="container">
  


    <div class="row row justify-content-center">
       <div class="col-md-2 text-left">
        
          <a href="{{url()->previous()}}"><button class="btn btn-primary" type="submit">Back</button></a>
       </div>
        <div class="col-md-8 text-center">
           <h2><b> MACNINE VALIDATION HISTORY</b></h2>
        </div>
  <div class="col-md-2 text-right">
          <a href="/home"><button class="btn btn-primary" type="submit">Home</button></a>
       </div>
     
    </div>
      <div class="row row justify-content-center">
          <div class="col-md-12 text-center">
            <h5>Type: <b> {{$device_info->device_type->name}}</b></h5>
            <h5>Number: <b> {{$device_info->number}}</b></h5>
            <h5>Serial number:<b> {{$device_info->serial_number}}</b></h5>
            <h5>Inventory number: <b> {{$device_info->inventory_number}}</b></h5>
            <h5>Model: <b> {{$device_info->model}}</b></h5>
            </div>
   </div>
    
    <br>  
    <div class="row justify-content-center">
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                      <th class='text-center' scope="col">Data</th>
                      <th class='text-center' scope="col">Executor</th>
                      <th class='text-center' scope="col">Type</th>
                      <th class='text-center' scope="col">Decision</th>
                      <th class='text-center' scope="col">Download</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($validations as $validation)
                     <tr>
                     
                        <td class='text-center'>{{$validation->start_date}}</td>
                        <td class='text-center'>{{$validation->executor}}</td>
                        <td class='text-center'>{{$validation->type}}</td>
                        <td class='text-center'>{{$validation->decision}}</td>
                        <td class='text-center'><a href="/valid_download/{{$validation->id}}"><img height=35px src="{{asset('img/download.png')}}" alt="download"></a></td>
                      </tr>
                  @endforeach
                 </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
