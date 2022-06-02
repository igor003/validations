@extends('layouts.app')

@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('css/table_head_holder.css') }}" >
<div class="container-fluid">
   

    <div class="row justify-content-center">
      <div class="col-md-3 text-right">
          <a href="{{url()->previous()}}"><button class="btn btn-primary" type="submit">Back</button></a>
       </div>
        <div class="col-md-6 text-center">
           <h2><b>MACHINES LIST: {{$device_type->name}} </b></h2>
       </div>
       <div class="col-md-3 text-center">
        
       </div>
     
    

 
    </div>
    <div class="row justify-content-center">
        <img height='250px'  src="{{ asset('storage/admin/'.$device_type->img_path) }}" alt="">
    </div>
    <br>  
    <div class="row justify-content-center">
    
                @if($device_type['id'] == '3')
                <div class="col-xl-2 col-lg-0 ">
                <table style='position: sticky;top: 0;'  class='ml-4 table table-bordered '>
                    
                    <tbody>
                        <tr>
                            <td class='text-center bg-secondary text-white font-weight-bold' colspan="2">Number of shuts P2(MC)</td>
                        </tr>
                        <tr>
                            <td class='text-center data_ok'>xxxx</td>
                            <td>nmb. of shuts < {{number_format($miniTargetP2-$miniDifferP2, 0, '', ' ')}}</td>
                        </tr>
                        <tr>
                            <td class='text-center data_warn'>xxxx</td>
                            <td>{{number_format($miniTargetP2-$miniDifferP2, 0, '', ' ')}} < nmb. of shuts < {{number_format($miniTargetP2, 0, '', ' ')}}</td>
                        </tr>
                        <tr>
                            <td class='text-center data_nok'>xxxx</td>
                            <td>nmb. of shuts > {{number_format($miniTargetP2, 0, '', ' ')}}</td>
                        </tr>
                        <tr>
                            <td class='text-center bg-secondary text-white font-weight-bold' colspan="2"> Number of shuts P1(TSA) </td>
                        </tr>
                        <tr>
                            <td class='text-center data_ok'>xxxx</td>
                            <td>nmb. of shuts < {{number_format($miniTargetP1-$miniDifferP1, 0, '', ' ')}}</td>
                        </tr>
                        <tr>
                            <td class='text-center data_warn'>xxxx</td>
                            <td>{{number_format($miniTargetP1-$miniDifferP1, 0, '', ' ')}} < nmb. of shuts < {{number_format($miniTargetP1, 0, '', ' ')}}</td>
                        </tr>
                        <tr>
                            <td class='text-center data_nok'>xxxx</td>
                            <td>nmb. of shuts < {{$miniTargetP1}}</td>
                        </tr>
                    </tbody>
                </table>
                </div>
            @elseif($device_type['id'] == '4')
                 <div class="col-xl-2 col-lg-0 ">
                <table style='position: sticky;top: 0;'  class='ml-4 table table-bordered legend '>
                    <tbody>
                        <tr>
                            <td class='text-center bg-secondary text-white font-weight-bold' colspan="2"> Number of shuts</td>
                        </tr>
                        <tr>
                            <td class='text-center data_ok'>xxxx</td>
                            <td>nmb. of shuts < {{$pceTarget - $pceDiffer}}</td>
                        </tr>
                        <tr>
                            <td class='text-center data_warn'>xxxx</td>
                            <td>{{$pceTarget - $pceDiffer}} < nmb. of shuts < {{$pceTarget}}</td>
                        </tr>
                        <tr>
                            <td class='text-center data_nok'>xxxx</td>
                            <td>nmb. of shuts < {{$pceTarget}}</td>
                        </tr>
                    </tbody>
                </table>
                </div>
            @endif
    
        <div class="col-xl-6 col-lg-12">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr> 
                        @if($device_type['id'] == '3')
                            <th colspan="12" class='align-middle text-center bg-info'>General information</th>
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
                        <th style="width: 5.66%" class='text-center align-middle bg-info' scope="col">Number</th>
                        @if($device_type['id'] == '3')
                            <th style="width: 6%" class='text-center align-middle bg-info' scope="col">Process</th>
                        @endif
                        <th style="width: 7%" class='text-center align-middle bg-info' scope="col">Inventory number</th>
                       
                        @if($device_type['id'] == '3')
                            <th style="width: 6%" class='text-center align-middle bg-info' scope="col">Storage cell</th>
                        @endif
                        <th class='text-center align-middle bg-info' scope="col">Serial number</th>
                       
                        <th  style="width: 7%"class='text-center align-middle bg-info' scope="col">Maker</th>
                        @if($device_type['id'] == '4')
                            <th class='text-center align-middle bg-info' scope="col">Project</th>
                        @endif
                        <th class='text-center align-middle bg-info' scope="col">Model</th>
                        <th class='text-center align-middle bg-info' scope="col">Status</th>
                      
                        <th class='text-center align-middle bg-info' scope="col">Date of registration</th>
                        @if($device_type['id'] == '3')
                            <th class='text-center align-middle bg-info' scope="col">Info</th>
                            <th class='text-center align-middle bg-info' scope="col">Data sheet</th>
                            <th class='text-center align-middle bg-info' scope="col">Total number of shuts</th>
                        @endif
                            <th class='text-center align-middle bg-success' scope="col">Last date</th>
                        @if($device_type['periodicity'] == 0)

                        @else
                            <th class='text-center align-middle bg-success' scope="col">Next date</th>
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
                            <td class='text-center'>
                                <a href="/type_inregistration/{{$device['id']}}/{{$device_type->id}}">
                                    <button type="button" class="btn btn-outline-info">{{$device['number']}}</button>
                                </a>
                            </td> 
                            @if($device_type['id'] == '3')
                                <td class='text-center'>{{$device['project']}}</td>
                            @endif
                            <td class='text-center'>{{$device['inventory_number']}}</td>
                            <!-- процесс -->
                            @if($device_type['id'] == '3')
                                <td class='text-center'>{{$device['ordin_nmb']}}</td>
                            @endif
                            <td class='text-center'>{{$device['serial_number']}}</td>
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
                                @if($device['data_sheet_path'] == null)
                                    <td><img height=35px src="{{asset('img/error_file.png')}}" alt="download"></td>
                                @else
                                    <td><a href="/device/data_sheet_download/{{$device['id']}}"><img height=35px src="{{asset('img/download.png')}}" alt="download"></a></td>
                                @endif
                                <td class='text-center'>{{$device['mini_cnt']}}</td>
                            @endif
                            <td class='text-center'>{{$device['prev_date']}}</td>
                            @if($device_type['periodicity'] == 0)

                            @else
                                @if($device['range'] && $device_type['periodicity'] > 0 &&  $device['status'] !=='Send' && $device['status']!=='Reserve')
                                    @if($curdate < strtotime($device['next_date']) && $curdate < strtotime($device['range']))
                                        <td class='text-center data_ok'>{{$device['next_date']}}</td>
                                    @elseif($curdate < strtotime($device['next_date']) && $curdate > strtotime($device['range']) || $curdate == strtotime($device['range'])|| $curdate == strtotime($device['next_date']))
                                        <td class='text-center data_warn '>{{$device['next_date']}}</td>
                                    @elseif($curdate > strtotime($device['next_date']) && $curdate > strtotime($device['range']) && $device['status'] == 'Production')
                                        <td class='text-center data_nok '>{{$device['next_date']}}</td>
                                    @elseif($curdate > strtotime($device['next_date']) && $curdate > strtotime($device['range']) && ($device['status'] == 'Reserve' || $device['status'] == 'Send') )
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
                                        @elseif($device['pce_cnt'] < ($pceTarget - $pceDiffer))
                                            <td class='text-center data_ok'>{{$device['pce_cnt']}}</td>
                                        @elseif($device['pce_cnt'] > ($pceTarget - $pceDiffer) && $device['pce_cnt'] < $pceTarget)
                                            <td class='text-center data_warn'>{{$device['pce_cnt']}}</td>
                                        @elseif($device['pce_cnt'] > $pceTarget)
                                            <td class='text-center data_nok'>{{$device['pce_cnt']}}</td>
                                        @else
                                            <td class='text-center data_mis'>{{$device['pce_cnt']}}</td>
                                        @endif
                                    @endif
                                    @if($device_type['id'] == '3')
                                        @if(array_key_exists('mini_differ', $device))
                                            @if($device['project'] == 'P2(MC)')
                                                @if($device['mini_differ'] < $miniTargetP2-$miniDifferP2)
                                                    <td class='text-center data_ok'>{{$device['mini_differ']}}</td>
                                                @elseif($device['mini_differ'] > $miniTargetP2-$miniDifferP2 && $device['mini_differ'] < $miniTargetP2 )
                                                    <td class='text-center data_warn'>{{$device['mini_differ']}}</td>
                                                @else
                                                    <td class='text-center data_nok'>{{$device['mini_differ']}}</td>
                                                @endif
                                            @elseif($device['project'] == 'P1(TSA)')
                                                @if($device['mini_differ'] < $miniTargetP1)
                                                    <td class='text-center data_ok'>{{$device['mini_differ']}}</td>
                                                @elseif($device['mini_differ'] > ($miniTargetP1-$miniDifferP1 ) && $device['mini_differ'] < $miniTargetP1 )
                                                    <td class='text-center data_warn'>{{$device['mini_differ']}}</td>
                                                @else
                                                    <td class='text-center data_nok'>{{$device['mini_differ']}}</td>
                                                @endif
                                            @else
                                                <td class='text-center data_mis'>{{$device['mini_differ']}}</td>
                                            @endif
                                        @else
                                            <td class='text-center data_mis'>---</td>
                                        @endif
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
        <div class="col-xs-3 col-lg-0 justify-content-center">
         
        </div>
    </div>
</div>
@endsection
