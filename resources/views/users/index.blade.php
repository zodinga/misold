@extends('main')

@section('title', '| Register')

@section('stylesheet')
	{!! Html::style('css/parsley.css') !!}
@stop

@section('content')
	
<div class="row">
		<div class="col-md-9">
			<h1>Users</h1>
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Admin</th>
						<th>Coordinator</th>
						<th>Faculty</th>
						<th>Lab i/c</th>
						<th>Account</th>
						<th>Clerical</th>
						<th>Reception</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				@foreach($users as $user)
					<tr>
					<form action="{{ route('admin.assign') }}" method="post">
					{{ csrf_field() }}
						<td>{{$user->id}}<input type="hidden" name="id" value="{{ $user->id }}"></td>
						<td><a href="{{route('users.show',$user->id)}}">{{$user->name}}</a></td>
						<td><input type="checkbox" name="role_admin" {{ $user->hasRole('Admin') ? 'checked' : '' }} ></td>
						<td><input type="checkbox" name="role_coordinator" {{ $user->hasRole('Coordinator') ? 'checked' : '' }}></td>
						<td><input type="checkbox" name="role_faculty" {{ $user->hasRole('Faculty') ? 'checked' : '' }}></td>
						<td><input type="checkbox" name="role_lab" {{ $user->hasRole('Lab') ? 'checked' : '' }}></td>
						<td><input type="checkbox" name="role_account" {{ $user->hasRole('Account') ? 'checked' : '' }}></td>
						<td><input type="checkbox" name="role_clerical" {{ $user->hasRole('Clerical') ? 'checked' : '' }}></td>
						<td><input type="checkbox" name="role_reception" {{ $user->hasRole('Reception') ? 'checked' : '' }}></td>
						<td>
							<button type="submit" class="btn btn-warning btn-xs">Assign</button>
							<a href="{{route('users.edit',$user->id)}}" class="btn btn-info btn-xs">Edit</a>
						</td>
					</form>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div><!--end of col-md-8-->
		<div class="col-md-3">
			<div class="panel panel-primary" style="margin-top:70px;">
			<div class="panel-heading">New User</div>
			<div class="panel-body">
			{!! Form::open(['route'=>'users.store','data-parsley-validate'=>'','method'=>'POST']) !!}

				{{ Form::label('name', "Name:") }}
				{{ Form::text('name', null, ['class' => 'form-control','required'=>'']) }}

				{{ Form::label('email', 'Email:') }}
				{{ Form::email('email', null, ['class' => 'form-control','data-parsley-type'=>'email']) }}

				{{ Form::label('password', 'Password:') }}
				{{ Form::password('password', ['class' => 'form-control','required'=>'']) }}

				{{ Form::label('password_confirmation', 'Confirm Password:') }}
				{{ Form::password('password_confirmation', ['class' => 'form-control','required'=>'']) }}
			
				{{ Form::submit('Register', ['class' => 'btn btn-success btn-block form-spacing-top']) }}

			{!! Form::close() !!}
			</div>
			</div>
		</div>
	</div>
@endsection
@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
@stop