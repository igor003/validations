@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<form action="/inreg_interventions" method="POST">      
				<div class="form-group">
					<label for="datepicker">Select date</label>
					<input id="datepicker" type="text" class="form-control ">
				</div>
				<div class="form-group">
					<label for="type_mentenance">Select type of mentenance</label>
					<select name='type_mentenance' class="form-control" id="type_mentenance">
							<option value ='' selected></option>
						@foreach($types_mentenance as $type_mentenance)
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
						<input name='duration' id="timepicker" type="text" class="form-control ">
				</div> 
				<div class="for-group">
					 <label for="inputGroupFile01">Upload report</label><br>
					<div class="input-group mb-3">
					    <input name='report' type="file" class="custom-file-input" id="inputGroupFile01">
					    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
					</div>
				</div>  
				<div class="form-group">
					<label for="type_mcahine">Note</label>
					<textarea name='note' class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-outline-success btn-lg btn-block">Submit</button>
				</div>
			</form>
		</div>
	</div> 
</div>

@endsection