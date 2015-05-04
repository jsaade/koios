<div class="col-sm-6 application-card">
	<div class="row">
		<div class="col-sm-3 ">
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
		<div class="col-sm-9">
			<a href="{{ route('application.show', $application->slug) }}" class="app-title">{{ $application->name }}</a>
			<p><a href="{{ route('application.show', $application->slug) }}">{{ $application->description }}</a></p>
			<span>
				api key:
				<div class="api"><code>{{ $application->api_key }}</code></div>
			</span>
			<span>
				api secret:
				<div class="api"><code>{{ $application->api_secret }}</code></div>
			</span>

			{{ Form::model($application, ['data-remote' => true, 'data-callback' => 'removeApp', 'method' => 'DELETE','route' => ['application.destroy', $application->slug]]) }}
				{{ Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) }}
			{{ Form::close() }}

		</div>
	</div>
</div>
