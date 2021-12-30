@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('css/table_head_holder_type.css') }}" >
<div class="container">
    
    <div class="row justify-content-center">
     <div class='col-md-12 text-center'>
        <h2><b>TYPES OF MACHINES AND EQUIPMENTS</b></h2>
      </div> 
      
          <div class='col-md-12 text-center'>
            <img height='300' src="img/machines list.png" alt="">

        </div>

    </div>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                    <tr>    
                        <th rowspan="3" class='align-middle text-center bg-info border' scope="col">Type</th>
                        <th rowspan="3" class='align-middle text-center bg-info border' scope="col">Quantity</th>
                        <th rowspan="3" class='align-middle text-center bg-info border' scope="col">Validation periodicity (months)</th>
                        <th colspan="12" class='align-middle text-center font-weight-bold bg-info border'>MAINTENANCE PLAN</th> 
                    </tr>
                    <tr>  
                      <th colspan="6" class='align-middle text-center bg-info border'>Ordinary maintenance</th>
                      <th colspan="6" class='align-middle text-center bg-info border'>Predictive maintenance</th>
                    </tr>
                    <tr>
                        <td width="10%" class='align-middle text-center bg-info border'>daily</td>
                        <td width="10%" class='align-middle text-center bg-info border'>weekly</td>
                        <td width="10%" class='align-middle text-center bg-info border'>monthly</td>
                        <td width="10%" class='align-middle text-center bg-info border'>3 months</td>
                        <td width="10%" class='align-middle text-center bg-info border'>6 months</td>
                        <td width="10%" class='align-middle text-center bg-info border'>yearly</td>
                        <td width="10%" class='align-middle text-center bg-info border'>machine request</td>
                        <td width="10%" class='align-middle text-center bg-info border'>number of pieces</td>
                        <td width="10%" class='align-middle text-center bg-info border'>hours</td>
                    </tr>
                </thead>
                <tbody>

                    @foreach($device_types_counts as $device_type_count)
                    
                        <tr>
                          <td class='text-center'><a href="/devices/{{$device_type_count['0']}}"><button id='btn_type'  type="button" class="btn btn-info font-weight-bold">{{$device_type_count['1']}}</button></a></td>
                          <td class='text-center'>{{$device_type_count['2']}}</td>
                           <td class='text-center'>{{$device_type_count['3']}}</td>
                            @if($device_type_count['4'] === 1)  <td class='align-middle text-center h5 hatching-green opacity-50'> </td> @elseif($device_type_count['4'] === null)  @else <td class='align-middle text-center h5 opacity-50'>n/a</td> @endif
                            @if($device_type_count['5'] === 1)  <td class='align-middle text-center h5 hatching-green opacity-50'> </td> @elseif($device_type_count['5'] === null)  @else <td class='align-middle text-center h5 opacity-50'>n/a</td> @endif
                            @if($device_type_count['6'] === 1)  <td class='align-middle text-center h5 hatching-green opacity-50'> </td> @elseif($device_type_count['6'] === null)  @else <td class='align-middle text-center h5 opacity-50'>n/a</td> @endif
                            @if($device_type_count['7'] === 1)  <td class='align-middle text-center h5 hatching-green opacity-50'> </td> @elseif($device_type_count['7'] === null)  @else <td class='align-middle text-center h5 opacity-50'>n/a</td> @endif
                            @if($device_type_count['8'] === 1)  <td class='align-middle text-center h5 hatching-green opacity-50'> </td> @elseif($device_type_count['8'] === null)  @else <td class='align-middle text-center h5 opacity-50'>n/a</td> @endif
                            @if($device_type_count['9'] === 1)  <td class='align-middle text-center h5 hatching-green opacity-50'> </td> @elseif($device_type_count['9'] === null)  @else <td class='align-middle text-center h5 opacity-50'>n/a</td> @endif
                            @if($device_type_count['10'] === 1) <td class='align-middle text-center h5 hatching-green opacity-50'> </td> @elseif($device_type_count['10'] === null) @else <td class='align-middle text-center h5 opacity-50'>n/a</td> @endif
                            @if($device_type_count['11'] === 1) <td class='align-middle text-center h5 hatching-green opacity-50'> </td> @elseif($device_type_count['11'] === null) @else <td class='align-middle text-center h5 opacity-50'>n/a</td> @endif
                            @if($device_type_count['12'] === 1) <td class='align-middle text-center h5 hatching-green opacity-50'> </td> @elseif($device_type_count['12'] === null) @else <td class='align-middle text-center h5 opacity-50'>n/a</td> @endif

                        </tr>
                    @endforeach
                 </tbody>
            </table>
        </div>
    </div> 
</div>
@endsection
