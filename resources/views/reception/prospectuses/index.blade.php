@extends('reception.main')
@section('title','| All Prospectuses')

@section('content')
	<div class="row">
		<div class="col-md-3">
			<h2>Prospectus</h2>
		</div>
		<div class="col-md-9">
			{!!Form::open(['route'=>'reception.prospectuses.search','method'=>'get','class'=>'navbar-form navbar-left'])!!}
		        <div class="form-group">
		          <input type="text" id="name" name="name" class="form-control form-spacing-top" placeholder="Search by Name">
			    	{{Form::select('course_id', $courses ,null,['class'=>'form-control form-spacing-top','placeholder' => 'Pick a course...'])}}
			    	
			    	{{Form::date('from',null,['class'=>'form-control form-spacing-top','placeholder' => 'From','maxlength'=>'12'],'d/m/Y')}}
			    	
					{{Form::date('to',null,['class'=>'form-control form-spacing-top','placeholder' => 'To','maxlength'=>'12'],'d/m/Y')}}	
		         
		        </div>
		        <button type="submit" class="btn btn-success form-spacing-top">Submit</button>
			{!!Form::close()!!}

		<a href="{{ route('reception.prospectuses.create') }}" class="btn btn-primary btn-lg btn-h1-spacing col-md-offset-2">New Prospectus</a>
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
					<th>Receipt Date</th>			
					<th>Actions</th>
				</thead>
				<tbody>
				@foreach($prospectuses as $prospectus)
				<tr>
					<td>{{$prospectus->id}}</td>
					<td>{{$prospectus->appln_no}}</td>
					<td>{{substr($prospectus->firstname,0,50)}}{{ strlen($prospectus->firstname)>50?"..":"" }}</td>
					<td>{{substr($prospectus->father,0,50)}}{{ strlen($prospectus->father)>50?"..":"" }}</td>
					<td>{{$prospectus->phone}}</td>
					<td>{{$prospectus->course->name}}</td>
					<td>{{$prospectus->receipt_date}}</td>
					<td>
						<a href="{{route('reception.prospectuses.show',$prospectus->id)}}" class="btn btn-info">View</a>
						<a href="{{route('reception.prospectuses.edit',$prospectus->id)}}" class="btn btn-warning">Edit</a>
					</td>
				</tr>
				@endforeach
				</tbody>
			</table>
			<div class="text-center">
				{!! $prospectuses->appends(Request::except('page'))->links() !!}
			</div>
		</div>
	</div>
@stop