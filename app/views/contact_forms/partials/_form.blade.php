
{{ Form::hidden('application_id', $application->id ) }}

<div class="form-group">
	<label class="col-sm-3 control-label" for="name">Name</label>
	<div class="col-sm-6">
		{{ Form::text('name', null, [ 'class' => 'form-control', 'id' => 'name'] ) }}
	</div>
</div>

<div class="form-group">
	<label class="col-sm-3 control-label" for="email">Email</label>
	<div class="col-sm-6">
		{{ Form::text('email', null, [ 'class' => 'form-control', 'id' => 'email'] ) }}
	</div>
</div>

<div class="form-submit">
	{{ Form::submit('Save Form', ['class' => 'btn btn-primary']) }}
</div>