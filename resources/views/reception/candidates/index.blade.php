@extends('reception.main')
@section('title','| All Candidates')

@section('content')
	<div class="row">
		<div class="col-md-3">
			<h2>Candidates</h2>
		</div>
		<div class="col-md-9">
			{!!Form::open(['route'=>'reception.candidates.search','method'=>'get','class'=>'navbar-form navbar-left'])!!}
		        <div class="form-group">
		          <input type="text" id="name" name="name" class="form-control form-spacing-top" placeholder="Search by Name">
			 {{Form::select('course_id', $courses ,null,['class'=>'form-control form-spacing-top','placeholder' => 'Pick a course...'])}}
			    	
			<input type="text" id="session" name="session" class="form-control form-spacing-top" placeholder="Search by Session">
		         
		        </div>
		        <button type="submit" class="btn btn-success form-spacing-top">Submit</button>
			{!!Form::close()!!}

		<a href="{{ route('reception.candidates.create') }}" class="btn btn-primary btn-lg btn-h1-spacing col-md-offset-2">New Candidate</a>
		</div>
		<hr>
	</div>
	<div class="row">
		<div class="col-md-12">
			<table class="table">
				<thead>
					<th>#</th>
					<th>Appln No</th>
					<th>Name</th>
					<th>Fathers Name</th>
					<th>Phone</th>	
					<th>Course</th>
					<th>Session</th>			
					<th>Actions</th>
				</thead>
				<tbody>
				@foreach($candidates as $candidate)
				<tr>
					<td>{{$candidate->id}}</td>
					<td>{{$candidate->appln_no}}</td>
					<td>{{substr($candidate->name,0,50)}}{{ strlen($candidate->name)>50?"..":"" }}</td>
					<td>{{substr($candidate->father,0,50)}}{{ strlen($candidate->father)>50?"..":"" }}</td>
					<td>{{$candidate->phone}}</td>
					<td>{{$candidate->course->name}}</td>
					<td>{{$candidate->session}}</td>
					<td>
						<a href="{{route('reception.candidates.show',$candidate->id)}}" class="btn btn-info">View</a>
						<a href="{{route('reception.candidates.edit',$candidate->id)}}" class="btn btn-warning">Edit</a>
					</td>
				</tr>
				@endforeach
				</tbody>
			</table>
			<div class="text-center">
				{!! $candidates->appends(Request::except('page'))->links() !!}
			</div>
		</div>
	</div>
@stop