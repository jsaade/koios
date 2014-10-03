@extends('layouts.default')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<h1>
				Applications List
				{{ HTML::linkAction('ApplicationController@create', 'Create Application', [], ['class' => 'btn btn-primary pull-right']) }}
			</h1>
		</div>
	</div>

	@if (!count($clients))
		<div class="row">
			<div class="col-md-12 centered">
				<p class="unfortunate">You haven't create any application yet :(</p>
				{{ HTML::linkAction('ApplicationController@create', 'Create One Now', [], ['class' => 'btn btn-primary centered']) }}
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
							{{ HTML::linkAction('ApplicationController@edit', '', [$application->slug], ['class' => 'app-card-edit pull-right']) }}
							<div class="app-card-image col-md-3">
								<img src="{{ asset($application->image) }}" />
							</div>
							<div class="app-card-info col-md-9">
								<h5 class="app-title">{{ $application->name }}</h5>
								<p>{{ $application->description }}</p>
								<p class="no-mb">
									<strong>api key:</strong>
									<div class="api"><code>{{ $application->api_key }}</code></div>
								</p>
								<p class="no-mb">
									<strong>api secret:</strong>
									<div class="api"><code>{{ $application->api_secret }}</code></div>
								</p>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		@endforeach
	@endif
@stop