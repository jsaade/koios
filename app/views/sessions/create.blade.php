@extends('layouts.default')

@section('content')

	<h1>Login</h1>

	<div class="row">
		<div class="col-sm-4">
			
			 @include('common.form_error_messages', array('errors' => $errors))

			{{ Form::open( array('route' => 'sessions.store') ) }}
				<p class="form-title no-mt">Enter your credentials below</p>
				{{Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Enter your username.' ])}}
				<br/>
				{{Form::password('password', ['class' => 'form-control', 'placeholder' => 'Enter your password.'])}}
				<br/>
				{{ Form::submit('Login', ['class' => 'btn btn-primary']) }}
			{{ Form::close() }}
		</div>
	</div>
@stop