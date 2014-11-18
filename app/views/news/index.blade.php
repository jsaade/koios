@extends('layouts.default')

@section('applicationMenu')
	{{ $application->renderMenu() }}
@stop


@section('content')
	<div class="row">
		<div class="col-md-12">
			<h1>
				{{ $application->name }} - News List
				{{ HTML::linkAction('NewsController@create', 'Create News', [$application->slug], ['class' => 'btn btn-primary pull-right']) }}
			</h1>
		</div>
	</div>

	@if (!count($news))
		<div class="row">
			<div class="col-md-12 centered">
				<p class="unfortunate">You haven't created any news yet :(</p>
				{{ HTML::linkAction('NewsController@create', 'Create One Now', [$application->slug], ['class' => 'btn btn-primary centered']) }}
			</div>
		</div>
	@else
		<div class="row">
			<div class="col-md-12">
				<table class="listing">
					<tr>
						<th>Thumb</th>
						<th>Title</th>
						<th>Category</th>
						<th>Action</th>
					</tr>
					@foreach($news as $single_news)
						@include('news.partials._list_row')
					@endforeach
				</table>

				<div class="centered">
					{{ $news->appends(Request::except('page'))->links() }}
				</div>
			</div>
		</div>
	@endif
@stop