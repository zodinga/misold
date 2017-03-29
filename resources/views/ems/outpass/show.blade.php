@extends('ems.main')
@section('title','| View Employee')
@section('stylesheet')
	{!! Html::style('css/parsley.css') !!}
	{!! Html::style('css/select2.min.css') !!}
@stop
@section('content')  
 
<div class="row">  
	<div class="col-md-4">
		<h2>{{$employee->Sname}} {{$employee->Fname}} {{$employee->Mname}}</h2>

	<table class="table table-striped ">
			<tbody>
				<tr>
					<th>Employees ID:</th><td>{{$employee->id}}</td>
				</tr>
				<tr>
					<th>Name of the wing</th><td>{{$employee->faculty_type}}</td>
				</tr>
				<tr>
					<th>Designation/ Grade:</th><td> {{$employee->designation}}</td>
				</tr>

				<tr>
					<th>No. of days already availed</th><td> @if($emp_leave < 1) 0  @else {{ $emp_leave }} @endif</td>
				</tr>

			</tbody>
		</table>	
	</div>
	<div class="col-md-6">
		<!--<div class="well">-->
		<div class="panel panel-primary">
		  <div class="panel-heading">
		    <h3 class="panel-title">Outpass</h3>
		  </div>
		  <div class="panel-body">
			<img src="{{$employee->photo?asset('photo/'.$employee->photo):'/img/user.jpg'}}" alt="..." class="img-rounded" height="35%" width="25%" style="margin-left:100px;">
			
			<hr>

				<div class="row">
					<div class="col-md-12 col-md-offset-0">
					{!! Form::open(['route' => 'ems.outpass.store','data-parsley-validate'=>'']) !!}
						
					    {{Form::hidden('employee_id',$employee->id,['class'=>'form-control','required'=>'','maxlength'=>'50'])}}

						{{Form::label('ground','Ground on which outpass is applied for:')}}
					    {{Form::text('ground',null,['class'=>'form-control','required'=>'','maxlength'=>'50'])}}
<br>
					    {{Form::label('out_date','Date of outpass applied for:')}}
					    {{Form::date('out_date', date('Y-m-d') ,['class'=>'form-control','required'=>''])}}
<br>			<div class="col-md-6">
					    {{Form::label('out_time','From:')}}
			    		{{Form::time('out_time', null,['class'=>'form-control', 'required'=>'', 'placeholder'=>'hh:mm:ss', 'maxlength'=>'8'])}}
			    		<div class="info">Time format 24 hours</div>
<br>			</div>
				<div class="col-md-6">
			    		{{Form::label('in_time','To: (Time of return back)')}}
			    		{{Form::time('in_time',null,['class'=>'form-control', 'required'=>'', 'placeholder'=>'hh:mm:ss', 'maxlength'=>'8'])}}
			    		<div class="info">Time format 24 hours</div>

<br>			</div>

					{{Form::submit('Apply For Outpass',['class'=>'btn btn-success btn-lg btn-block','style'=>'margin-top:20px'])}}
				{{Form::close()}}

			    	</div>
			    </div>
			
			</div>
		</div>
	</div>
</div>
@stop