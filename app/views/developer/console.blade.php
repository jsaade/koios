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
		{{ Form::hidden('_api_home_url', $url ) }}<br/>
		<div class="col-md-10 col-md-push-1">
			<div class="row">
				<div class="col-md-2">
					Method: {{ Form::select(
						'method', 
						['GET' => 'GET', 'POST' => 'POST'], 
						null, 
						['class' => 'form-control-inline form-control']
					) }}
				</div>

				<div class="col-md-10">
					<div class="row">
						<div class="col-md-3 url-prefix">
							{{ $url }}
						</div>
						<div class="col-md-9">
							{{ Form::text('console-url', null, [ 'class' => 'form-control', 'placeholder' => 'api url here...'] ) }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="row">
		<div class="col-md-10 col-md-push-1">
			<div id="response"></div>
		</div>
	</div>

@stop