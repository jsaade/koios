@include('common.form_error_messages', array('errors' => $errors))
	{{ Form::model($application, ['method' => 'POST','route' => ['application.certificates', $application->slug], 'files' => true, 'class' => 'form-horizontal']) }}
	
	<div class="forge-heading forge-first">
		<h5>Apple IOS</h5>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label" for="ios_certificate">Upload Certificate</label>
		<div class="col-sm-6">
			{{ Form::file('ios_certificate','',array('id'=>'ios_certificate','class'=>'')) }}
			@if($application->ios_certificate)
				<div style="color:green;font-size:12px;padding-top:5px">
					<i class="icon-fixed-width  icon-ok"></i> Certificate uploaded ({{ $application->ios_certificate }})
				</div>
			@endif
		</div>
	</div>


	<div class="form-group">
		<label class="col-sm-3 control-label" for="ios_password">Password</label>
		<div class="col-sm-6">
			{{ Form::text('ios_password', null, [ 'class' => 'form-control', 'id' => 'ios_password'] ) }}
		</div>
	</div>


	<div class="forge-heading">
		<h5>Android</h5>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label" for="android_api_key">API Key</label>
		<div class="col-sm-6">
			{{ Form::text('android_api_key', null, [ 'class' => 'form-control', 'id' => 'android_api_key'] ) }}
		</div>
	</div>

	<div class="form-submit">
		{{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
	</div>

{{ Form::close() }}