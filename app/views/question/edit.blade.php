@extends('layouts.default')

@section('applicationMenu')
	{{ $application->renderMenu() }}
@stop


@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">Edit News</div>
		<div class="panel-body">
			@include('common.form_error_messages', array('errors' => $errors))
			{{ Form::model($question, ['method' => 'PATCH','route' => ['application.{application}.questions.update', $application->slug, $question->id], 'files' => true, 'class' => 'form-horizontal']) }}
				@include('question.partials._form')
			{{ Form::close() }}
		</div>
	</div>
@stop