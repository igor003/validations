@extends('layouts.app')

@section('content')

<div class="container-fluid">
  


    <div class="row justify-content-center">
       <div class="col-2 text-left">
        
          <a href="{{url()->previous()}}"><button class="btn btn-primary" type="submit">Back</button></a>
       </div>
        <div class="col-3 text-center">
           <h2><b> MACHINE VALIDATION HISTORY</b></h2>
        </div>
        <div class="col-2 text-right">
          <a href="/home"><button class="btn btn-primary mr-4" type="submit">Home</button></a>
           <a href="/devices/{{$device_info->device_type->id}}"><button class="btn btn-primary" type="submit">Main</button></a>
       </div>
        
     
    </div>
    <br>
      <div class="row row justify-content-center">
        <div class="col-md-3"></div>
        <div class="col-md-3 text-right">
           <img height='160px' src="{{asset('img/Arhiv2.png')}}" alt="">
           </div>
          <div class="col-md-3 text-left">
            <h5>Type: <b> {{$device_info->device_type->name}}</b></h5>
            <h5>Number: <b> {{$device_info->number}}</b></h5>
            <h5>Serial number:<b> {{$device_info->serial_number}}</b></h5>
            <h5>Inventory number: <b> {{$device_info->inventory_number}}</b></h5>
            <h5>Model: <b> {{$device_info->model}}</b></h5>
          </div>
           <div class="col-md-3"></div>
           
   </div>
    
    <br>  
    <div class="row justify-content-center">
        <div class="col-md-2">
             <div id="piechart_3d" style="width: 350px; height: 300px;"></div>
        </div>
        <div class="col-md-4">
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
         <div class="col-md-1">
            @if($device_type->valid_instruction_path)
               <div class='text-center'><img height='120px' src="{{asset('img/validation_instr.png')}}" alt=""><br> <a href="/download_validation_instruction/{{$device_info->id_type}}"><button class="btn btn-success" type="submit"> Download validation instruction</button></a></div>
               <br>
           @endif
            
         </div>
    </div>
    
</div>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['type validation', 'Count'],
            ['Extraordinary',  <?php print_r($type_valid['extraordinary']) ?>],
            ['Ordinary',  <?php print_r($type_valid['ordinary']) ?>]
          ]
         );

        var options = {
            title: 'Types of validations',
            is3D: true,
            chartArea:{left:10,top:0,width:'800%',height:'800%'},
            legend:{position: 'right', textStyle: {color: 'black', fontSize: 16}},
            slices: {
                0: { color: 'red' },
                1: { color: 'green' }
            },
           

            
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
@endsection
