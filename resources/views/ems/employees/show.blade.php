@extends('ems.main')
@section('title','| View Employee')

@section('content') 

<div class="row">
	<div class="col-md-8">
		<h2>{{$employee->Sname}} {{$employee->Fname}} {{$employee->Mname}}</h2>

	<table class="table table-striped">
			<tbody>
				<tr>
				<th>Status:</th><td>Active</td>
				</tr>
				<tr>
				<th>Phone:</th><td>{{$employee->mobile}}</td>
				<th>Email:</th><td>{{$employee->email}}</td>
				</tr>
				<tr>
				<th>Sex:</th><td> {{$employee->gender}}</td>
				</tr>

				<tr>
				<th>Father's Name:</th><td>{{$employee->f_name}}</td>
				<th>Mother's Name:</th><td>{{$employee->m_name}}</td>
				</tr>

				<tr>
				<th>Address Line 1:</th><td>{{$employee->addressline1}}</td>
				<th>Assress Line 2:</th><td>{{$employee->addressline2}}</td>
				</tr>

				<tr>
				<th>State:</th><td>{{$employee->state}}</td>
				<th>City/Village:</th><td>{{$employee->city}}</td>
				<th>Postal Code:</th><td>{{$employee->postalcode}}</td>
				</tr>
				
				<tr>
				<th>Birthday:</th><td>{{$employee->dob}}</td>
				
				</tr>

				<tr>
				<th>UG Degree:</th><td>{{$employee->ug_degree}}</td>
				<th>Other Qualifications:</th><td>{{$employee->other_qualification}}</td>
				</tr>

				<tr>
				<th>Designation:</th><td>{{$employee->designation}}</td>
				<th>Appointment Type:</th><td>{{$employee->appointment}}</td>
				</tr>

				<tr>
				<th>Course:</th><td>{{$employee->course}}</td>
				<th>Area of Specializations:</th><td>{{$employee->specialization}}</td>
				</tr>
	
			</tbody>
		</table>	
	</div>
	<div class="col-md-4">
		<!--<div class="well">-->
		<div class="panel panel-primary">
		  <div class="panel-heading">
		    <h3 class="panel-title">{{$employee->title}} {{$employee->Sname}} {{$employee->Fname}} {{$employee->Mname}}</h3>
		  </div>
		  <div class="panel-body">
			<img src="{{$employee->photo?asset('photo/'.$employee->photo):'/img/user.jpg'}}" alt="..." class="img-rounded" height="35%" width="25%" style="margin-left:100px;">
			<p>
				<dl class="dl-horizontal">
					<label>Created At: </label>
					{{date("d M Y [h:m:s]", strtotime($employee->created_at))}}
					<br>
					<label>Last Updated: </label>
					{{date("d M Y [h:m:s]", strtotime($employee->updated_at))}}
				</dl>

			<div class="row">
				<div class="col-sm-6">
					{!! Html::linkRoute('ems.employees.edit','Edit',[$employee->id],['class'=>'btn btn-primary btn-block']) !!}
				</div>
				<div class="col-sm-6">
					<!-- Delete Modal -->
                      <div class="modal fade" id="Delete<?php echo $employee->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h2>Delete Confirmation</h2>
                            </div>
                            <div class="modal-body">
                                Are you sure to Delete... Mr {{$employee->Fname}}?
                            </div>
                            <div class="modal-footer">
                            	
	                            <div class="col-md-4 ">
	                      			{!! Form::open(['route'=>['ems.employees.destroy',$employee->id],'method'=>'delete']) !!}
										{{Form::submit('Delete',['class'=>'btn btn-danger btn-block'])}}
						  			{!! Form::close() !!}
						  		</div>
						  		<div class="col-md-4 col-md-offset-4">
                              		<button type="button" class="btn btn-warning btn-block" data-dismiss="modal">No</button>
                              	</div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <a href="#Delete{{$employee->id}}"  role="button" class="btn btn-danger btn-block" data-toggle="modal" title="Delete Student">Delete</a>
                      <!-- End Delete Modal -->
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
				{{Html::linkRoute('ems.employees.index','<<All Employees',[],['class'=>'btn btn-default btn-block btn-h1-spacing'])}}
				</div>

			</div>
			<div class="row">
				<div class="col-md-12">
				<a href="{{ URL::previous() }}" class="btn btn-info btn-block btn-h1-spacing">Back</a>
				</div>

			</div>
			<hr>
			<dl class="dl-horizontal">
					<label>Office</label>
					<div class="table-responsive">
						<table class="table table-condensed table-bordered">
							<thead>
								<tr>
									<th>Emp Code</th>
									<th>Date of Joining</th>
									<th>Teaching Experience
									<th>Last Updated</th>
									
								</tr>
							</thead>
							<tbody>
								
								<tr>
									<td>{{$employee->id}}</td>
									
								
									<td>{{$employee->doj}}</td>
									
									<td>{{$employee->teaching_exp}}</td>
									<td>{{date("d M Y", strtotime($employee->updated_at))}}</td>
									
								</tr>
								
							</tbody>
						</table>
					</div>
				</dl>
			</div>
		</div>
	</div>
</div>
@stop