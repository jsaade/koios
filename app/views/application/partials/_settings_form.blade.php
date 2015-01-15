@include('common.form_error_messages', array('errors' => $errors))
	{{ Form::model($application, ['method' => 'POST','route' => ['application.settings', $application->slug], 'class' => 'form-horizontal']) }}
	
	<div class="forge-heading forge-first">
		<h5>Emails</h5>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label" for="email_from">Title (From)</label>
		<div class="col-sm-6">
			{{ Form::text('email_from', null, [ 'class' => 'form-control', 'id' => 'email_from'] ) }}
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label" for="email_value">Email</label>
		<div class="col-sm-6">
			{{ Form::text('email_value', null, [ 'class' => 'form-control', 'id' => 'email_value'] ) }}
		</div>
	</div>

	<div class="form-submit">
		{{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
	</div>
{{ Form::close() }}