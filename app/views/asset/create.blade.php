@extends('layouts.default')

@section('applicationMenu')
	{{ $application->renderMenu() }}
@stop

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">Create Asset</div>
		<div class="panel-body">
			@include('common.form_error_messages', array('errors' => $errors))
			{{ Form::open( ['route' => ['application.{application}.assets.store', $application->slug], 'files' => true, 'class' => 'form-horizontal']) }}
				@include('asset.partials._form')
			{{ Form::close() }}
		</div>
	</div>
@stop