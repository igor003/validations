@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-3">	
		@if ($errors->any())
			<div id='card' class="card text-white bg-danger mb-3" style="max-width: 18rem;">
	  			<div class=" text-center card-header">ERROR</div>
	  			<div class="card-body text-center">
	    		     <p class="card-text">
	    				@foreach ($errors->all() as $error)
      						{{ $error }}<br> <hr>
						@endforeach
  		             </p>
	  			</div>
			</div>	
		@endif
		</div>
		<div class="col-md-6">
			<form action="/inreg_interventions" method="POST" enctype="multipart/form-data">      
				<div class="form-group">
					<label for="datepicker">Select date</label>
					<input value='{{old("date")}}' name='date' id="datepicker" type="text" class="form-control ">
				</div>
				<div class="form-group">
					<label for="type_mentenance">Select type of mentenance</label>
					<select name='type_mentenance' class="form-control" id="type_mentenance">
							<option value ='{{old("type_mentenance")}}' selected></option>
						@foreach($types_mentenance as $type_mentenance)
						@if($type_mentenance->id == old("type_mentenance") )
								<option selected value="{{$type_mentenance->id}}">{{$type_mentenance->name}}</option>
						@endif
								<option value="{{$type_mentenance->id}}">{{$type_mentenance->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label for="type_mcahine">Select type machine</label>
					<select name='type_machine' class="form-control" id="type_machine">
							<option value ='' selected></option>
						@foreach($device_types as $type_device)
								<option value="{{$type_device->id}}">{{$type_device->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label for="devices">Select inventory number</label>
					<select disabled='disabled' name='device' class="form-control" id="devices">
							<option value ='' selected></option>
					</select>
				</div>
				<div class="form-group">
					<label for="type_mcahine">Select intervention</label>
					<select disabled='disabled' name='intervention' class="form-control" id="intervention">
							<option value ='' selected></option>
					</select>
				</div>
				 <div class="form-group">
						<label for="timepicker">Enter duration of intervention ( hour:minute )</label>
						<input value="{{old('duration')}}" name='duration' id="timepicker" type="text" class="form-control ">
				</div> 
		        <div class=" form-group ">
		          <div class="file-field">
		            <label for="document">Report</label><br>
		              <a class="btn-floating peach-gradient mt-0 float-left">
		                <i class="fas fa-paperclip" aria-hidden="true"></i>
		                <input name='report' type="file">
		              </a>
		          </div>
		        </div>
				<div class="form-group">
					<label for="type_mcahine">Note</label>
					<textarea name='note' class="form-control" id="exampleFormControlTextarea1" rows="3">{{old("note")}}</textarea>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-outline-success btn-lg btn-block">Submit</button>
				</div>
			</form>
		</div>
		<div class="col-md-3">	
		</div>
	</div> 
</div>

@endsection
