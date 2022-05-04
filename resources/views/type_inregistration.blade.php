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
            <h5>Total number of shuts: <b>{{$nmb_of_shuts}} pz</b></h5>
            <h5>Last maintenance: <b>{{$last_valid}}</b></h5>
  </div>  
 <div class="col text-center">
  <div>
     <img height='250px' src="{{asset('img/maintenance.png')}}" alt="">
  </div>
  <br>
   <div>
     <a href="/interventions_list/{{$id}}/{{$device->id}}">
      <button type="button" class="btn btn-primary btn-lg btn-block"> <h3>Maintenance</h3></button>
    </a> 
   </div>
    
 </div>
</div>
<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-4"></div>
  <div class="col-md-4">
    
<div style=" height: 400px;" id="piechart"></div>
  </div>
</div>
   
</div>
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable(
        <?php print_r($type_count)  ?>



          );

          var options = {
            title: 'Types of maintenance',
            is3D: true,
            chartArea:{left:10,top:0,width:'95%',height:'95%'},
            legend:{position: 'bottom', textStyle: {color: 'black', fontSize: 16}}, 

        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
@endsection
