@extends('layouts.default')

@section('applicationMenu')
	{{ $application->renderMenu() }}
@stop


@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">Edit Contact Form</div>
		<div class="panel-body">
			@include('common.form_error_messages', array('errors' => $errors))
			{{ Form::model($contact_form, ['method' => 'PATCH','route' => ['application.{application}.contact-forms.update', $application->slug, $contact_form->id], 'files' => true, 'class' => 'form-horizontal']) }}
				@include('contact_forms.partials._form')
			{{ Form::close() }}

		</div>
	</div>
@stop
