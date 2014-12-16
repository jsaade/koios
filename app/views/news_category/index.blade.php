@extends('layouts.default')

@section('applicationMenu')
	{{ $application->renderMenu() }}
@stop

@section('content')
	
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="pull-left">News Categories</div>
			<div class="clearfix"></div>
		</div> <!-- end heading -->
		<div class="panel-body">
			<div class="row">
				<div class="col-sm-7">
					{{ Form::hidden('sort-url', $sort_url, ['id' => 'sort-url']) }}
					<p>Drag and drop categories to change their hierarchy.</p>
					<div id="news-category-list">
						@include('news_category.partials._list')
					</div>
				</div>
				<div class="col-sm-4 col-sm-offset-1">
					<p>Create a news category:</p>
					@include('common.ajax_form_errors', ['id' => 'frm-add-alert'])
					{{ Form::open( ['data-remote' => true, 'data-callback' => 'updateNewsCategoriesList', 'route' => ['application.{application}.news-categories.store', $application->slug]]) }}
						@include('news_category.partials._form')
					{{ Form::close() }}
				</div>
			</div>
		</div> <!-- end body -->
	</div>
@stop