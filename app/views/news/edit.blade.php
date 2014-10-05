@extends('layouts.default')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<h1>Edit "{{ $news->name }}"</h1>
		</div>
	</div>

	<div class="row">
		<div class="col-md-4">
			 @include('common.form_error_messages', array('errors' => $errors))
			 
			{{ Form::model($news, ['method' => 'PATCH','route' => ['application.{application}.news.update', $application->slug, $news->id], 'files' => true]) }}
				@include('news.partials._form')
			{{ Form::close() }}
		</div>
	</div>
@stop