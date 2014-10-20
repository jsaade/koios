<!doctype html>
<html>
<head>
	<title>Koios</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600' rel='stylesheet' type='text/css'>

	{{ HTML::style('assets/css/bootstrap.min.css') }}
	{{ HTML::style('assets/css/jquery.sidr.dark.css') }}
	{{ HTML::style('assets/css/jquery.jsonview.css') }}
	{{ HTML::style('assets/css/layout.css') }}
</head>
<body>

	<div class="container-fluid top-bar">
	  	<div class="row">
	  		@if ( isset($showAppMenu) && $showAppMenu)
	    		<a id="application-menu-btn" href="#sidr"></a>
	    	@endif

	    	@include('layouts.partials._nav')
	  	</div>
	</div>

	@if ( isset($showAppMenu) && $showAppMenu)
		@yield('applicationMenu')
	@endif

	<div class="container main">
		@yield('content')
	</div>

	@include('layouts.partials._footer')

	{{ HTML::script('assets/js/jquery-2.1.1.min.js') }}
	{{ HTML::script('assets/js/bootstrap.min.js') }}
	{{ HTML::script('assets/js/placeholders.min.js') }}
	{{ HTML::script('assets/js/jquery.sidr.js') }}
	{{ HTML::script('assets/js/jquery.jsonview.js') }}
	{{ HTML::script('assets/js/main.js') }}

	<!-- syntax highlighter for api docs -->
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.3/styles/default.min.css">
	{{ HTML::style('assets/css/railcasts.css')}}
	<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.3/highlight.min.js"></script>
	<script>hljs.initHighlightingOnLoad();</script>

</body>
</html>