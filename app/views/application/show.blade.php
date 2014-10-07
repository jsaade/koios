@extends('layouts.default')

@section('applicationMenu')
	{{ $application->renderMenu() }}
@stop

@section('content')
	<div class="row">
		<div class="col-md-12">
			<h1>
				Application "{{ $application->name }}"
			</h1>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			@include('application.partials._application_card')
			<p class="unfortunate">App Dashboard Here :)</p>
		</div>
	</div>
@stop