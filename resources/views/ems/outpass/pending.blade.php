@extends('ems.main')
@section('title','| Outpass Request List')
@section('content') 

@if(Auth::user()->hasRole('Admin') == 'Admin' && $howmany > 0)
<div class="hidden">{{$i=0}}</div>

	<div class="row">
		<div class="col-md-10">
		
			<div class="col-md-10">
				<h5>Outpass Request</h5>
					<table class="table">
						<thead>
							<th>#</th>
							<th><h2>Photo</h2></th>
							<th><h2>Name</h2></th>
							<th></th>
							</thead>
						<tbody>
@foreach($employees as $emp)
							<tr>
					
								<td><h3>{{$i=$i+1}}</h3></td><td><img src="{{$emp->photo?asset('photo/'.$empe->photo):'/img/user.jpg'}}" alt="..." class="img-rounded" height="33" width="28"></td><td><h3>{{ $emp->Fname}}</h3></td><td><a href="{{route('ems.outpass.lists',$emp->id)}}" class="btn btn-info">View</a></td>
@endforeach
							</tr>
						</tbody>
					</table>
			</div>
		</div>
	</div>

@elseif($howmany > 0)

<div class="row">
	<div class="col-md-12">
		
					<div class="col-md-8">

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
													<th>Approving Authority</th><td> {{ $emp_leave->authority }}</td>
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
					</div>	
		
	</div>
	
</div>
<div class="row">
	<div class="col-md-12">
		
		<div class="col-md-8">
			<h3>No request for outpass right now. </h3>
				<div class="col-md-4 col-md-offset-0">
					<a href="{{ URL::previous() }}" class="btn btn-info btn-block btn-h1-spacing">Back</a>
				</div>
		</div>
	</div>
@endif	
</div>		

@stop