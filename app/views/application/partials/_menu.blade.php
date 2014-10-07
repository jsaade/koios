<div id="application-side-menu" class="sidr">
	
</div>

<div id="application-side-menu-content" style="display:none">
	
	<div id="menu-app-info">
		@if ($application->image)
			<a href="{{ route('application.show', $application->slug) }}">
				<img src="{{ asset($application->image) }}" />
			</a>
		@else
			<a href="{{ route('application.show', $application->slug) }}">
				<img src="{{ asset('assets/images/app_default.png') }}" />
			</a>
		@endif

		<a href="{{ route('application.show', $application->slug) }}">{{ $application->name }}</a>
	</div>

	@if ($application->hasComponent('News'))
		<ul>
			<li class="menu-app-seperator">News</li>
			<li>
				{{ HTML::linkAction('NewsController@index', 'View All', [$application->slug], []) }}
			</li>
			<li>
				{{ HTML::linkAction('NewsCategoryController@index', 'Categories', [$application->slug], []) }}
			</li>
		</ul>
	@endif

	@if ($application->hasComponent('Pages Management'))
		
	@endif

</div>