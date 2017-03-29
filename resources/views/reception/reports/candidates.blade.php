@extends('reception.main')
@section('title','| Candidates Entrance')

@section('content')
	<div class="row">
		<div class="col-md-3">
			<h2>{{ isset($title)?$title:"" }} Candidates Entrance Report</h2>
		</div>

		<div class="col-md-6">
		
			{!!Form::open(['route'=>'reception.reports.exportCandidates','method'=>'get'])!!}
		      
		
				{{Form::label('course_id','Course:')}}
			    {{Form::select('course_id', $courses ,null,['class'=>'form-control','placeholder' => 'Pick a course...'])}}

				{{Form::label('session','Session:')}}
			    {{Form::text('session',null,['class'=>'form-control','data-parsley-type'=>'digits','maxlength'=>'4'])}}


				<br>
			    <div class="col-md-6 col-md-offset-4">
					<input type="image" src="/img/excel.png" alt="Submit" width="80">
				</div>

				<!--{{Form::submit('Export to Excel',['class'=>'btn btn-success btn-lg btn-block','style'=>'margin-top:20px'])}}-->

		         
			{!!Form::close()!!}



		<hr>
	
	</div>
	</div>
@stop