@extends('reception.main')
@section('title','| View Candidate')

@section('content')
<div class="row">
	<div class="col-md-8">
		<h2>{{ $candidate->name}}</h2>

		<table class="table table-striped">
			<tbody>
				<tr>
				<th>Application Number:</th><td>{{$candidate->appln_no}}</td>
				</tr>
				<tr>
				<th>Name:</th><td>{{$candidate->name}}</td>
				<th>Gender:</th><td>{{$candidate->gender}}</td>
				</tr>

				<tr>
					<th>Phone:</th><td>{{$candidate->phone}}</td>
					<th>Email:</th><td>{{$candidate->email}}</td>
				</tr>

				<tr>
				<th>Fathers Name:</th><td>{{$candidate->father}}</td>
				</tr>

				<tr>
				<th>Mother/Guardian Name:</th><td>{{$candidate->mother}}</td>
				</tr>

				<tr>
				<th>Fathers Phone:</th><td>{{$candidate->fphone}}</td>
				<th>Mother/GuardianPhone:</th><td>{{$candidate->mphone}}</td>
				</tr>
				<tr>
					<th>Date of Birth:</th><td>{{$candidate->dateofbirth}}</td>
					<th>Qualification:</th><td>{{$candidate->qualification}}</td>
				</tr>
				<tr>
					<th>Category:</th><td>{{$candidate->category->name}}</td>
					<th>Community:</th><td>{{$candidate->community->name}}</td>
				</tr>
				<tr>
					<th>Course Applied:</th><td>{{$candidate->course->name}}</td>
					<th>Session:</th><td>{{$candidate->session}}</td>
				</tr>
				<tr>
					<th>X Board:</th><td>{{$candidate->xboard}}</td>
					<th>X Percentage:</th><td>{{$candidate->xpercent}}</td>
				</tr>
				<tr>
					<th>XII Board:</th><td>{{$candidate->xiiboard}}</td>
					<th>XII Percentage:</th><td>{{$candidate->xiipercent}}</td>
				</tr>
				<tr>
					<th>XII Stream:</th><td>{{$candidate->xiistream}}</td>
				</tr>
				<tr>
					<th>UG University:</th><td>{{$candidate->ugboard}}</td>
					<th>UG Percentage:</th><td>{{$candidate->ugpercent}}</td>
				</tr>
				<tr>
					<th>UG Stream:</th><td>{{$candidate->ugstream}}</td>
				</tr>

				<tr>
					<th>Other Degree:</th><td>{{$candidate->otherdegree}}</td>
					<th>Other Percentage:</th><td>{{$candidate->otherpercent}}</td>
				</tr>

				<tr>
				<th colspan=1>Temporary Address:</th><td>{{$candidate->address}}</td>
				</tr>
				<tr>
				<th colspan=2>Permanent Address:</th><td>{{$candidate->per_street}},{{$candidate->per_city}},{{$candidate->per_district}},{{$candidate->per_state}},{{$candidate->per_pin}}</td>
				</tr>
			</tbody>
		</table>


				
	</div>
	<div class="col-md-4">
		<!--<div class="well">-->
		<div class="panel panel-primary">
		  <div class="panel-heading">
		    <h3 class="panel-title">{{$candidate->appln_no}}</h3>
		  </div>
		  <div class="panel-body">
			<p>
				<dl class="dl-horizontal">
					<label>Created At: </label>
					{{date('M j, Y h:i',strtotime($candidate->created_at))}}
					<br>
					<label>Last Updated: </label>
					{{date('M j, Y h:i',strtotime($candidate->updated_at))}}
				</dl>

			<div class="row">
				<div class="col-sm-6">
					{!! Html::linkRoute('reception.candidates.edit','Edit',[$candidate->id],['class'=>'btn btn-primary btn-block']) !!}
				</div>
				<div class="col-sm-6">
				{!! Form::open(['route'=>['reception.candidates.destroy',$candidate->id],'method'=>'delete']) !!}
					{{Form::submit('Delete',['class'=>'btn btn-danger btn-block'])}}
				{!! Form::close() !!}
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
				{{Html::linkRoute('reception.candidates.index','<<All candidate',[],['class'=>'btn btn-default btn-block btn-h1-spacing'])}}
				</div>

			</div>
			<div class="row">
				<div class="col-md-12">
				<a href="{{ URL::previous() }}" class="btn btn-info btn-block btn-h1-spacing">Back</a>
				</div>

			</div>
			<hr>

				</dl>
			</div>
		</div>
	</div>
</div>
@stop