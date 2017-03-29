@extends('ems.main')
@section('title','| All Employees')

@section('content')
	<div class="row">
		<div class="col-md-3">
			<h2>{{ isset($title)?$title:"All " }} Employees</h2>
		</div>
		<div class="col-md-9">
		
		
			{!!Form::open(['route'=>'ems.employees.search','method'=>'get','class'=>'navbar-form navbar-left'])!!}
		        <div class="form-group">
		          <input type="text" id="name" name="name" class="form-control form-spacing-top" placeholder="Search by Name">
			    	
		          <input type="text" id="year" name="year" class="form-control form-spacing-top" placeholder="Year" style = "width:60px;">
		        </div>
		        <button type="submit" class="btn btn-success form-spacing-top">Search</button>
			{!!Form::close()!!}
		
			<a href="{{ route('ems.employees.create') }}" class="btn btn-primary btn-lg btn-h1-spacing col-md-offset-2">New Employee</a>
		
		</div>
		<hr> 
	</div>

	<div class="row">
		<div class="col-md-12">
			<table class="table">
				<thead>
					<th>#</th>
					<th>Photo</th>
					<th>Name</th>
					<th>Phone</th>	
					
					<th>Join</th>
					<th>Designation</th>
					
					<th>Updated At</th>
					
					<th>Actions</th>
				</thead>
				<tbody>
				@foreach($employees as $employee)
				<tr>
					<td>{{$employee->id}}</td>
					<td><img src="{{$employee->photo?asset('photo/'.$employee->photo):'/img/user.jpg'}}" alt="..." class="img-rounded" height="33" width="28"></td>
					<td>{{$employee->title}} {{$employee->Sname}} {{substr($employee->Fname,0,50)}} {{ strlen($employee->Mname)>50?"..":"" }}</td>
					<td>{{$employee->mobile}}</td>
					
					<td>{{$employee->doj}}</td>
					<td>{{$employee->designation}}</td>
					<td>{{date("d M Y h:m:s", strtotime($employee->updated_at))}}</td> 
					
					<td>
						<a href="{{route('ems.employees.show',$employee->id)}}" class="btn btn-info">View</a>
						<a href="{{route('ems.employees.edit',$employee->id)}}" class="btn btn-warning">Edit</a>
						<a href="{{route('ems.documents.show',$employee->id)}}" class="btn btn-primary"> Docs</a>
					@if(Auth::check())

						<!-- Delete Modal -->
                      <div class="modal fade" id="Delete<?php echo $employee->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h2>Delete Confirmation</h2>
                            </div>
                            <div class="modal-body">
                                Are you sure to Delete {{$employee->title}} {{$employee->Fname}}'s records?
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
                      <a href="#Delete{{$employee->id}}"  role="button" class="btn btn-danger" data-toggle="modal" title="Delete employee">Delete</a>
                      <!-- End Delete Modal -->
					@endif
					</td>
				</tr>
				@endforeach
				</tbody>
			</table>
			<div class="text-center">
				{!! $employees->appends(Request::except('page'))->links() !!}
			</div>
		</div>
	</div>
@stop