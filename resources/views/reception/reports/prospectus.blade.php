@extends('reception.main')
@section('title','| Prospectus Report')

@section('content')
	<div class="row">
		<div class="col-md-3">
			<h2>{{ isset($title)?$title:"" }} Prospectus Reports</h2>
		</div>

		<div class="col-md-6">
		
			{!!Form::open(['route'=>'reception.reports.exportProspectus','method'=>'get'])!!}
		      
				{{Form::label('year','Year:')}}
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