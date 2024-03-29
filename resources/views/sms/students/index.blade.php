@extends('sms.main')
@section('title','| All Students')

@section('content')
	<div class="row">
		<div class="col-md-3">
			<h2>{{ isset($title)?$title:"All " }} Students</h2>
		</div>
		<div class="col-md-9">

			{!!Form::open(['route'=>'sms.students.search','method'=>'get','class'=>'navbar-form navbar-left'])!!}
		        <div class="form-group">
		          <input type="text" id="name" name="name" class="form-control form-spacing-top" placeholder="Search by Name">
			    	{{Form::select('course_id', $courses ,null,['class'=>'form-control form-spacing-top','placeholder' => 'Pick a course...'])}}
		          <input type="text" id="year" name="year" class="form-control form-spacing-top" placeholder="Year" style = "width:60px;">
		        </div>
		        <button type="submit" class="btn btn-success form-spacing-top">Search</button>
			{!!Form::close()!!}

			<a href="{{ route('sms.students.create') }}" class="btn btn-primary btn-lg btn-h1-spacing col-md-offset-2">New Student</a>

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
					<th>Course</th>
					<th>Join</th>
					<th>Batch</th>
					<th>Sem Register</th>
					<th>Subjects</th>
					<th>Actions</th>
				</thead>
				<tbody>
				@foreach($students as $student)
				<tr>
					<td>{{$student->id}}</td>
					<td><img src="{{$student->photo?asset('photo/'.$student->photo):'/img/user.jpg'}}" alt="..." class="img-rounded" height="33" width="28"></td>
					<td>{{substr($student->name,0,50)}}{{ strlen($student->name)>50?"..":"" }}</td>
					<td>{{$student->phone}}</td>
					<td>{{$student->course->name}}</td>
					<td>{{$student->doj}}</td>
					<td>{{$student->batch}}</td>
					<td>
					@foreach($student->registrations as $reg)
					{{$reg->semester}},
					@endforeach
					</td>
					<td>{{$student->subjects()->count()}}</td>
					<td>
						<a href="{{route('sms.students.show',$student->id)}}" class="btn btn-info">View</a>
						<a href="{{route('sms.students.edit',$student->id)}}" class="btn btn-warning">Edit</a>
						<a href="{{route('sms.documents.show',$student->id)}}" class="btn btn-primary">{{ $student->documents()->count() }} Docs</a>
					@if(Auth::check())

						<!-- Delete Modal -->
                      <div class="modal fade" id="Delete<?php echo $student->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h2>Delete Confirmation</h2>
                            </div>
                            <div class="modal-body">
                                Are you sure to Delete... Mr {{$student->name}}?
                            </div>
                            <div class="modal-footer">
                            	
	                            <div class="col-md-4 ">
	                      			{!! Form::open(['route'=>['sms.students.destroy',$student->id],'method'=>'delete']) !!}
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
                      <a href="#Delete{{$student->id}}"  role="button" class="btn btn-danger" data-toggle="modal" title="Delete Student">Delete</a>
                      <!-- End Delete Modal -->
					@endif
					</td>
				</tr>
				@endforeach
				</tbody>
			</table>
			<div class="text-center">
				{!! $students->appends(Request::except('page'))->links() !!}
			</div>
		</div>
	</div>
@stop