@extends('layouts.app')

@section('content')

<div class="container">
 
    <div class="row justify-content-center">
        <div class="col-md-8">
           <form>
            
              <div class="form-group">
                <label for="datepicker">Select date</label>
                <input id="datepicker" type="text" class="form-control ">
               
              </div>
              
              <div class="form-group">
                <label for="exampleFormControlSelect1">Select type of mentenance</label>
                <select name='type_mentenance' class="form-control" id="exampleFormControlSelect1">
                    <option value ='' selected></option>
                  @foreach($types_mentenance as $type_mentenance)
                      <option value="{{$type_mentenance->id}}">{{ $type_mentenance->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="exampleFormControlSelect1">Select intervention</label>
                <select name='type_mentenance' class="form-control" id="exampleFormControlSelect1">
                    <option value ='' selected></option>
                  @foreach($types_mentenance as $type_mentenance)
                      <option value="{{$type_mentenance->id}}">{{ $type_mentenance->name}}</option>
                  @endforeach
                </select>
              </div>
           <div class="input-group date">
               <input type="text" class="form-control" >
    <div class="input-group-addon">
        <span class="glyphicon glyphicon-th"></span>
    </div>
          </form>
        </div>
    </div> 
</div>

@endsection
