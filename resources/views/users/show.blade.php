@extends('main')
@section('title','| User')

@section('content')
<div class="row">
	<div class="col-md-6">
		<h2>{{ $user->name }}</h2>
		<h2>{{ $user->email }}</h2>
		
	</div>
	<div class="col-md-6">
		<h3>Roles:</h3>
		@foreach($user->roles as $role)
			<h3 class="text-success">{{$role->name}}</h3>
		@endforeach
	</div>
</div>
@stop