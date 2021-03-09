@extends('layouts.app')

@section('content')

<div class="container">
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
    <div  class="col-md-4 col-offset-4 text-center">
      <form action="/generate_interv_excell_report" method="POST">
        <div class="form-group">
          <label for="type_mcahine">Select type machine</label>
          <select name='type_machine_report' class="form-control" id="type_machine_report">
              <option value ='' selected></option>
            @foreach($machines as $type_device)
                <option value="{{$type_device->id}}">{{$type_device->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="date_interv_report_start">Select date from</label>
          <input value='{{old("date_interv_report_start")}}' name='date_interv_report_start' id="date_timepicker_excell_start" type="text" class="form-control ">
        </div>
        <div class="form-group">
          <label for="date_interv_report_end">Select date until</label>
          <input value='{{old("date_interv_report_end")}}' name='date_interv_report_end' id="date_timepicker_excell_end" type="text" class="form-control ">
        </div>
        <br>  
         <div class="form-group">
          <button type="submit" class="btn btn-outline-success btn-lg btn-block">Generate Excell</button>
        </div>

      </form>
    </div>
  </div>
</div>
@endsection
