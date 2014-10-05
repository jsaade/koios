<ul class="form-handler">
	{{ Form::hidden('application_id', $application->id ) }}
	<li>
		{{ Form::text('name', null, [ 'class' => 'form-control', 'placeholder' => 'Enter category name'] ) }}
	</li>
	<li>
		{{ Form::submit('Add Category', ['class' => 'btn btn-primary']) }}
	</li>
</ul>