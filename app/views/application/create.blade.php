@extends('layouts.default')

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">Create Application</div>
		<div class="panel-body">
			@include('common.form_error_messages', array('errors' => $errors))
			{{ Form::open(array('route' => 'application.store', 'files' => true, 'class' => 'form-horizontal')) }}
				@include('application.partials._form')
			{{ Form::close() }}
		</div>
	</div>
@stop