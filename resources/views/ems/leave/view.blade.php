@extends('ems.main')
@section('title','| View Employee Leave')

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
													<th>Leave applied for:</th><td>{{$emp_leave->leave_type}}</td>
												</tr>

												<tr>
													<th>No. of days @if($emp_leave->status == 'Pending') request: @else approved:@endif</th><td>	
																						@if($emp_leave->status == 'Approved')
																							{{$emp_leave->no_of_days}}
																						@elseif($emp_leave->status == 'Pending')
																							{{$emp_leave->no_of_days}}
																						@else 
																							0
																						@endif</td>
												</tr>
												<tr>
													<th>Applied for Dated</th><td> 
																							 @if($emp_leave->to_date == NULL || $emp_leave->to_date == "0000-00-00")
																							 	{{date('d/m/Y', strtotime($emp_leave->from_date))}}
																							 @else 
																							 		<b>From: </b> {{date('d/m/Y', strtotime($emp_leave->from_date))}} <b>&nbsp; &nbsp;To: </b> {{date('d/m/Y', strtotime($emp_leave->to_date))}} 

																							 @endif</td>
												</tr>
												@if($emp_leave->status == 'Approved')
												<tr>
													<th>Approving Authority</th><td> {{$emp_leave->authority}}</td>
												</tr>
												@endif
												@if($emp_leave->status == 'Rejected')
												<tr>
													<th>Status</th><td> <h4> <p class="bg-primary">{{ $emp_leave->status }}</p> </h4></td>
												</tr>
												<tr>
													<th>Details</th><td> <h4> <p class="bg-normal">{{ $emp_leave->comment }} </p> </h4></td>
												</tr>
												@else
												<tr>
													<th>Status</th><td> <h4> <p class="bg-info">{{ $emp_leave->status }}</p> </h4></td>
												</tr>

												@endif
												@if($emp_leave->status == 'Approved' || $emp_leave->status == 'Rejected')
												<tr>
													<th>Signed on</th><td> {{ date('d/m/Y', strtotime($emp_leave->updated_at)) }}</td>
												</tr>
												@endif
										</tbody>
										</table>

									{!! Form::open(['route' => ['ems.leave.confirm',$emp_leave->id],'data-parsley-validate'=>'']) !!}
										<div class="hidden">				
											{{Form::text('view',1,['class'=>'form-control','maxlength'=>'2'])}} 
										</div>	
									@if($emp_leave->status != 'Pending')	

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
					                      <div class="modal fade" id="Delete<?php echo $emp_leave->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					                        <div class="modal-dialog">
					                          <div class="modal-content">
					                            <div class="modal-header">
					                              <h2>Delete Confirmation</h2>
					                            </div>
					                            <div class="modal-body">
					                                Are you sure to Delete your Leave request?
					                            </div>
					                            <div class="modal-footer">
					                            	
						                            <div class="btn-group">
						                            	<a href="{{route('ems.leave.destroy', $emp_leave->id)}}" class="btn btn-danger btn-block btn-h1-spacing">Confirm</a>
						                      		
					                              		<button type="button" class="btn btn-warning btn-block btn-h1-spacing align-top" data-dismiss="modal">No</button>
					                              	</div>
					                            </div>
					                          </div>
					                        </div>
					                      </div>
					                      <a href="#Delete{{$emp_leave->id}}"  role="button" class="btn btn-danger btn-block btn-h1-spacing" data-toggle="modal" title="Delete employee">Delete</a>
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
<h3>You have no leave request to display.</h3>
	<div class="col-md-2">
		<a href="{{ URL::previous() }}" class="btn btn-success btn-block btn-h1-spacing">Back</a>
	</div>
@endif
	</div>
@stop
</div>