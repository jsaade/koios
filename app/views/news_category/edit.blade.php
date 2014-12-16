@extends('layouts.default')

@section('applicationMenu')
	{{ $application->renderMenu() }}
@stop

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">Edit News Category</div>
		<div class="panel-body">
			@include('common.form_error_messages', array('errors' => $errors))
			{{ Form::model($category, ['method' => 'PATCH','route' => ['application.{application}.news-categories.update', $application->slug, $category->id]]) }}
				@include('news_category.partials._form')
			{{ Form::close() }}
		</div>
	</div>
@stop


