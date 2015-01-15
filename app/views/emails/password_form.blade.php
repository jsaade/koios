<h2>{{ $subscriber->application->name }}</h2>
<p>Update your password:</p>

{{ Form::open( ['route' => ['store.password']]) }}
	{{ Form::hidden('code', $subscriber->verification_token ) }}
	{{ Form::text('password', null, [ 'class' => 'form-control', 'id' => 'password'] ) }}
	{{ Form::submit() }}
{{ Form::close() }}