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
		    <h3 class="panel-title">Casual Leave / Restricted Holiday</h3>
		  </div>
		  <div class="panel-body">
			<img src="{{$employee->photo?asset('photo/'.$employee->photo):'/img/user.jpg'}}" alt="..." class="img-rounded" height="35%" width="25%" style="margin-left:100px;">
			
			<hr>

				<div class="row">
					<div class="col-md-12 col-md-offset-0">
					{!! Form::open(['route' => 'ems.leave.store','data-parsley-validate'=>'','files'=>true]) !!}

					    {{Form::hidden('employee_id',$employee->id,['class'=>'form-control','required'=>'','maxlength'=>'50'])}}

						{{Form::label('ground','Ground on which leave is applied for:')}}
					    {{Form::text('ground',null,['class'=>'form-control','required'=>'','maxlength'=>'50'])}}
<br>
					    {{Form::label('no_of_days','No. of days of CL/RH applied for:')}}
					    {{Form::number('no_of_days',null,['class'=>'form-control','required'=>'','maxlength'=>'2', 'type'=>'number'])}}
<br>			<div class="col-md-6">
					    {{Form::label('from_date','From:')}}
			    		{{Form::date('from_date',null,['class'=>'form-control', 'required'=>''])}}
<br>			</div>
				<div class="col-md-6">
			    		{{Form::label('to_date','To: (If more than 1 day)')}}
			    		{{Form::date('to_date',null,['class'=>'form-control'])}} 
<br>			</div>
			    		{{Form::label('leave_type','Leave Type:')}}
			    		{{Form::select('leave_type', ['CL'=>'CL', 'RH'=>'RH','EL'=>'EL'] ,null,['class'=>'form-control','required'=>'','placeholder' => 'Select Type'])}}
			    		
					{{Form::submit('Apply For Leave',['class'=>'btn btn-success btn-lg btn-block','style'=>'margin-top:20px'])}}
			
			    	</div>
			    </div>
			</div>
		</div>
	</div>
</div>
@stop