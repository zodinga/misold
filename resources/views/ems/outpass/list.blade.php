@extends('ems.main')
@section('title','| Outpass Request List')

@section('content') 

@if(Auth::user()->hasRole('Admin') == 'Admin')
<div class="row">

	<div class="col-md-12">
		
					<div class="col-md-7">
@foreach($emp_outpass as $emp_outpass)
 
						<div class="panel panel-primary">
						  <div class="panel-heading">
						    <h3 class="panel-title">{{ $employees->Fname}}</h3>
						  </div>
						  <div class="panel-body">
							<img src="{{$employees->photo?asset('photo/'.$employees->photo):'/img/user.jpg'}}" alt="..." class="img-rounded" height="35%" width="25%" style="margin-left:100px;">
							
							<hr>

								<div class="row">
									<div class="col-md-12 col-md-offset-0">
									{!! Form::open(['route' => ['ems.outpass.approve', $emp_outpass->id],'data-parsley-validate'=>'']) !!}
							
										<table class="table table-striped ">
											<tbody>
												<tr>
													<th>Leave applied for:</th><td>Outpass</td>
												</tr>
												<tr>
													<th>Outpass applied for:</th><td>{{date("d/m/Y", strtotime($emp_outpass->out_date)) }}</td>
												</tr>
												<tr>
													<th>Time</th>	<td> 					
																		{{date("g:i A", strtotime($emp_outpass->out_time)) }} <b>&nbsp; &nbsp; &nbsp; &nbsp;To: &nbsp;</b> {{date("g:i A", strtotime($emp_outpass->in_time)) }} 
																	</td>
												</tr>

												<tr>
													<th>Ground of leave</th><td>{{$emp_outpass->ground}}</td>
												</tr>

												<tr>
													<th>Application submited at</th><td> {{date("d/m/Y  [g:i A]", strtotime($emp_outpass->updated_at)) }}</td>
												</tr>
								<div class="hidden">				
								{{Form::text('status','Approved',['class'=>'form-control','maxlength'=>'30'])}}
								{{Form::text('authority',Auth::user()->name,['class'=>'form-control','maxlength'=>'30'])}} 
								</div>				

											</tbody>
										</table>	

									{{Form::submit('Approve Leave Request',['class'=>'btn btn-success btn-lg btn-block','style'=>'margin-top:20px'])}}
<br>
									{!! Form::close() !!}

										<div class="row">
												<div class="col-md-6">
													<a href="{{ URL::previous() }}" class="btn btn-info btn-block btn-h1-spacing">Pending</a>
												</div>
												<div class="col-sm-6">
													<!-- Delete Modal -->
								                      <div class="modal fade" id="Delete<?php echo $employees->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								                        <div class="modal-dialog">
								                          <div class="modal-content">
								                            <div class="modal-header">
								                              <h2>Reject Confirmation</h2>
								                            </div>
								                            <div class="modal-body">
								                                Are you sure to Reject... {{$employees->title}} {{$employees->Fname}}'s application?
								                            </div>
								                            <div class="modal-footer">
								                            	
									                            <div class="col-md-7 ">
									                      			{!! Form::open(['route'=>['ems.outpass.reject',$emp_outpass->id],'data-parsley-validate'=>'']) !!}

									                      			{{Form::label('comment','Why you reject the application:')}}
			    													{{Form::text('comment',null,['class'=>'form-control','maxlength'=>'100'])}}
			    													<div class="hidden">{{Form::text('status','Rejected',['class'=>'form-control','maxlength'=>'30'])}}</div>
			    													<div class="hidden">{{Form::text('authority',Auth::user()->name,['class'=>'form-control','maxlength'=>'30'])}}</div>
																		
														  		</div>
														  		<div class="col-md-3 col-md-offset-2">
														  		{{Form::submit('Confirm',['class'=>'btn btn-danger btn-block'])}}
														  			{!! Form::close() !!}
								                              		<button type="button" class="btn btn-warning btn-block" data-dismiss="modal">Cancel</button>
								                              	</div>
								                            </div>
								                          </div>
								                        </div>
								                      </div>
								                      <a href="#Delete{{$employees->id}}"  role="button" class="btn btn-danger btn-block btn-h1-spacing" data-toggle="modal" title="Delete Student">Reject</a>
								                      <!-- End Delete Modal -->
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
												
												</div>
												</div>

												<hr>
									<table class="table table-bordered">
									<thead>
												<tr>
													<th> Outpass Time </th><th>During <?php echo date('F'); ?></th><th>During <?php echo date('Y'); ?></th>
												</tr>
												<tr>
													<th> Outpass Availed </th><td>{{$months}}</td> <td>{{$year}}</td>
												</tr>
									</thead>			
									</table>
							

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