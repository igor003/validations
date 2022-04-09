@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-1"></div>
  <div class="col-md-10">
    <table class="table table-bordered">
@foreach($params as $resultates)
@if(!empty($resultates))
<tr>
    <td>  {{array_key_first($resultates)}}</td>
    @foreach($resultates[array_key_first($resultates)] as $row)
    @if($row['type'] == 'Initial')
     <td style='background-color:green'>{{$row['type']}}  {{$row['date']}}</td>
     @elseif($row['type'] == 'Ordinary')
      <td style='background-color:orange'>{{$row['type']}}  {{$row['date']}}</td>
      @elseif($row['type'] == 'Extraordinary')
      <td style='background-color:red'>{{$row['type']}}  {{$row['date']}}</td>
    @endif
      
    @endforeach
</tr>
@endif
@continue

@endforeach
  
</table>
  </div>
</div>

@endsection
