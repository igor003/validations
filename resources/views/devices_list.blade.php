@extends('layouts.app')

@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('css/table_head_holder.css') }}" >
<div class="container">
   

    <div class="row justify-content-center">
      <div class="col-md-2 text-left">
          <a href="{{url()->previous()}}"><button class="btn btn-primary" type="submit">Back</button></a>
       </div>
        <div class="col-md-8 text-center">
           <h2><b>MACHINES LIST: {{$device_type->name}} </b></h2>
       </div>
     
    

 
    </div>
    <div class="row justify-content-center">
        <img height='250px'  src="{{ asset('storage/admin/'.$device_type->img_path) }}" alt="">
    </div>
    <br>  
    <div class="row justify-content-center">
        <div class="col-md-12">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr> 
                        @if($device_type['id'] == '3')
                            <th colspan="9" class='align-middle text-center bg-info'>General information</th>
                        @elseif($device_type['id'] == '4')
                            <th colspan="8" class='align-middle text-center bg-info'>General information</th>
                        @else
                            <th colspan="7" class='align-middle text-center bg-info'>General information</th>
                        @endif
                       
                        @if($device_type['periodicity'] !== 0)
                            <th colspan="2" class='align-middle text-center bg-success'>Validation</th>
                        @else
                            <th colspan="1" class='align-middle text-center bg-success'>Validation</th>
                        @endif
                        <th colspan="{{count($fields)+1}}" class='align-middle text-center bg-secondary'>Maintenance </th>
                    
                    </tr>
                   
                    <tr>
                        <th class='text-center align-middle bg-info' scope="col">Number</th>
                        <th class='text-center align-middle bg-info' scope="col">Inventory number</th>
                        <th class='text-center align-middle bg-info' scope="col">Serial number</th>
                        @if($device_type['id'] == '3')
                            <th class='text-center align-middle bg-info' scope="col">Total number of shuts</th>
                        @endif
                        <th class='text-center align-middle bg-info' scope="col">Maker</th>
                        @if($device_type['id'] == '4')
                            <th class='text-center align-middle bg-info' scope="col">Project</th>
                        @endif
                        <th class='text-center align-middle bg-info' scope="col">Model</th>
                        <th class='text-center align-middle bg-info' scope="col">Status</th>
                      
                        <th class='text-center align-middle bg-info' scope="col">Date of registration</th>
                        @if($device_type['id'] == '3')
                            <th class='text-center align-middle bg-info' scope="col">Info</th>
                        @endif
                            <th class='text-center align-middle bg-success' scope="col">Last validation date</th>
                        @if($device_type['periodicity'] == 0)

                        @else
                            <th class='text-center align-middle bg-success' scope="col">Next validation date</th>
                        @endif
                       
                       
                        @foreach($fields as $field)
                            <th  class='text-center align-middle w-125 bg-secondary' scope="col">{{str_replace('_',' ',ucfirst($field))}}</th>
                        @endforeach
                        
                        <th class='text-center align-middle bg-secondary' scope="col">Note</th> 
                       
                    </tr>
                </thead>
                <tbody>
 
                   @foreach($devices as $device)
                 
                        <tr>
                            <td class='text-center'><a href="/type_inregistration/{{$device['id']}}/{{$device_type->id}}"><button type="button" class="btn btn-outline-info">{{$device['number']}}</button></a></td> 
                            <td class='text-center'>{{$device['inventory_number']}}</td>
                            <td class='text-center'>{{$device['serial_number']}}</td>
                            @if($device_type['id'] == '3')
                                <td class='text-center'>{{$device['mini_cnt']}}</td>
                            @endif


                            <td class='text-center'>{{Str::upper($device['maker'])}}</td>
                            @if($device_type['id'] == '4')   
                                <td class='text-center'>{{$device['project']}}</td>
                            @endif
                            <td class='text-center'>{{$device['model']}}</td>
                            <td class='text-center'>{{$device['status']}}</td>
                            <td class='text-center'>{{$device['start_date']}}</td> 
                            @if($device_type['id'] == '3')
                                @if($device['info_img'] == null)
                                    <td><img height=35px src="{{asset('img/error_file.png')}}" alt="download"></td>
                                @else
                                    <td><a href="/device/info_download/{{$device['id']}}"><img height=35px src="{{asset('img/download.png')}}" alt="download"></a></td>
                                @endif
                            @endif
                            <td class='text-center'>{{$device['prev_date']}}</td>
                            @if($device_type['periodicity'] == 0)

                            @else
                                @if($device['range'] && $device_type['periodicity'] > 0 &&  $device['status'] !=='Send' && $device['status']!=='Reserve')
                                    @if(date("Y-m-d")<$device['next_date'] && date("Y-m-d")<$device['range'])
                                        <td class='text-center data_ok'>{{$device['next_date']}}</td>
                                    @elseif(date("Y-m-d")<$device['next_date'] && date("Y-m-d")>$device['range'] || date("Y-m-d") == $device['range']|| date("Y-m-d") == $device['next_date'])
                                        <td class='text-center data_warn '>{{$device['next_date']}}</td>
                                    @elseif(date("Y-m-d")>$device['next_date'] && date("Y-m-d")>$device['range'] && $device['status'] == 'Production')
                                        <td class='text-center data_nok '>{{$device['next_date']}}</td>
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
                            

                            @foreach($fields as $field)
                             
                               <!--  @if($device[$field])
                                    <td class='text-center bg-success'>{{$device[$field]}}</td>
                                    
                                @else
                                    <td class='text-center bg-warning'>{{$device[$field]}}</td>  
                                @endif -->
                                    @if($field === 'weekly')
                                        @if($device['lights_w'] === false )
                                            <td class='text-center'>{{$device[$field]}}</td>
                                        @elseif($device['lights_w'] === 'info') 
                                            <td class='text-center data_info'>{{$device[$field]}}</td>
                                        @elseif($device['lights_w'] === 'success')
                                            <td class='text-center data_ok'>{{$device[$field]}}</td>
                                        @elseif($device['lights_w'] === 'warning')
                                            <td class='text-center data_warn'>{{$device[$field]}}</td>
                                        @elseif($device['lights_w'] === 'danger')
                                            <td class='text-center data_nok'>{{$device[$field]}}</td>
                                        @elseif($device['lights_w'] === 'secondary')
                                            <td class='text-center data_mis'>{{$device[$field]}}</td>
                                        @else
                                            <td class='text-center'>{{$device[$field]}}</td>
                                        @endif
                                    @endif
                                    @if($field === 'monthly')
                                        @if($device['lights_m'] === false )
                                            <td class='text-center'>{{$device[$field]}}</td>
                                        @elseif($device['lights_m'] === 'info') 
                                            <td class='text-center data_info'>{{$device[$field]}}</td>
                                        @elseif($device['lights_m'] === 'success')
                                            <td class='text-center data_ok'>{{$device[$field]}}</td>
                                        @elseif($device['lights_m'] === 'warning')
                                            <td class='text-center data_warn'>{{$device[$field]}}</td>
                                        @elseif($device['lights_m'] === 'danger')
                                            <td class='text-center data_nok'>{{$device[$field]}}</td>
                                        @elseif($device['lights_m'] === 'secondary')
                                            <td class='text-center data_mis'>{{$device[$field]}}</td>
                                        @else
                                            <td class='text-center  '>{{$device[$field]}}</td>
                                        @endif
                                    @endif
                                    @if($field === 'yearly')
                                        @if($device['lights_y'] === false )
                                            <td class='text-center'>{{$device[$field]}}</td>
                                        @elseif($device['lights_y'] === 'info') 
                                            <td class='text-center '>{{$device[$field]}}</td>
                                        @elseif($device['lights_y'] === 'success')
                                            <td class='text-center data_ok'>{{$device[$field]}}</td>
                                        @elseif($device['lights_y'] === 'warning')
                                            <td class='text-center data_warn'>{{$device[$field]}}</td>
                                        @elseif($device['lights_y'] === 'danger')
                                            <td class='text-center data_nok'>{{$device[$field]}}</td>
                                        @elseif($device['lights_y'] === 'secondary')
                                            <td class='text-center data_mis'>{{$device[$field]}}</td>
                                        @else
                                            <td class='text-center'>{{$device[$field]}}</td>
                                        @endif
                                    @endif

                                    @if($field === 'number_of_shuts')
                                        @if($device_type['id'] == '4')
                                            @if($device['pce_cnt'] === 'n/a')
                                                <td class='text-center '>{{$device['pce_cnt']}}</td>
                                            @elseif($device['pce_cnt'] < 9000)
                                                <td class='text-center data_ok'>{{$device['pce_cnt']}}</td>
                                            @elseif($device['pce_cnt'] > 9000 && $device['pce_cnt']<10000)
                                                <td class='text-center data_warn'>{{$device['pce_cnt']}}</td>
                                            @elseif($device['pce_cnt'] > 10000)
                                                <td class='text-center data_nok'>{{$device['pce_cnt']}}</td>
                                            @else
                                                <td class='text-center data_mis'>{{$device['pce_cnt']}}</td>
                                            @endif
                                        @endif
                                        @if($device_type['id'] == '3')

                                          <!--   @if(array_key_exists('mini_differ', $device))
                                                @if($device['mini_differ'] < 200000)
                                                    <td class='text-center data_ok'>{{$device['mini_differ']}}</td>
                                                @else
                                                    <td class='text-center data_nok'>{{$device['mini_differ']}}</td>
                                                @endif
                                            @else
                                                <td class='text-center data_mis'>---</td>
                                            @endif -->
                                      <td class='text-center data_ok'>{{$device['mini_cnt']}}</td>
                                        @endif


                                    @endif
                                    @if($field === 'machine_request')
                                        <td class='text-center'>{{$device[$field]}}</td>
                                    @endif
                            @endforeach
                            <td class='text-center'>{{$device['note']}}</td>

                        </tr>
                    @endforeach
                 </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
