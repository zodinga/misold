@extends('sms.main')
@section('title','| All Attendance ')

@section('content')
	<div class="row">
		<div class="col-md-3">
			<h2>Attendances</h2>
		</div>
		<div class="col-md-9">
			{!!Form::open(['route'=>'sms.attendances.search','method'=>'get','class'=>'navbar-form navbar-left'])!!}
		        <div class="form-group">
		         	{{Form::select('course_id', $courses ,null,['class'=>'form-control form-spacing-top','placeholder' => 'Pick a course...'])}}
			        <input type="text" id="semester" name="semester" class="form-control form-spacing-top" placeholder="Enter Semester">
		        </div>
		        <button type="submit" class="btn btn-success form-spacing-top">Submit</button>
			{!!Form::close()!!}

		<a href="{{ route('sms.attendances.create') }}" class="btn btn-primary btn-lg btn-h1-spacing col-md-offset-2">New Attendance</a>
		</div>
		<hr>
	</div>

	<div class="row">
		<div class="col-md-12">
			<table class="table">
				<thead>
					<th>#</th>
					<th>Name</th>
					<th>Regn No</th>
					<th>Course</th>
					<th>Semester</th>
					<th>Month 1</th>
					<th>Month 2</th>
					<th>Month 3</th>
					<th>Month 4</th>
					<th>Month 5</th>				
					<th>Actions</th>
				</thead>
				<tbody>
				@foreach($attendances as $attendance)
				<tr>
					<td>{{$attendance->id}}</td>
					<td>{{$attendance->name}}</td>
					<td>{{$attendance->regn_no}}</td>
					<td>{{$attendance->course->name}}</td>
					<td>{{$attendance->semester}}</td>
					<td>{{$attendance->m1}}</td>
					<td>{{$attendance->m2}}</td>
					<td>{{$attendance->m3}}</td>
					<td>{{$attendance->m4}}</td>
					<td>{{$attendance->m5}}</td>
					<td>
						<a href="{{route('sms.attendances.show',$attendance->id)}}" class="btn btn-info">View</a>
						<a href="{{route('sms.attendances.edit',$attendance->id)}}" class="btn btn-warning">Edit</a>
					</td>
				</tr>
				@endforeach
				</tbody>
			</table>
			<div class="text-center">
				{!! $attendances->appends(Request::except('page'))->links() !!}
			</div>
		</div>
	</div>

@stop