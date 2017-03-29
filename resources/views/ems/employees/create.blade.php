@extends('ems.main')
@section('title','| Create New Employee')
@section('stylesheet')
	{!! Html::style('css/parsley.css') !!}
	{!! Html::style('css/select2.min.css') !!}
@stop
@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-1">
			<h1>Create Employee</h1>
			<hr>
			{!! Form::open(['route' => 'ems.employees.store','data-parsley-validate'=>'','files'=>true]) !!}

			

				{{Form::label('doj','Year of Joining:')}}
			    {{Form::text('doj',null,['class'=>'form-control','required'=>'','data-parsley-type'=>'digits','maxlength'=>'4', 'autofocus'=>'autofocus'])}}

			    {{Form::label('title','Title:')}}
			    {{Form::select('title', ['Mr'=>'Mr', 'Miss'=>'Miss', 'Madam'=>'Madam'],null,['class'=>'form-control','required'=>'','placeholder' => 'Select Title'])}}

			    {{Form::label('Sname','Sur Name:')}}
			    {{Form::text('Sname',null,['class'=>'form-control','required'=>'','maxlength'=>'50'])}}

			    {{Form::label('Fname','First Name:')}}
			    {{Form::text('Fname',null,['class'=>'form-control','required'=>'','maxlength'=>'50'])}}
			    
			    {{Form::label('Mname','Middle Name:')}}
			    {{Form::text('Mname',null,['class'=>'form-control','maxlength'=>'50'])}}

			    {{Form::label('gender','Gender:')}}
			    {{Form::select('gender', ['M'=>'Male', 'F'=>'Female'] ,null,['class'=>'form-control','required'=>'','placeholder' => 'Select Gender'])}}

				{{Form::label('f_name','Father\'s Name:')}}
			    {{Form::text('f_name',null,['class'=>'form-control','required'=>'','maxlength'=>'50'])}}

			    {{Form::label('m_name','Mother\'s Name:')}}
			    {{Form::text('m_name',null,['class'=>'form-control','maxlength'=>'50'])}}

			    {{Form::label('addressline1','Address Line 1:')}}
			    {{Form::text('addressline1',null,['class'=>'form-control','required'=>'','maxlength'=>'50'])}}

			    {{Form::label('addressline2','Address Line 2:')}}
			    {{Form::text('addressline2',null,['class'=>'form-control','maxlength'=>'50'])}}

			    {{Form::label('postalcode','Postal Code:')}}
			    {{Form::text('postalcode',null,['class'=>'form-control','maxlength'=>'50'])}}

			    {{Form::label('city','City/Village:')}}
			    {{Form::text('city',null,['class'=>'form-control','required'=>'', 'maxlength'=>'50'])}}

			    {{Form::label('state','State:')}}
			    {{Form::select('state', ['Assam', 'Arunachal Pradesh', 'Bihar', 'Chandigarh', 'Delhi', 'Gujarat', 'Haryana', 'Manipur', 'Megalaya', 'Mizoram', 'Punjab', 'Rajasthan'] ,null,['class'=>'form-control','required'=>'','placeholder' => 'Select State'])}}

			    {{Form::label('community_id','Religion:')}}
			    {{Form::select('community_id', $communities ,null,['class'=>'form-control','required'=>'','placeholder' => 'Select Religion'])}}

			    {{Form::label('category_id','Caste:')}}
			    {{Form::select('category_id', $categories, null,['class'=>'form-control','required'=>'','placeholder' => 'Select Caste'])}}

			    {{Form::label('dob','Date of Birth:')}}
			    {{Form::date('dob',null,['class'=>'form-control'])}}

			    {{Form::label('pan','PAN No.:')}}
			    {{Form::text('pan',null,['class'=>'form-control','maxlength'=>'10'])}}

			    {{Form::label('stdcode','STD Code:')}}
			    {{Form::text('stdcode',null,['class'=>'form-control','maxlength'=>'10'])}}

			    {{Form::label('landline','Landline:')}}
			    {{Form::text('landline',null,['class'=>'form-control','maxlength'=>'8'])}}

			    {{Form::label('mobile','Mobile:')}}
			    {{Form::text('mobile',null,['class'=>'form-control','maxlength'=>'10'])}}

			    {{Form::label('email','Email Address:')}}
			    {{Form::text('email',null,['class'=>'form-control','maxlength'=>'30'])}}

			    {{Form::label('fax','Fax Phone No.:')}}
			    {{Form::text('fax',null,['class'=>'form-control','maxlength'=>'10'])}}

			    {{Form::label('designation','Designation:')}}
			    {{Form::text('designation',null,['class'=>'form-control','maxlength'=>'30'])}}

			    {{Form::label('appointment','Appointment Type:')}}
			    {{Form::select('appointment', ['FT'=>'Full Time', 'PT'=>'Part Time','Other'=>'Other'] ,null,['class'=>'form-control','required'=>'','placeholder' => 'Select Type'])}}

			    {{Form::label('grosspay','Gross Pay/Month:')}}
			    {{Form::text('gross_pay',null,['class'=>'form-control','maxlength'=>'30'])}}

			    {{Form::label('appointment_type','Appointent Type:')}}
			    {{Form::text('appointment_type',null,['class'=>'form-control','maxlength'=>'30'])}}

			    {{Form::label('faculty_type','Faculty Type:')}}
			    {{Form::text('faculty_type',null,['class'=>'form-control','maxlength'=>'30'])}}

			    {{Form::label('payscale','Pay Scale:')}}
			    {{Form::text('payscale',null,['class'=>'form-control','maxlength'=>'30'])}}

			    {{Form::label('programme','Programme:')}}
			    {{Form::text('programme',null,['class'=>'form-control','maxlength'=>'30'])}}

			    {{Form::label('course','Course:')}}
			    {{Form::text('course',null,['class'=>'form-control','maxlength'=>'30'])}}

			    {{Form::label('salarymode','Salary Mode:')}}
			    {{Form::text('salarymode',null,['class'=>'form-control','maxlength'=>'30'])}}

			    {{Form::label('pf_number','PF Number:')}}
			    {{Form::text('pf_number',null,['class'=>'form-control','maxlength'=>'30'])}}

			    {{Form::label('payband','Pay Scale:')}}
			    {{Form::text('payband',null,['class'=>'form-control','maxlength'=>'30'])}}

			    {{Form::label('ug_degree','UG Degree:')}}
			    {{Form::text('ug_degree',null,['class'=>'form-control','maxlength'=>'50'])}}

			    {{Form::label('other_qualification','Other Qualification:')}}
			    {{Form::text('other_qualification',null,['class'=>'form-control','maxlength'=>'50'])}}

			    {{Form::label('specialization','Specialization:')}}
			    {{Form::text('specialization',null,['class'=>'form-control','maxlength'=>'50'])}}

			    {{Form::label('teaching_exp','Teaching Experience (in years):')}}
			    {{Form::text('teaching_exp',null,['class'=>'form-control','data-parsley-type'=>'digits','maxlength'=>'2'])}}
			    <div class="hidden">
			    {{Form::text('eid',Auth::user()->id,['class'=>'form-control','data-parsley-type'=>'digits','maxlength'=>'2'])}}
			    </div>
				{{Form::label('photo','Upload photo:')}}
				{{Form::file('photo',['class'=>'form-control'])}}
			
			    {{Form::submit('Create Employee',['class'=>'btn btn-success btn-lg btn-block','style'=>'margin-top:20px'])}}
			
			
			{!! Form::close() !!}
		</div>
		<div class="col-md-2">
		{!! Form::open(['route' => 'sms.excel.import','method'=>'post','data-parsley-validate'=>'','files'=>true]) !!}
			{{Form::label('import','Select Excel(.CSV) file:')}}
			{{Form::file('import',['accept'=>'.csv' ,'class'=>'form-control'])}}
		
		    {{Form::submit('Import',['class'=>'btn btn-success btn-lg btn-block','style'=>'margin-top:20px'])}}
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