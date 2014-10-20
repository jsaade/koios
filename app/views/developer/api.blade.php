@extends('layouts.default')

@section('applicationMenu')
	
@stop

@section('content')
	<div class="row">
		<div class="col-md-12">
			<h1>API Docs</h1>
			<div class="row">
				<div class="col-md-8 api-docs">
					@include('developer.partials._docs_authorization')
					@include('developer.partials._docs_subscribers')
					@include('developer.partials._docs_news')
					@include('developer.partials._docs_questions')
					@include('developer.partials._docs_limits_and_codes')
				</div>
				<div class="col-md-3 col-md-push-1 sidebar-nav">
					@include('developer.partials._sidebar_api_nav')
				</div>
			</div>
		</div>
	</div>
@stop