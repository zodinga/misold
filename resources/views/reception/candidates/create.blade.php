@extends('reception.main')
@section('title','| Create New Candidate')
@section('stylesheet')
	{!! Html::style('css/parsley.css') !!}
	{!! Html::style('css/select2.min.css') !!}
@stop
@section('content')
	<div class="row">

		<div class="col-md-6 col-md-offset-1">
			{!!Form::open(['route'=>'reception.candidates.createsearch','method'=>'get','class'=>'navbar-form navbar-left'])!!}
		        <div class="form-group">
		          <input type="text" id="appln" name="appln" class="form-control form-spacing-top" placeholder="Search by Appln No">
	            </div>
		        <button type="submit" class="btn btn-success form-spacing-top">Prospectus Search</button>
			{!!Form::close()!!}
		</div>
		<hr>
	</div>
	<div class="row">
		<div class="col-md-6 col-md-offset-1">
			<h1>Create Candidate</h1>
			<hr>
			{!! Form::model($candidate,['route'=>['reception.candidates.store','data-parsley-validate'=>''],'method'=>'POST','files'=>true]) !!}
   				{{Form::label('appln_no','Appln No:')}}
			    {{Form::text('appln_no',null,['class'=>'form-control','required'=>'','maxlength'=>'50', 'autofocus'=>'autofocus'])}}
			
			    {{Form::label('name','Name:')}}
			    {{Form::text('name',null,['class'=>'form-control','required'=>'','maxlength'=>'50', 'autofocus'=>'autofocus'])}}

				{{Form::label('phone','Phone:')}}
			    {{Form::text('phone',null,['class'=>'form-control','data-parsley-type'=>'digits','maxlength'=>'12'])}}

				{{Form::label('email','Email:')}}
 				{{Form::email('email',null,['class'=>'form-control','data-parsley-type'=>'email'])}}

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
			    {{Form::date('dateofbirth','Carbon\Carbon::now()->format("Y-m-d")',['class'=>'form-control','maxlength'=>'20'])}}

			   	{{Form::label('category_id','Category:')}}
			    {{Form::select('category_id', $categories ,null,['class'=>'form-control'])}}

			    {{Form::label('course_id','Course Applied:')}}
			    {{Form::select('course_id', $courses ,null,['class'=>'form-control'])}}

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
			    {{Form::date('receipt_date','Carbon\Carbon::now()',['class'=>'form-control','maxlength'=>'20'])}}

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
			    
			    {{Form::submit('Create Candidate',['class'=>'btn btn-success btn-lg btn-block','style'=>'margin-top:20px'])}}
			
			
			{!! Form::close() !!}
		</div>

	</div>
@stop
@section('scripts')

@stop