@extends('layouts.default')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<h1>
				Applications List
				{{ HTML::linkAction('ApplicationController@create', 'Create Application', [], ['class' => 'btn btn-primary pull-right']) }}
			</h1>
		</div>
	</div>

	@if (!count($clients))
		<div class="row">
			<div class="col-md-12 centered">
				<p class="unfortunate">You haven't created any application yet :(</p>
				{{ HTML::linkAction('ApplicationController@create', 'Create One Now', [], ['class' => 'btn btn-primary centered']) }}
			</div>
		</div>
	@else
		@foreach($clients as $client)
			<div class="row">
				<div class="col-md-12">
					<h3>{{ $client->name }}</h3>
				</div>
				@foreach($client->applications as $application)
					@include('application.partials._application_card')
				@endforeach
			</div>
		@endforeach
	@endif
@stop