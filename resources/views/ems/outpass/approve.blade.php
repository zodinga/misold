
@extends('ems.main')
@section('title','| View Employee Outpass')

@section('content') 

@if(Auth::user()->hasRole('Admin') == 'Admin')
<div class="row">

	<div class="col-md-12">
		
					<div class="col-md-7">
@foreach($emp_leave as $emp_leave)

						<div class="panel panel-primary">
						  <div class="panel-heading">
						    <h3 class="panel-title">{{ $employees->Fname}}</h3>
						  </div>
						  <div class="panel-body">
							<img src="{{$employees->photo?asset('photo/'.$employees->photo):'/img/user.jpg'}}" alt="..." class="img-rounded" height="35%" width="25%" style="margin-left:100px;">
							
							<hr>

								<div class="row">
									<div class="col-md-12 col-md-offset-0">
									{!! Form::open(['route' => 'ems.leave.store','data-parsley-validate'=>'','files'=>true]) !!}
							
										<table class="table table-striped ">
											<tbody>
												<tr>
													<th>Leave applied for:</th><td>{{$emp_leave->leave_type}}</td>
												</tr>
												<tr>
													<th>No. of days approved:</th><td>{{$emp_leave->no_of_days}}</td>
												</tr>
												<tr>
													<th>Dated</th><td> 
																							 @if($emp_leave->to_date == NULL)
																							 	{{$emp_leave->from_date}}
																							 @else 
																							 		<b>From: </b> {{$emp_leave->from_date}} <b>&nbsp; &nbsp;To: </b> {{$emp_leave->to_date}} 

																							 @endif</td>
												</tr>

												<tr>
													<th>Approving Authority</th><td> Leave lak tawh zat</td>
												</tr>

												<tr>
													<th>Details</th><td> {{ $emp_leave->updated_at }}</td>
												</tr>

											</tbody>
										</table>	

									{{Form::submit('Apply For Leave',['class'=>'btn btn-success btn-lg btn-block','style'=>'margin-top:20px'])}}

							    	</div>
							    </div>
							
							</div>
						</div>
						@endforeach
					</div>	
	</div>
	
</div>

@else
<h3>You are not allowed to access this page</h3>
@endif
@stop