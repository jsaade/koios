@extends('layouts.default')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<h1>Create an application</h1>
		</div>
	</div>

	<div class="row">
		<div class="col-md-4">
			
			 @include('common.form_error_messages', array('errors' => $errors))

			<?php // form fields name should be the same as the db fields for automatic laravel binding ?>
			{{ Form::open(array('route' => 'application.store', 'files' => true)) }}
				<ul class="form-handler">
					<p class="form-title no-mt">General Information</p>
					<li>
						{{ Form::text('name', null, [ 'class' => 'form-control', 'placeholder' => 'Enter application name'] ) }}
					</li>

					<li>
						{{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Enter application description']) }}
					</li>

					<li>
						{{ Form::select('client',  array('0' => 'Select application client') + $clients, null, ['class' => 'form-control']) }}
					</li>

					<p class="form-title">Upload application avatar (128x128):</p>
					<li>
						{{ Form::file('image','',array('id'=>'','class'=>'')) }}
					</li>

					<p class="form-title">Choose custom components to be associated with the application:</p>
					@foreach($components as $component)
					<li>
						{{ Form::checkbox('component[]', $component->id, false) }} 
						<strong>{{$component->name}}</strong><br/>
						<span class="field-desc">{{ $component->description }}</span>
					</li>
					@endforeach

					<li>
						<br/>{{ Form::submit('Create Application', ['class' => 'btn btn-primary']) }}
					</li>
				</ul>
			{{ Form::close() }}
		</div>
	</div>
@stop