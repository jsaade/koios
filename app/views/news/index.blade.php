@extends('layouts.default')

@section('applicationMenu')
	{{ $application->renderMenu() }}
@stop


@section('content')

	@if (!count($news))
		<p class="unfortunate">You haven't created any news yet :(</p>
		{{ HTML::linkAction('NewsController@create', 'Create One Now', [$application->slug], ['class' => 'btn btn-primary centered']) }}
	@else
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left">News List</div>
				<div class="pull-right">
					<span class="panel-heading-links">
						
						{{ HTML::linkAction('NewsController@create', 'Create News', [$application->slug], ['class' => '']) }}
						<i class="icon-fixed-width  icon-plus-sign"></i>
			
						{{ HTML::linkAction('NewsCategoryController@index', 'Manage Categories', [$application->slug], ['class' => '']) }}
						<i class="icon-fixed-width  icon-paper-clip"></i>

					</span>
				</div>
				<div class="clearfix"></div>
			</div> <!-- end heading -->
			<div class="panel-body">
					{{ Form::hidden('news-url', $url, ['id' => 'news-url']) }}
					<div class="col-sm-4 pull-right filter-news">
						{{ Form::select(
							'news_category_filter', 
							['0' => 'Filter by category'] + $cats, 
							isset($category_id)?$category_id:0, 
							['class' => 'form-control', 'id' => 'news_category_filter']
						) }}
					</div>
					<div class="clearfix"></div>

					<table class="table table-striped">
					<tr>
						<th>Thumb</th>
						<th>Title</th>
						<th>Date</th>
						<th>Category</th>
						<th>Push Notification</th>
						<th class="actions">Action</th>
					</tr>
					@foreach($news as $single_news)
						@include('news.partials._list_row', $single_news)
					@endforeach
				</table>

				<div class="centered">
					{{ $news->appends(Request::except('page'))->links() }}
				</div>
			</div> <!-- end body -->
		</div>
	@endif
@stop