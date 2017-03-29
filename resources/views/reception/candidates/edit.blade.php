@extends('reception.main')
@section('title','| Edit Candidate')
@section('stylesheet')
	{!! Html::style('css/parsley.css') !!}
	{!! Html::style('css/select2.min.css') !!}
@stop
@section('content')
<div class="row">
{!! Form::model($candidate,['route'=>['reception.candidates.update',$candidate->id,'data-parsley-validate'=>''],'method'=>'PUT','files'=>true]) !!}
	<div class="col-md-8">
		{{Form::label('appln_no','Appln No:')}}
		{{Form::text('appln_no',null,['class'=>'form-control','required'=>'','maxlength'=>'50', 'autofocus'=>'autofocus'])}}
			
		{{Form::label('name','Name:')}}
		{{Form::text('name',null,['class'=>'form-control','required'=>'','maxlength'=>'50', 'autofocus'=>'autofocus'])}}

		{{Form::label('phone','Phone:')}}
		{{Form::text('phone',null,['class'=>'form-control','data-parsley-type'=>'digits','maxlength'=>'12'])}}

		{{Form::label('email','Email:')}}
		{{Form::text('email',null,['class'=>'form-control','data-parsley-type'=>'digits','maxlength'=>'25'])}}

		  {{Form::label('father','Fathers Name:')}}
		  {{Form::text('father',null,['class'=>'form-control','required'=>'','maxlength'=>'50', 'autofocus'=>'autofocus'])}}

		{{Form::label('fphone','Fathers Phone:')}}
		  {{Form::text('fphone',null,['class'=>'form-control','data-parsley-type'=>'digits','maxlength'=>'12'])}}
		 
		  {{Form::label('mother','Mother/Guardian Name:')}}
		  {{Form::text('mother',null,['class'=>'form-control','required'=>'','maxlength'=>'50', 'autofocus'=>'autofocus'])}}

		{{Form::label('mphone','Mother/Guardian Phone:')}}
		  {{Form::text('mphone',null,['class'=>'form-control','data-parsley-type'=>'digits','maxlength'=>'12'])}}

		  {{Form::label('gender','Gender:')}}
		  {{Form::select('gender', ['M' => 'Male', 'F' => 'Female'],null,['class'=>'form-control'])}}

		  {{Form::label('dateofbirth','Date of Birth:')}}
		  {{Form::date('dateofbirth',null,['class'=>'form-control','maxlength'=>'20'])}}

		 {{Form::label('category_id','Category:')}}
		  {{Form::select('category_id', $categories ,null,['class'=>'form-control'])}}


		  {{Form::label('course_id','Course Applied:')}}
		  {{Form::select('course_id', $courses ,null,['class'=>'form-control','required'=>'','placeholder' => 'Pick a course...'])}}

		  {{Form::label('community_id','Community:')}}
		  {{Form::select('community_id', $communities ,null,['class'=>'form-control'])}}

		  {{Form::label('session','Session:')}}
		  {{Form::text('session',null,['class'=>'form-control','maxlength'=>'15'])}}

		  {{Form::label('qualification','Qualification:')}}
		  {{Form::text('qualification',null,['class'=>'form-control','maxlength'=>'10'])}}

		  {{Form::label('xboard','X Board:')}}
		  {{Form::text('xboard',null,['class'=>'form-control','maxlength'=>'40'])}}			    

		  {{Form::label('xpercent','X Percentage:')}}
		  {{Form::text('xpercent',null,['class'=>'form-control','maxlength'=>'12'])}}	

		  {{Form::label('xiiboard','XII Board:')}}
		  {{Form::text('xiiboard',null,['class'=>'form-control','maxlength'=>'40'])}}			    

		  {{Form::label('xiipercent','XII Percentage:')}}
		  {{Form::text('xiipercent',null,['class'=>'form-control','maxlength'=>'12'])}}	

		  {{Form::label('xiistream','XII Stream:')}}
		  {{Form::text('xiistream',null,['class'=>'form-control','maxlength'=>'10'])}}	

		  {{Form::label('uguniversity','UG University:')}}
		  {{Form::text('uguniversity',null,['class'=>'form-control','maxlength'=>'40'])}}	

		  {{Form::label('ugstream','UG Stream:')}}
		  {{Form::text('ugstream',null,['class'=>'form-control','maxlength'=>'10'])}}			    

		  {{Form::label('ugpercent','UG Percentage:')}}
		  {{Form::text('ugpercent',null,['class'=>'form-control','maxlength'=>'12'])}}	

		  {{Form::label('otherdegree','Other Degree:')}}
		  {{Form::text('otherdegree',null,['class'=>'form-control','maxlength'=>'20'])}}			    

		  {{Form::label('otherpercent','Other Percentage:')}}
		  {{Form::text('otherpercent',null,['class'=>'form-control','maxlength'=>'5'])}}	

 		  {{Form::label('receipt_no','Receipt No:')}}
		  {{Form::text('receipt_no',null,['class'=>'form-control','maxlength'=>'50'])}}
		
 		  {{Form::label('receipt_date','Receipt Date:')}}
		  {{Form::date('receipt_date',null,['class'=>'form-control','maxlength'=>'20'])}}

		  {{Form::label('address','Address:')}}
		  {{Form::text('address',null,['class'=>'form-control','maxlength'=>'100'])}}

		  {{Form::label('per_street','Permanent Street:')}}
		  {{Form::text('per_street',null,['class'=>'form-control','maxlength'=>'15'])}}

		  {{Form::label('per_city','Permanent City:')}}
		  {{Form::text('per_city',null,['class'=>'form-control','maxlength'=>'15'])}}

		  {{Form::label('per_district','Permanent District:')}}
		  {{Form::text('per_district',null,['class'=>'form-control','maxlength'=>'15'])}}

		  {{Form::label('per_state','Permanent State:')}}
		  {{Form::text('per_state',null,['class'=>'form-control','maxlength'=>'15'])}}

			{{Form::label('per_pin','Permanent Pin:')}}
		  {{Form::text('per_pin',null,['class'=>'form-control','maxlength'=>'10'])}}
		  
		  {{Form::submit('Edit Candidate',['class'=>'btn btn-success btn-lg btn-block','style'=>'margin-top:20px'])}}

	</div>
	<div class="col-md-4">
		<div class="well">
			<dl class="dl-horizontal">
				<dt>Created At</dt>
				<dd>{{date('M j, Y h:i',strtotime($candidate->created_at))}}</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Last Updated</dt>
				<dd>{{date('M j, Y h:i',strtotime($candidate->updated_at))}}</dd>
			</dl>
			
						
			<hr>

			<div class="row">
				<div class="col-sm-6">
					{!! Html::linkRoute('reception.candidates.show','Cancel',[$candidate],['class'=>'btn btn-danger btn-block']) !!}
				</div>
				<div class="col-sm-6">
				{{Form::submit('Save Changes',['class'=>'btn btn-success btn-block'])}}
				</div>

			</div>

			<div class="row">
				<div class="col-md-12">
				{{Html::linkRoute('reception.candidates.index','<<All Candidates',[],['class'=>'btn btn-default btn-block btn-h1-spacing'])}}
				</div>
			</div>
		</div>
	</div>
{!!Form::close()!!}
</div>
@stop
@section('scripts')

@stop