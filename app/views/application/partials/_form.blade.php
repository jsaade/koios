<div class="forge-heading">
	<h5>General Information</h5>
</div>

<div class="form-group">
	<label class="col-sm-3 control-label" for="name">Name</label>
	<div class="col-sm-6">
		{{ Form::text('name', null, [ 'class' => 'form-control', 'id' => 'name'] ) }}
	</div>
</div>

<div class="form-group">
	<label class="col-sm-3 control-label" for="description">Description</label>
	<div class="col-sm-6">
		{{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => '3', 'id' => 'description']) }}	
	</div>
</div>

<div class="form-group">
	<label class="col-sm-3 control-label" for="client">Client</label>
	<div class="col-sm-6">
		{{ Form::select(
			'client', 
			['0' => 'Select application client'] + $clients, 
			isset($application)?$application->client_id:null, 
			['class' => 'form-control', 'id' => 'client']
		) }}	
	</div>
</div>

<div class="form-group">
	<label class="col-sm-3 control-label" for="image">Avatar</label>
	<div class="col-sm-6">
		{{ Form::file('image','',array('id'=>'image','class'=>'')) }}
	</div>
</div>


<div class="forge-heading">
	<h5>Components & Services</h5>
</div>

<div class="form-group">
	<label class="col-sm-3 control-label">Custom Components:</label>
	<div class="col-sm-6">
		@foreach($components as $component)
			<div class="form-checkbox-group">
				{{ Form::checkbox(
					'component[]', 
					$component->id, 
					isset($application_components)? in_array($component->id, $application_components) : null) 
				}} 
				<strong>{{$component->name}}</strong><br/>
				<span class="field-desc">{{ $component->description }}</span>
			</div>
		
		@endforeach
	</div>
</div>

<div class="form-group">
	<label class="col-sm-3 control-label">Integrated Services:</label>
	<div class="col-sm-6">
		<div class="form-checkbox-group">
			<strong>Subscribers Authentication</strong><br/>
			<span class="field-desc">Register subscribers (via facebook and signup form), add profile and devices</span>
		</div>
		<div class="form-checkbox-group">
			<strong>Gaming Features</strong><br/>
			<span class="field-desc">Manage subscribers score, level, metas and leaderboards.</span>
		</div>
	</div>
</div>

<div class="form-submit">
	{{ Form::submit('Save Application', ['class' => 'btn btn-primary']) }}
</div>