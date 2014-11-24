@extends('layouts.default')

@section('applicationMenu')
	{{ $application->renderMenu() }}
@stop


@section('content')
	<div class="row">
		<div class="col-md-12">
			<h1>
				{{ $application->name }} - Contact Forms List
				{{ HTML::linkAction('ContactFormController@create', 'Create Contact Form', [$application->slug], ['class' => 'btn btn-primary pull-right']) }}
			</h1>
		</div>
	</div>

	@if (!count($contact_forms))
		<div class="row">
			<div class="col-md-12 centered">
				<p class="unfortunate">You haven't created any contact form yet :(</p>
				{{ HTML::linkAction('ContactFormController@create', 'Create One Now', [$application->slug], ['class' => 'btn btn-primary centered']) }}
			</div>
		</div>
	@else
		<div class="row">
			<div class="col-md-12">
				<table class="listing">
					<tr>
						<th>Name</th>
						<th>Email</th>
						<th>Date Created</th>
						<th>Action</th>
					</tr>
					@foreach($contact_forms as $contact_form)
						@include('contact_forms.partials._list_row')
					@endforeach
				</table>
			</div>
		</div>
	@endif
@stop