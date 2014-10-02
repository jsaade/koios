@extends('layouts.default')

@section('content')

	<h1>Login</h1>

	<div class="row">
		<div class="col-md-4">
			
			 @include('common.form_error_messages', array('errors' => $errors))

			{{ Form::open( array('route' => 'sessions.store') ) }}
				
				<ul class="form-handler">
					<p class="form-title no-mt">Enter your credentials below</p>
					<li>
						{{Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Enter your username.' ])}}
					</li>

					<li>
						{{Form::password('password', ['class' => 'form-control', 'placeholder' => 'Enter your password.'])}}
					</li>

					<li>
						{{ Form::submit('Login', ['class' => 'btn btn-primary']) }}
					</li>
				</ul>
			{{ Form::close() }}
		</div>
	</div>
@stop