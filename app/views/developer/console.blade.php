@extends('layouts.default')

@section('applicationMenu')
	
@stop

@section('content')
	<div class="row">
		<div class="col-md-12">
			<h1>Developer Console</h1>
		</div>
	</div>
	<br/>
	<div class="row">
		{{ Form::hidden('action', $action ) }}
		<div class="col-md-3 col-md-push-1 url-prefix">
			{{ $url }}
		</div>

		<div class="col-md-7 col-md-push-1">
			{{ Form::text('console-url', null, [ 'class' => 'form-control', 'placeholder' => 'api url here...'] ) }}
		</div>
	</div>

	<div class="row">
		<div class="col-md-10 col-md-push-1">
			<div id="response"></div>
		</div>
	</div>

@stop