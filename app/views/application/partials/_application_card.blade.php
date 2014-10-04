<div class="col-md-6">
	<div class="app-card">
		{{ HTML::linkAction('ApplicationController@edit', '', [$application->slug], ['class' => 'app-card-edit pull-right']) }}
		<div class="app-card-image col-md-3">
			@if ($application->image)
				<img src="{{ asset($application->image) }}" />
			@else
				<img src="{{ asset('assets/images/app_default.png') }}" />
			@endif
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