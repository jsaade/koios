
<ul class="nav navbar-nav application-menu">
	<li class="application-name">
		@if ($application->image)
			<a href="{{ route('application.show', $application->slug) }}">
				<img src="{{ asset($application->image) }}" /> {{ $application->name }}
			</a>
		@else
			<a href="{{ route('application.show', $application->slug) }}">
				<img src="{{ asset('assets/images/app_default.png') }}" /> {{ $application->name }}
			</a>
		@endif
	<li>

	<!-- News -->
	@if ($application->hasComponent('News'))
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			 	<i class="icon-bullhorn"></i> News <b class="caret"></b>
			</a>
		  	<ul class="dropdown-menu">
			    <li>
			    	<a href="{{ route('application.{application}.news.index', $application->slug) }}">
			    		<i class="icon-fixed-width  icon-copy"></i> View All
			    	</a>
			    </li>
			    <li>
			    	<a href="{{ route('application.{application}.news.create', $application->slug) }}">
			    		<i class="icon-fixed-width icon-save"></i> Create News
			    	</a>
			    </li>
			    <li class="divider"></li>
			    <li>
			    	<a href="{{ route('application.{application}.news-categories.index', $application->slug) }}">
			    		<i class="i"></i> Manage Categories
			    	</a>
			    </li>
			</ul>
	</li>
	@endif

	<!-- Quiz -->
	@if ($application->hasComponent('Quiz'))
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			 	<i class="icon-beaker"></i> Quiz <b class="caret"></b>
			</a>
		  	<ul class="dropdown-menu">
			    <li>
			    	<a href="{{ route('application.{application}.questions.index', $application->slug) }}">
			    		<i class="icon-fixed-width  icon-copy"></i> View All
			    	</a>
			    </li>
			    <li>
			    	<a href="{{ route('application.{application}.questions.create', $application->slug) }}">
			    		<i class="icon-fixed-width icon-save"></i> Create Question
			    	</a>
			    </li>
			</ul>
	</li>
	@endif


	<!-- Contact Forms -->
	@if ($application->hasComponent('Contact Forms'))
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			 	<i class="icon-envelope-alt"></i> Contact Forms <b class="caret"></b>
			</a>
		  	<ul class="dropdown-menu">
			    <li>
			    	<a href="{{ route('application.{application}.contact-forms.index', $application->slug) }}">
			    		<i class="icon-fixed-width  icon-copy"></i> View All
			    	</a>
			    </li>
			    <li>
			    	<a href="{{ route('application.{application}.contact-forms.create', $application->slug) }}">
			    		<i class="icon-fixed-width icon-save"></i> Create Contact Form
			    	</a>
			    </li>
			</ul>
	</li>
	@endif

</ul>