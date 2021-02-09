@extends('layouts.app')

@section('content')

<div class="container">
 
    <div class="row justify-content-center">
        <div class="col-md-8">
           <form>
              <div class="form-group">
                <label for="exampleFormControlInput1">Email address</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
              </div>
              <div class="form-group">
                <label for="exampleFormControlSelect1">Example select</label>
                <select class="form-control" id="exampleFormControlSelect1">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
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
