@extends('sms.main')
@section('title','| Edit Subject')
@section('stylesheet')
	{!! Html::style('css/select2.min.css') !!}
@stop
@section('content')

<div class="row">
	<div class="col-md-6">
	<a href="{{route('sms.students.edit',$student->id)}}" class="btn btn-warning btn-block btn-h1-spacing">Back to Edit</a>
	</div>
	
	<div class="col-md-6">
	{{Html::linkRoute('sms.students.index','Back to All Students',[],['class'=>'btn btn-primary btn-block btn-h1-spacing'])}}
	</div>
</div>
<hr>
<div class="row">
	<div class="col-md-12">

	{!! Form::model($student,['route'=>['sms.students.updateSubject',$student->id],'method'=>'PUT']) !!}
		{{Form::label('editsubject','Select Subjects:')}}
		{{Form::select('subjects[]',$subjects,null,['class'=>'select2-multi form-control','multiple'=>'multiple'])}}
		
		{{Form::submit('Save Changes',['class'=>'btn btn-success btn-h1-spacing'])}}

	{!!Form::close()!!}
	</div>
	
	<div class="col-md-6">
	<h1>OR</h1>
		<a href="{{route('sms.students.addAll',$student->id)}}" class="btn btn-danger btn-h1-spacing">Automatic Add All Subjects</a>
	</div>
</div>

@stop
@section('scripts')
	{!! Html::script('js/select2.min.js') !!}
	<script type="text/javascript">
		$('.select2-multi').select2();

		$('.select2-multi').select2().val({!! json_encode($student->subjects()->getRelatedIds()) !!}).trigger('change');
	</script>
@stop