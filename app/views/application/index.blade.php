@extends('layouts.default')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<h1>
				Applications List
				{{ HTML::linkAction('ApplicationController@create', 'Create One Now', array(), array('class' => 'btn btn-primary pull-right')) }}
			</h1>
		</div>
	</div>

	@if (!count($clients))
		<div class="row">
			<div class="col-md-12 centered">
				<p class="unfortunate">You haven't create any application yet :(</p>
				{{ HTML::linkAction('ApplicationController@create', 'Create One Now', array(), array('class' => 'btn btn-primary centered')) }}
			</div>
		</div>
	@else
		@foreach($clients as $client)
			<div class="row">
				<div class="col-md-12">
					<h3>{{ $client->name }}</h3>
				</div>
				@foreach($client->applications as $application)
					<div class="col-md-6">
						<div class="app-card">

							<div class="app-card-image col-md-3">
								<img src="{{ asset($application->image) }}" />
							</div>
							<div class="app-card-info col-md-9">
								<h5 class="app-title">{{ $application->name }}</h5>
								<p>{{ $application->description }}</p>
								<p><strong>api key:</strong><code>{{ $application->api_key }}</code></p>
								<p><strong>api secret:</strong><code>{{ $application->api_secret }}</code></p>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		@endforeach
	@endif
@stop