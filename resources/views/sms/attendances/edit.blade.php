@extends('reception.main')
@section('title','| Edit Entrance')
@section('stylesheet')
	{!! Html::style('css/parsley.css') !!}
	{!! Html::style('css/select2.min.css') !!}
@stop
@section('content')
<div class="row">
{!! Form::model($entrance,['route'=>['reception.entrances.update',$entrance->id,'data-parsley-validate'=>''],'method'=>'PUT','files'=>true]) !!}
	<div class="col-md-8">
		{{Form::label('appln_no','Appln No:')}}
		{{Form::text('appln_no',null,['class'=>'form-control','required'=>'','maxlength'=>'50', 'autofocus'=>'autofocus','readonly'=>'true'])}}
			
		{{Form::label('name','Name:')}}
		{{Form::text('name',null,['class'=>'form-control','required'=>'','maxlength'=>'50', 'autofocus'=>'autofocus'])}}

   	    {{Form::label('father','Fathers Name:')}}
		{{Form::text('father',null,['class'=>'form-control','required'=>'','maxlength'=>'50', 'autofocus'=>'autofocus'])}}
		 
		{{Form::label('marks','Marks:')}}
		{{Form::text('marks',null,['class'=>'form-control','required'=>'','maxlength'=>'5', 'autofocus'=>'autofocus'])}}

	  	{{Form::label('course_id','Course Applied:')}}
		{{Form::select('course_id', $courses ,null,['class'=>'form-control','required'=>'','placeholder' => 'Pick a course...'])}}

		{{Form::label('session','Session:')}}
		{{Form::text('session',null,['class'=>'form-control','required'=>'','maxlength'=>'5'])}}

		{{Form::label('remarks','Remarks:')}}
		{{Form::text('remarks',null,['class'=>'form-control','maxlength'=>'50'])}}

		 
	</div>
	<div class="col-md-4">
		<div class="well">
			<dl class="dl-horizontal">
				<dt>Created At</dt>
				<dd>{{date('M j, Y h:i',strtotime($entrance->created_at))}}</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Last Updated</dt>
				<dd>{{date('M j, Y h:i',strtotime($entrance->updated_at))}}</dd>
			</dl>
			
						
			<hr>

			<div class="row">
				<div class="col-sm-6">
					{!! Html::linkRoute('reception.entrances.show','Cancel',[$entrance],['class'=>'btn btn-danger btn-block']) !!}
				</div>
				<div class="col-sm-6">
				{{Form::submit('Save Changes',['class'=>'btn btn-success btn-block'])}}
				</div>

			</div>

			<div class="row">
				<div class="col-md-12">
				{{Html::linkRoute('reception.entrances.index','<<All Entrances',[],['class'=>'btn btn-default btn-block btn-h1-spacing'])}}
				</div>
			</div>
		</div>
	</div>
{!!Form::close()!!}
</div>
@stop
@section('scripts')

@stop