@extends('reception.main')
@section('title','| Create New Prospectus')
@section('stylesheet')
	{!! Html::style('css/parsley.css') !!}
	{!! Html::style('css/select2.min.css') !!}
@stop
@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-1">
			<h1>Create Prospectus</h1>
			<hr>
			{!! Form::open(['route' => 'reception.prospectuses.store','data-parsley-validate'=>'','files'=>true]) !!}

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
			    {{Form::text('qualification',null,['class'=>'form-control','maxlength'=>'10'])}}

			    {{Form::label('course_id','Course Applied:')}}
			    {{Form::select('course_id', $courses ,null,['class'=>'form-control','required'=>'','placeholder' => 'Pick a course...'])}}

		   		{{Form::label('category_id','Category:')}}
			    {{Form::select('category_id', $categories ,null,['class'=>'form-control'])}}

			    {{Form::label('receipt_no','Receipt No:')}}
			    {{Form::text('receipt_no',null,['class'=>'form-control','maxlength'=>'50'])}}
			  
 			    {{Form::label('receipt_date','Receipt Date:')}}
			    {{Form::date('receipt_date',Carbon\Carbon::now()->format('Y-m-d'),['class'=>'form-control','maxlength'=>'20','date-format'=>'Y-m-d'])}}
			
			    {{Form::label('address','Address:')}}
			    {{Form::text('address',null,['class'=>'form-control','maxlength'=>'100'])}}

			    {{Form::label('remarks','Remarks:')}}
			    {{Form::text('remarks',null,['class'=>'form-control','maxlength'=>'30'])}}

			    
			     {{Form::label('dd_number','DD Number:')}}
			    {{Form::text('dd_number',null,['class'=>'form-control','maxlength'=>'10'])}}
			    {{Form::label('dd_amount','DD amount:')}}
			    {{Form::text('dd_amount',null,['class'=>'form-control','data-parsley-type'=>'number'])}}
			    {{Form::label('dd_bank','DD Bank:')}}
			    {{Form::text('dd_bank',null,['class'=>'form-control','maxlength'=>'50'])}}
			    {{Form::label('dd_date','DD Date:')}}
			    {{Form::date('dd_date',null,['class'=>'form-control','maxlength'=>'20','date-format'=>'Y-m-d'])}}



			    {{Form::submit('Create Prospectus',['class'=>'btn btn-success btn-lg btn-block','style'=>'margin-top:20px'])}}
			
			
			{!! Form::close() !!}
		</div>
	</div>
@stop
@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
	{!! Html::script('js/select2.min.js') !!}

	<script type="text/javascript">

	$('.select2-multi').select2();

	function jsFunction(){
					var myselect=document.getElementById("course_id");
					var cc=myselect.options[myselect.selectedIndex].value;

				}
	</script>
@stop