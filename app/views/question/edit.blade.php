@extends('layouts.default')

@section('applicationMenu')
	{{ $application->renderMenu() }}
@stop

@section('content')
	<div class="row">
		<div class="col-md-12">
			<h1>{{ $application->name }} - Edit "{{ $question->description }}"</h1>
		</div>
	</div>

	<div class="row">
		<div class="col-md-4">
			 @include('common.form_error_messages', array('errors' => $errors))
			 
			{{ Form::model($question, ['method' => 'PATCH','route' => ['application.{application}.questions.update', $application->slug, $question->id], 'files' => true]) }}
				@include('question.partials._form')
			{{ Form::close() }}
		</div>
	</div>
@stop