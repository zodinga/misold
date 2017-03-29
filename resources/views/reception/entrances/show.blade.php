@extends('reception.main')
@section('title','| View Entrance')

@section('content')
<div class="row">
	<div class="col-md-8">
		<h2>{{ $entrance->name}}</h2>

		<table class="table table-striped">
			<tbody>
				<tr>
				<th>Application Number:</th><td>{{$entrance->appln_no}}</td>
				</tr>
				<tr>
				<th>Name:</th><td>{{$entrance->name}}</td>
				</tr>
				<tr>
				<th>Fathers Name:</th><td>{{$entrance->father}}</td>
				</tr>
				<tr>
					<th>Course Applied:</th><td>{{$entrance->course->name}}</td>
				</tr>
				<tr>
					<th>Marks:</th><td>{{$entrance->marks}}</td>
				</tr>
				<tr>
					<th>Session:</th><td>{{$entrance->session}}</td>
				</tr>

			</tbody>
		</table>


				
	</div>
	<div class="col-md-4">
		<!--<div class="well">-->
		<div class="panel panel-primary">
		  <div class="panel-heading">
		    <h3 class="panel-title">{{$entrance->appln_no}}</h3>
		  </div>
		  <div class="panel-body">
			<p>
				<dl class="dl-horizontal">
					<label>Created At: </label>
					{{date('M j, Y h:i',strtotime($entrance->created_at))}}
					<br>
					<label>Last Updated: </label>
					{{date('M j, Y h:i',strtotime($entrance->updated_at))}}
				</dl>

			<div class="row">
				<div class="col-sm-6">
					{!! Html::linkRoute('reception.entrances.edit','Edit',[$entrance->id],['class'=>'btn btn-primary btn-block']) !!}
				</div>
				<div class="col-sm-6">
				{!! Form::open(['route'=>['reception.entrances.destroy',$entrance->id],'method'=>'delete']) !!}
					{{Form::submit('Delete',['class'=>'btn btn-danger btn-block'])}}
				{!! Form::close() !!}
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
				{{Html::linkRoute('reception.entrances.index','<<All entrances',[],['class'=>'btn btn-default btn-block btn-h1-spacing'])}}
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