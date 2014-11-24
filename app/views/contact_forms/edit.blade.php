@extends('layouts.default')

@section('applicationMenu')
	{{ $application->renderMenu() }}
@stop

@section('content')
	<div class="row">
		<div class="col-md-12">
			<h1>{{ $application->name }} - Edit "{{ $contact_form->name }}"</h1>
		</div>
	</div>

	<div class="row">
		<div class="col-md-4">
			 @include('common.form_error_messages', array('errors' => $errors))
			 
			{{ Form::model($contact_form, ['method' => 'PATCH','route' => ['application.{application}.contact-forms.update', $application->slug, $contact_form->id], 'files' => true]) }}
				@include('contact_forms.partials._form')
			{{ Form::close() }}
		</div>
	</div>
@stop