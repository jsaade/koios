@extends('layouts.default')

@section('applicationMenu')
	{{ $application->renderMenu() }}
@stop

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">Edit News</div>
		<div class="panel-body">
			@include('common.form_error_messages', array('errors' => $errors))
			{{ Form::model($news, ['method' => 'PATCH','route' => ['application.{application}.news.update', $application->slug, $news->id], 'files' => true, 'class' => 'form-horizontal']) }}
				@include('news.partials._form')
			{{ Form::close() }}
		</div>
	</div>
@stop