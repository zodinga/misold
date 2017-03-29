@extends('reception.main')
@section('title','| Create Entrance')
@section('stylesheet')
	{!! Html::style('css/parsley.css') !!}
	{!! Html::style('css/select2.min.css') !!}
@stop
@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-1">
		{!! Form::open(['route' => 'reception.entrances.exportcsv','method'=>'post','data-parsley-validate'=>'','files'=>true]) !!}
		        <div class="form-group">
		        <h2>1. Export  Entrance</h2>
		         	{{Form::select('course_id', $courses ,null,['class'=>'form-control form-spacing-top','placeholder' => 'Pick a course...'])}}
			        <input type="text" id="session" name="session" class="form-control form-spacing-top" placeholder="Enter Session">
		        </div>
		        <button type="submit" class="btn btn-success form-control form-spacing-top">Submit</button>
		{!! Form::close() !!}
		</div>
		<hr>
	</div>
	<br/>
	<div class="row">
		<div class="col-md-6 col-md-offset-1">
			<h2>2. Import Entrance</h2>
			
		</div>
		<div class="col-md-6 col-md-offset-1">
		{!! Form::open(['route' => 'reception.entrances.importcsv','method'=>'post','data-parsley-validate'=>'','files'=>true]) !!}
			{{Form::label('import','Select Excel(.CSV) file:')}}
			{{Form::file('import',['accept'=>'.csv' ,'class'=>'form-control form-spacing-top'])}}
		
		    {{Form::submit('Import',['class'=>'btn btn-success form-control form-spacing-top','style'=>'margin-top:20px'])}}
			
			
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