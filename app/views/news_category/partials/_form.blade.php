
	{{ Form::hidden('application_id', $application->id ) }}
	{{ Form::text('name', null, [ 'class' => 'form-control', 'placeholder' => 'Enter category name'] ) }}
	<br/>
	{{ Form::submit('Save Category', ['class' => 'btn btn-primary']) }}
