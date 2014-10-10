<div class="container header-bar">
	<div class="col-md-12">
		<div class="col-md-3">
			<a href='/' class="home"></a>
		</div>
		<div class="col-md-3 credentials pull-right">
			@if($currentUser)
				{{ $currentUser->first_name }} {{ $currentUser->last_name }} 
				<a href="/logout">logout</a>
			@endif
		</div>
	</div>
</div>