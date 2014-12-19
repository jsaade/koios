@extends('layouts.default')

@section('applicationMenu')
	{{ $application->renderMenu() }}
@stop

@section('content')
@if (!count($contact_values))
		<p class="unfortunate">You haven't recieved any contact yet :(</p>
	@else
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left">Contact Values</div>
				<div class="pull-right">
					<span class="panel-heading-links">
						{{ HTML::linkAction('ContactFormController@index', 'Forms List', [$application->slug] ) }}
						<i class="icon-fixed-width  icon-arrow-left"></i>
					</span>
				</div>
				<div class="clearfix"></div>
			</div> <!-- end heading -->
			<div class="panel-body">
					<table class="table table-striped">
					<tr>
						<th>Name</th>
						<th>Email</th>
						<th>Phone</th>
						<th>Message</th>
						<th>Date Created</th>
						<th class="actions">Action</th>
					</tr>
					@foreach($contact_values as $contact_value)
						@include('contact_forms.partials._list_contact_value_row')
					@endforeach
				</table>
			</div> <!-- end body -->
		</div>
	@endif
@stop


