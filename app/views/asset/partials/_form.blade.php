<div class="forge-heading forge-first">
	<h5>General Information</h5>
</div>

{{ Form::hidden('application_id', $application->id ) }}


<div class="form-group">
	<label class="col-sm-3 control-label" for="name">Title</label>
	<div class="col-sm-6">
		{{ Form::text('name', null, [ 'class' => 'form-control', 'id' => 'name'] ) }}
	</div>
</div>

<div class="form-group">
	<label class="col-sm-3 control-label" for="caption">Caption</label>
	<div class="col-sm-6">
		{{ Form::textarea('caption', null, ['class' => 'form-control', 'rows' => '3', 'id' => 'caption']) }}
	</div>
</div>

<div class="form-group">
	<label class="col-sm-3 control-label" for="image">File</label>
	<div class="col-sm-6">
		{{ Form::file('url','',array('id'=>'url','class'=>'')) }}
	</div>
</div>

<div class="form-submit">
	{{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
</div>