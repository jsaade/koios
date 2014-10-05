<ul class="form-handler">
	<p class="form-title no-mt">General Information</p>
	{{ Form::hidden('application_id', $application->id ) }}
	<li>
		{{ Form::text('name', null, [ 'class' => 'form-control', 'placeholder' => 'Enter news title'] ) }}
	</li>

	<li>
		{{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Enter news description']) }}
	</li>

	<li>
		{{ Form::textarea('caption', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Enter news small caption']) }}
	</li>

	<li>
		{{ Form::select(
			'news_category_id', 
			['0' => 'Select news category'] + $news_categories, 
			isset($news)?$news->news_category_id:null, 
			['class' => 'form-control']
		) }}
	</li>

	<p class="form-title">Upload news image:</p>
	<li>
		{{ Form::file('image','',array('id'=>'','class'=>'')) }}
	</li>

	<li>
		<br/>{{ Form::submit('Save News', ['class' => 'btn btn-primary']) }}
	</li>
</ul>