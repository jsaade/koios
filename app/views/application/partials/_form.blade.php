<ul class="form-handler">
	<p class="form-title no-mt">General Information</p>
	<li>
		{{ Form::text('name', null, [ 'class' => 'form-control', 'placeholder' => 'Enter application name'] ) }}
	</li>

	<li>
		{{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Enter application description']) }}
	</li>

	<li>
		{{ Form::select(
			'client', 
			['0' => 'Select application client'] + $clients, 
			isset($application)?$application->client_id:null, 
			['class' => 'form-control']
		) }}
	</li>

	<p class="form-title">Upload application avatar (128x128):</p>
	<li>
		{{ Form::file('image','',array('id'=>'','class'=>'')) }}
	</li>

	<p class="form-title">Choose custom components to be associated with the application:</p>
	@foreach($components as $component)
	<li>
		{{ Form::checkbox(
			'component[]', 
			$component->id, 
			isset($application_components)? in_array($component->id, $application_components) : null) 
		}} 
		<strong>{{$component->name}}</strong><br/>
		<span class="field-desc">{{ $component->description }}</span>
	</li>
	@endforeach
	
	<p class="form-title">Default integrated components:</p>
	<li>
		<strong style="margin-left:13px">Subscribers Authentication</strong><br/>
		<span class="field-desc">Register subscribers (via facebook and signup form), add profile and devices</span>
	<li>
	<li>
		<strong style="margin-left:13px">Gaming Features</strong><br/>
		<span class="field-desc">Manage subscribers score, level, metas and leaderboards.</span>
	</li>

	<li>
		<br/>{{ Form::submit('Save Application', ['class' => 'btn btn-primary']) }}
	</li>
</ul>