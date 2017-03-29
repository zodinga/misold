@extends('reception.main')
@section('title','| All Entrance ')

@section('content')
	<div class="row">
		<div class="col-md-3">
			<h2>Entrances</h2>
		</div>
		<div class="col-md-9">
			{!!Form::open(['route'=>'reception.entrances.search','method'=>'get','class'=>'navbar-form navbar-left'])!!}
		        <div class="form-group">
		         	{{Form::select('course_id', $courses ,null,['class'=>'form-control form-spacing-top','placeholder' => 'Pick a course...'])}}
			        <input type="text" id="session" name="session" class="form-control form-spacing-top" placeholder="Enter Session">
		        </div>
		        <button type="submit" class="btn btn-success form-spacing-top">Submit</button>
			{!!Form::close()!!}

		<a href="{{ route('reception.entrances.create') }}" class="btn btn-primary btn-lg btn-h1-spacing col-md-offset-2">New Entrance</a>
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
					<th>Course</th>
					<th>Session</th>
					<th>Marks</th>
					<th>Remarks</th>				
					<th>Actions</th>
				</thead>
				<tbody>
				@foreach($entrances as $entrance)
				<tr>
					<td>{{$entrance->id}}</td>
					<td>{{$entrance->appln_no}}</td>
					<td>{{substr($entrance->name,0,50)}}{{ strlen($entrance->name)>50?"..":"" }}</td>
					<td>{{substr($entrance->father,0,50)}}{{ strlen($entrance->father)>50?"..":"" }}</td>
					<td>{{$entrance->course->name}}</td>
					<td>{{$entrance->session}}</td>
					<td>{{$entrance->marks}}</td>
					<td>{{$entrance->remarks}}</td>
					<td>
						<a href="{{route('reception.entrances.show',$entrance->id)}}" class="btn btn-info">View</a>
						<a href="{{route('reception.entrances.edit',$entrance->id)}}" class="btn btn-warning">Edit</a>
					</td>
				</tr>
				@endforeach
				</tbody>
			</table>
			<div class="text-center">
				{!! $entrances->appends(Request::except('page'))->links() !!}
			</div>
		</div>
	</div>
@stop