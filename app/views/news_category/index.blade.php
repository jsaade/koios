@extends('layouts.default')

@section('applicationMenu')
	{{ $application->renderMenu() }}
@stop

@section('content')
	<div class="row">
		<div class="col-md-12">
			<h1>
				{{ $application->name }} - News Categories List
			</h1>
		</div>
	</div>

	<div class="row">
		
		<div class="col-md-6" id="news-category-list">
			@include('news_category.partials._list')
		</div>

		<div class="col-md-4 pull-right">
			<p class="form-title">Create a news category:</p>

			@include('common.ajax_form_errors', ['id' => 'frm-add-alert'])
			
			{{ Form::open( ['data-remote' => true, 'data-callback' => 'updateNewsCategoriesList', 'route' => ['application.{application}.news-categories.store', $application->slug]]) }}
				@include('news_category.partials._form')
			{{ Form::close() }}
		</div>
	</div>
@stop