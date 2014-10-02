<!doctype html>
<html>
<head>
	<title>Koios</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">



	{{ HTML::style('assets/css/bootstrap.min.css') }}
	{{ HTML::style('assets/css/layout.css') }}
</head>
<body>

	<div class="container-fluid top-bar">
	  	<div class="row">
	    	
	  	</div>
	</div>

	
	<div class="container main">
		@yield('content')
	</div>

	{{ HTML::script('assets/js/jquery-2.1.1.min.js') }}
	{{ HTML::script('assets/js/bootstrap.min.js') }}
	{{ HTML::script('assets/js/placeholders.min.js') }}
</body>
</html>