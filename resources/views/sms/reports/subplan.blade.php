@extends('sms.main')
@section('title','| SC/ST Sub Plan')

@section('content')
	<div class="row">
		<div class="col-md-3">
			<h2>{{ isset($title)?$title:"" }} Sub Plan</h2>
		</div>

		<div class="col-md-6">
		
			{!!Form::open(['route'=>'sms.reports.exportSubPlan','method'=>'get'])!!}
		      
		        {{Form::label('Type','Type:')}}
			    {{Form::select('type', ['1' => 'MIS', '2' => 'SC/ST Sub Plan'],null,['class'=>'form-control','placeholder' => 'Pick report type...'])}}
			
				{{Form::label('course_id','Course:')}}
			    {{Form::select('course_id', $courses ,null,['class'=>'form-control','placeholder' => 'Pick a course...'])}}

				{{Form::label('year','Year of Joining:')}}
			    {{Form::text('year',null,['class'=>'form-control','data-parsley-type'=>'digits','maxlength'=>'4'])}}


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