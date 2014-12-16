@if($currentUser)
	<ul class="nav navbar-nav navbar-right">
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				{{ $currentUser->first_name }} {{ $currentUser->last_name }} <b class="caret"></b>
				<ul class="dropdown-menu">
					<li><a href="/logout"><i class="icon-signout"></i>Logout</a></li>
				</ul>
			</a>
		</li>
	</ul>
@endif