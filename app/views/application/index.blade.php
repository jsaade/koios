@extends('layouts.default')

@section('content')
	<h1>
		Applications List
	</h1>

	@if (!count($clients))
		<p class="unfortunate">You haven't created any application yet :(</p>
		{{ HTML::linkAction('ApplicationController@create', 'Create One Now', [], ['class' => 'btn btn-primary centered']) }}
	@else
		@foreach($clients as $client)
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="pull-left">{{ $client->name }}</div>
					<div class="pull-right">
						<span class="panel-heading-links">
							{{ HTML::linkAction('ApplicationController@create', 'Create Application', [], ['class' => '']) }}
							<i class="icon-fixed-width  icon-plus-sign"></i>
						</span>
					</div>
					<div class="clearfix"></div>
				</div> <!-- end heading -->
				<div class="panel-body">
					@foreach($client->applications as $application)
						@include('application.partials._application_card')
					@endforeach
				</div> <!-- end body -->
			</div>
		@endforeach			
	@endif
@stop