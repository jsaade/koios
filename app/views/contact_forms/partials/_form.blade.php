<ul class="form-handler">
	<p class="form-title no-mt">General Information</p>
	{{ Form::hidden('application_id', $application->id ) }}
	<li>
		{{ Form::text('name', null, [ 'class' => 'form-control', 'placeholder' => 'Enter form name'] ) }}
	</li>

		<li>
		{{ Form::text('email', null, [ 'class' => 'form-control', 'placeholder' => 'Enter contact email'] ) }}
	</li>

	<li>
		<br/>{{ Form::submit('Save Form', ['class' => 'btn btn-primary']) }}
	</li>
</ul>