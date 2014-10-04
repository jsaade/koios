@extends('layouts.default')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<h1>Edit {{ $application->name }}</h1>
		</div>
	</div>

	<div class="row">
		<div class="col-md-4">
			 @include('common.form_error_messages', array('errors' => $errors))

			{{ Form::model($application, ['method' => 'PATCH','route' => ['application.update', $application->slug], 'files' => true]) }}
				@include('application.partials._form')
			{{ Form::close() }}
		</div>
	</div>
@stop