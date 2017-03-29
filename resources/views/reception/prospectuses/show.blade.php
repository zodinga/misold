@extends('reception.main')
@section('title','| View Prospectus')

@section('content')
<div class="row">
	<div class="col-md-8">
		<h2>{{ $prospectus->appln_no}}</h2>

		<table class="table table-striped">
			<tbody>
				<tr>
				<th>Name:</th><td>{{$prospectus->firstname}}</td>
				</tr>
				<tr>
				<th>Fathers Name:</th><td>{{$prospectus->father}}</td>
				</tr>
				<tr>
					<th>Phone:</th><td>{{$prospectus->phone}}</td>
					<th>Gender:</th><td>{{$prospectus->gender}}</td>
				</tr>
				<tr>
					<th>Qualification:</th><td>{{$prospectus->qualification}}</td>
					<th>Address:</th><td>{{$prospectus->address}}</td>
				</tr>
				<tr>
					<th>Course Applied:</th><td>{{$prospectus->course->name}}</td>
					<th>Category:</th><td>{{$prospectus->category->name}}</td>
				</tr>

				<tr>
				<th>Receipt No:</th><td>{{$prospectus->receipt_no}}</td>
				<th>Receipt Date:</th><td>{{$prospectus->receipt_date}}</td>
				</tr>
				<tr>
				<th>DD No:</th><td>{{$prospectus->dd_number}}</td>
				<th>DD Amount:</th><td>{{$prospectus->dd_amount}}</td>
				</tr>

				<tr>
				<th>DD Bank:</th><td>{{$prospectus->dd_bank}}</td>
				<th>DD Date:</th><td>{{$prospectus->dd_date}}</td>
				</tr>

				<tr>
				<th>Remarks:</th><td>{{$prospectus->remarks}}</td>
				</tr>
			</tbody>
		</table>


				
	</div>
	<div class="col-md-4">
		<!--<div class="well">-->
		<div class="panel panel-primary">
		  <div class="panel-heading">
		    <h3 class="panel-title">{{$prospectus->appln_no}}</h3>
		  </div>
		  <div class="panel-body">
			<p>
				<dl class="dl-horizontal">
					<label>Created At: </label>
					{{date('M j, Y h:i',strtotime($prospectus->created_at))}}
					<br>
					<label>Last Updated: </label>
					{{date('M j, Y h:i',strtotime($prospectus->updated_at))}}
				</dl>

			<div class="row">
				<div class="col-sm-6">
					{!! Html::linkRoute('reception.prospectuses.edit','Edit',[$prospectus->id],['class'=>'btn btn-primary btn-block']) !!}
				</div>
				<div class="col-sm-6">
				{!! Form::open(['route'=>['reception.prospectuses.destroy',$prospectus->id],'method'=>'delete']) !!}
					{{Form::submit('Delete',['class'=>'btn btn-danger btn-block'])}}
				{!! Form::close() !!}
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
				{{Html::linkRoute('reception.prospectuses.index','<<All Prospectus',[],['class'=>'btn btn-default btn-block btn-h1-spacing'])}}
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