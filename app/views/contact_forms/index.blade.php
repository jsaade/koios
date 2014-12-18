@extends('layouts.default')

@section('applicationMenu')
	{{ $application->renderMenu() }}
@stop

@section('content')
@if (!count($contact_forms))
		<p class="unfortunate">You haven't created any contact form yet :(</p>
		{{ HTML::linkAction('ContactFormController@create', 'Create Contact Form', [$application->slug], ['class' => 'btn btn-primary pull-right']) }}
	@else
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left">Contact Forms List</div>
				<div class="pull-right">
					<span class="panel-heading-links">
						{{ HTML::linkAction('ContactFormController@create', 'Create Forms', [$application->slug] ) }}
						<i class="icon-fixed-width  icon-plus-sign"></i>
					</span>
				</div>
				<div class="clearfix"></div>
			</div> <!-- end heading -->
			<div class="panel-body">
					<table class="table table-striped">
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Email</th>
						<th>Date Created</th>
						<th class="actions">Action</th>
					</tr>
					@foreach($contact_forms as $contact_form)
						@include('contact_forms.partials._list_row')
					@endforeach
				</table>
			</div> <!-- end body -->
		</div>
	@endif
@stop


