@extends('layouts.default')

@section('applicationMenu')
	
@stop


@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">API Docs</div>
		<div class="panel-body">
			<div class="col-sm-8 api-docs">
				@include('developer.partials._docs_authorization')
				@include('developer.partials._docs_subscribers')
				@include('developer.partials._docs_tokens')
				@include('developer.partials._docs_news')
				@include('developer.partials._docs_questions')
				@include('developer.partials._docs_games')
				@include('developer.partials._docs_games_leaderboard')
				@include('developer.partials._docs_limits_and_codes')
			</div>
			<div class="col-sm-3 col-md-push-1 sidebar-nav">
				@include('developer.partials._sidebar_api_nav')
			</div>
		</div>
	</div>
@stop