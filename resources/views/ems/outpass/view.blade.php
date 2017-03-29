<?php
use App\Employee;
use App\Emp_leave;
use App\Emp_outpass;

$eid = Auth::user()->id;

$test=Employee::where('eid', '=', $eid)->pluck('id');
$employee=Employee::where('eid', '=', $eid )->pluck('id');
$no_of_days=Emp_outpass::where('status', '=', 'Approved')->where('employee_id', '=', $test)->count('status');
$noti=Emp_outpass::where('status', '=', 'Pending')->where('employee_id', '=', $eid)->count('status');

?>

@extends('ems.main')
@section('title','| View Outpass Status')
 
@section('content')
  
@if($howmany > 0)	
<div class="row">
	<div class="col-md-10">
		 
					<div class="col-md-9">
					 
						<div class="panel panel-primary">

						  <div class="panel-heading">
						    <h3 class="panel-title">{{ $employees->Fname}}</h3>
						  </div>
						  <div class="panel-body">
							<img src="{{$employees->photo?asset('photo/'.$employees->photo):'/img/user.jpg'}}" alt="..." class="img-rounded" height="18%" width="20%" style="margin-left:100px;">
							
							<hr>

								<div class="row">
									<div class="col-md-12 col-md-offset-0">
									
									
							
										<table class="table table-striped ">
											<tbody>
												<tr>
													<th>Applied for:</th><td>Outpass</td>
												</tr>
												<tr>
													<th>No. outpass already availed:</th><td>{{$no_of_days}}
												</tr>
												<tr> 
													<th>Applied for Dated</th><td> {{date('d/m/Y', strtotime($emp_outpass->out_date))}}
																							 
												</tr>
												<tr> 
													<th>Duration</th><td> {{date('g:i A', strtotime($emp_outpass->out_time))}} <b> To </b> {{date('g:i A', strtotime($emp_outpass->in_time))}}
																							 
												</tr>
												@if($emp_outpass->status == 'Approved')
												<tr>
													<th>Approving Authority</th><td> {{$emp_outpass->authority}}</td>
												</tr>
												@endif
												@if($emp_outpass->status == 'Rejected')
												<tr>
													<th>Status</th><td> <h4> <p class="bg-primary">{{ $emp_outpass->status }}</p> </h4></td>
												</tr>
												<tr>
													<th>Details</th><td> <h4> <p class="bg-normal">{{ $emp_outpass->comment }} </p> </h4></td>
												</tr>
												@else
												<tr>
													<th>Status</th><td> <h4> <p class="bg-info">{{ $emp_outpass->status }}</p> </h4></td>
												</tr>

												@endif
												@if($emp_outpass->status == 'Approved' || $emp_outpass->status == 'Approved')
												<tr>
													<th>Approved on</th><td> {{ date('d/m/Y [h:m:s A]', strtotime($emp_outpass->updated_at)) }}</td>
												</tr>
												@endif
										</tbody>
										</table>

									{!! Form::open(['route' => ['ems.outpass.confirm',$emp_outpass->id],'data-parsley-validate'=>'']) !!}
										<div class="hidden">				
											{{Form::text('view',1,['class'=>'form-control','maxlength'=>'2'])}} 
										</div>	
									@if($emp_outpass->status != 'Pending')	

									{{Form::submit('I have seen the notification',['class'=>'btn btn-success btn-lg btn-block','style'=>'margin-top:20px'])}}
									@else
									<table class="table table-striped ">
										<tbody>	
										<tr>
										<td>
											<div class="col-md-10 col-md-offset-2">
												<a href="{{ URL::previous() }}" class="btn btn-info btn-block btn-h1-spacing">Back</a>
											</div>
										</td>
										<td>
										<!-- Delete Modal -->
					                      <div class="modal fade" id="Delete<?php echo $emp_outpass->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					                        <div class="modal-dialog">
					                          <div class="modal-content">
					                            <div class="modal-header">
					                              <h2>Delete Confirmation</h2>
					                            </div>
					                            <div class="modal-body">
					                                Are you sure to Delete your Outpass request?
					                            </div>
					                            <div class="modal-footer">
					                            	
						                            <div class="btn-group">
						                            	<a href="{{route('ems.outpass.destroy', $emp_outpass->id)}}" class="btn btn-danger btn-block btn-h1-spacing">Confirm</a>
						                      		
					                              		<button type="button" class="btn btn-warning btn-block btn-h1-spacing align-top" data-dismiss="modal">No</button>
					                              	</div>
					                            </div>
					                          </div>
					                        </div>
					                      </div>
					                      <a href="#Delete{{$emp_outpass->id}}"  role="button" class="btn btn-danger btn-block btn-h1-spacing" data-toggle="modal" title="Delete employee">Delete</a>
					                    <!-- End Delete Modal -->


										</td>
										</tr>
										</tbody>
									</table>
									@endif
									{!! Form::close() !!}
							    	</div>
							    </div>
							
							</div>
						</div>
					</div>	
	</div>
</div>
@else
	<h3>You have no outpass request to display.</h3>
		<div class="col-md-2">
			<a href="{{ URL::previous() }}" class="btn btn-success btn-block btn-h1-spacing">Back</a>
		</div>
@endif
	</div>
@stop
</div>