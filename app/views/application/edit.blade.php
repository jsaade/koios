@extends('layouts.default')


@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">{{ $application->name }}</div>
		<div class="panel-body">
			@include('common.form_error_messages', array('errors' => $errors))
			{{ Form::model($application, ['method' => 'PATCH','route' => ['application.update', $application->slug], 'files' => true, 'class' => 'form-horizontal']) }}
				@include('application.partials._form')
			{{ Form::close() }}		
		</div>
	</div>
@stop