@extends('sms.main')
@section('title','| Create Attendance')
@section('stylesheet')
	{!! Html::style('css/parsley.css') !!}
	{!! Html::style('css/select2.min.css') !!}
@stop
@section('content')
	<div class="row">
		<div class="col-md-6">
		{!! Form::open(['route' => 'sms.attendances.exportcsv','method'=>'post','data-parsley-validate'=>'','files'=>true]) !!}
		        <div class="form-group">
		        <h3>1.Export  Attendance</h3>
		         	{{Form::select('course_id', $courses ,null,['class'=>'form-control form-spacing-top','placeholder' => 'Pick a course...'])}}
			        <input type="text" id="semester" name="semester" class="form-control form-spacing-top" placeholder="Enter Semester">
			       <button type="submit" class="btn btn-success form-spacing-top">Export</button>
		        </div>

		{!! Form::close() !!}
		</div>
		<hr>
	</div>
	<div class="row">
			<div class="col-md-6">
		{!! Form::open(['route' => 'sms.attendances.importcsv','method'=>'post','data-parsley-validate'=>'','files'=>true]) !!}
			<div class="form-group">
			<h3>2.Import Attendance</h3>
			{{Form::label('import','Select Excel(.CSV) file:')}}
			{{Form::file('import',['accept'=>'.csv' ,'class'=>'form-control form-spacing-top'])}}
			</div>
		    {{Form::submit('Import',['class'=>'btn btn-success btn-lg btn-block'])}}
			
			
		{!! Form::close() !!}
		</div>
			</div>


@stop
@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
	{!! Html::script('js/select2.min.js') !!}

	<script type="text/javascript">

	$('.select2-multi').select2();

	function jsFunction(){
					var myselect=document.getElementById("course_id");
					var cc=myselect.options[myselect.selectedIndex].value;

				}
	</script>
@stop