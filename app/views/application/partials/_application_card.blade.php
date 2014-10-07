<div class="{{ (isset($fullcard))?'col-md-12':'col-md-6' }}">
	<div class="app-card">
		{{ HTML::linkAction('ApplicationController@edit', '', [$application->slug], ['class' => 'app-card-edit pull-right']) }}
		<div class="app-card-image {{ (isset($fullcard))?'col-md-2':'col-md-3' }}">
			@if ($application->image)
				<a href="{{ route('application.show', $application->slug) }}">
					<img src="{{ asset($application->image) }}" />
				</a>
			@else
				<a href="{{ route('application.show', $application->slug) }}">
					<img src="{{ asset('assets/images/app_default.png') }}" />
				</a>
			@endif
		</div>
		<div class="app-card-info {{ (isset($fullcard))?'col-md-10':'col-md-9' }}">
			<h5 class="app-title">
				<a href="{{ route('application.show', $application->slug) }}">
					{{ $application->name }}
				</a>
			</h5>
			<p><a href="{{ route('application.show', $application->slug) }}">{{ $application->description }}</a></p>
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