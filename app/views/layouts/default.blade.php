<!doctype html>
<html>
<head>
	<title>Koios</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href='https://fonts.googleapis.com/css?family=Lato:300,400,700,700italic' rel='stylesheet' type='text/css'>
	
	{{ HTML::style('assets/css/bootstrap.css') }}
	{{ HTML::style('assets/css/font-awesome.min.css') }}
	{{ HTML::style('assets/css/jquery.jsonview.css') }}
	{{ HTML::style('assets/css/nestable.css') }}
	{{ HTML::style('assets/css/custom.css') }}
</head>
<body>

	<img src="{{ asset('assets/images/background.jpg') }}" id="bg" /> 

	<!--Naviagtion -->
	<nav class="navbar navbar-default" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="/">
					<img src="{{ asset('assets/images/logo.png') }}" />
				</a>
			</div>
			<div class="collapse navbar-collapse" id="navbar-collapse">
				@if ( isset($showAppMenu) && $showAppMenu)
					@yield('applicationMenu')
				@endif
				@include('layouts.partials._nav')
			</div>
		</div>
	</nav>


	<div class="container-fluid main">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				@yield('content')
			</div>
		</div>
	</div>

	@include('layouts.partials._footer')

	{{ HTML::script('assets/js/jquery-2.1.1.min.js') }}
	{{ HTML::script('assets/js/bootstrap.min.js') }}
	{{ HTML::script('assets/js/placeholders.min.js') }}
	{{ HTML::script('assets/js/jquery.jsonview.js') }}
	{{ HTML::script('assets/js/jquery.nestable.js') }}
	{{ HTML::script('assets/js/main.js') }}

	<!-- syntax highlighter for api docs -->
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.3/styles/default.min.css">
	{{ HTML::style('assets/css/railcasts.css')}}
	<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.3/highlight.min.js"></script>
	<script>hljs.initHighlightingOnLoad();</script>

</body>
</html>