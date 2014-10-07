@extends('layouts.default')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<h1>Edit "{{ $category->name }}"</h1>
		</div>
	</div>

	<div class="row">
		<div class="col-md-4">
			 @include('common.form_error_messages', array('errors' => $errors))
			 
			{{ Form::model($category, ['method' => 'PATCH','route' => ['application.{application}.news-categories.update', $application->slug, $category->id]]) }}
				@include('news_category.partials._form')
			{{ Form::close() }}
		</div>
	</div>
@stop