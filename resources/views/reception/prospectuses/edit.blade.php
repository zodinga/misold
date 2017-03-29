@extends('reception.main')
@section('title','| Edit Prospectus')
@section('stylesheet')
	{!! Html::style('css/parsley.css') !!}
	{!! Html::style('css/select2.min.css') !!}
@stop
@section('content')
<div class="row">
{!! Form::model($prospectus,['route'=>['reception.prospectuses.update',$prospectus->id,'data-parsley-validate'=>''],'method'=>'PUT','files'=>true]) !!}
	<div class="col-md-8">
				{{Form::label('appln_no','Appln No:')}}
			    {{Form::text('appln_no',null,['class'=>'form-control','required'=>'','maxlength'=>'50', 'autofocus'=>'autofocus'])}}
			
			    {{Form::label('firstname','Name:')}}
			    {{Form::text('firstname',null,['class'=>'form-control','required'=>'','maxlength'=>'50', 'autofocus'=>'autofocus'])}}


			    {{Form::label('father','Fathers Name:')}}
			    {{Form::text('father',null,['class'=>'form-control','required'=>'','maxlength'=>'50', 'autofocus'=>'autofocus'])}}

			    {{Form::label('phone','Phone:')}}
			    {{Form::text('phone',null,['class'=>'form-control','data-parsley-type'=>'digits','maxlength'=>'12'])}}

			    {{Form::label('gender','Gender:')}}
			    {{Form::select('gender', ['M' => 'Male', 'F' => 'Female'],null,['class'=>'form-control'])}}

			     {{Form::label('qualification','Qualification:')}}
			    {{Form::text('qualification',null,['class'=>'form-control','maxlength'=>'100'])}}

			    {{Form::label('course_id','Course Applied:')}}
			    {{Form::select('course_id', $courses ,null,['class'=>'form-control','required'=>'','placeholder' => 'Pick a course...'])}}

		   		{{Form::label('category_id','Category:')}}
			    {{Form::select('category_id', $categories ,null,['class'=>'form-control'])}}

			    {{Form::label('receipt_no','Receipt No:')}}
			    {{Form::text('receipt_no',null,['class'=>'form-control','maxlength'=>'50'])}}

			    {{Form::label('receipt_date','Receipt Date:')}}
			    {{Form::date('receipt_date',null,['class'=>'form-control','maxlength'=>'30'])}}

			    {{Form::label('dd_number','DD Number:')}}
			    {{Form::text('dd_number',null,['class'=>'form-control','data-parsley-type'=>'number'])}}

			    {{Form::label('dd_amount','DD amount:')}}
			    {{Form::text('dd_amount',null,['class'=>'form-control','maxlength'=>'10'])}}

			    {{Form::label('dd_bank','DD Bank:')}}
			    {{Form::text('dd_bank',null,['class'=>'form-control','maxlength'=>'50'])}}

			    {{Form::label('dd_date','DD Date:')}}
			    {{Form::date('dd_date',null,['class'=>'form-control','maxlength'=>'30'])}}

			    {{Form::label('remarks','Remarks:')}}
			    {{Form::text('remarks',null,['class'=>'form-control','maxlength'=>'30'])}}

			    {{Form::label('address','Address:')}}
			    {{Form::text('address',null,['class'=>'form-control','maxlength'=>'100'])}}

	</div>
	<div class="col-md-4">
		<div class="well">
			<dl class="dl-horizontal">
				<dt>Created At</dt>
				<dd>{{date('M j, Y h:i',strtotime($prospectus->created_at))}}</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Last Updated</dt>
				<dd>{{date('M j, Y h:i',strtotime($prospectus->updated_at))}}</dd>
			</dl>
			
						
			<hr>

			<div class="row">
				<div class="col-sm-6">
					{!! Html::linkRoute('reception.prospectuses.show','Cancel',[$prospectus],['class'=>'btn btn-danger btn-block']) !!}
				</div>
				<div class="col-sm-6">
				{{Form::submit('Save Changes',['class'=>'btn btn-success btn-block'])}}
				</div>

			</div>

			<div class="row">
				<div class="col-md-12">
				{{Html::linkRoute('reception.prospectuses.index','<<All Prospectus',[],['class'=>'btn btn-default btn-block btn-h1-spacing'])}}
				</div>
			</div>
		</div>
	</div>
{!!Form::close()!!}
</div>
@stop
@section('scripts')

@stop