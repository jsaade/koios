<!doctype html>
<html>
<head>
	<title>Koios</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,300' rel='stylesheet' type='text/css'>



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

	<div class="container">
		<div class="row">
			<!-- <div class="col-md-12" id="footer">
				
			</div> -->
		</div>
	</div>

	{{ HTML::script('assets/js/jquery-2.1.1.min.js') }}
	{{ HTML::script('assets/js/bootstrap.min.js') }}
	{{ HTML::script('assets/js/placeholders.min.js') }}
	{{ HTML::script('assets/js/main.js') }}
</body>
</html>