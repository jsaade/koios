@extends('layouts.default')

@section('applicationMenu')
	
@stop

@section('content')

<div class="panel panel-default">
		<div class="panel-heading">Developer Console</div>
		<div class="panel-body">
				
				{{ Form::hidden('_api_home_url', $url ) }}<br/>
				{{ Form::select(
						'method', 
						['GET' => 'GET', 'POST' => 'POST'], 
						null, 
						['class' => 'form-control', 'style' => 'display: inline-block;width: 80px;']
					) }}
				<span style="margin-left:10px;margin-right:10px">{{ $url }}</span>
								
				{{ Form::text('console-url', null, [ 'class' => 'form-control', 'placeholder' => 'api url here...',  'style' => 'display: inline-block;width: 480px;'] ) }}
								
				<div id="post-params">
					 <div class="row params-container">
						<div class="col-md-2">
							{{ Form::text('post_key[]', null, [ 'class' => 'form-control', 'placeholder' => 'key...'] ) }}
						</div>
						<div class="col-md-2">
							{{ Form::text('post_value[]', null, [ 'class' => 'form-control', 'placeholder' => 'value...'] ) }}
						</div>
						<div class="col-md-1">
							<a href="#" class='remove-row'></a>
						</div>
					</div>
				</div>
	
			<div id="response"></div>
		</div>
</div>

@stop