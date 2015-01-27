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
	<label class="col-sm-3 control-label" for="description">Description</label>
	<div class="col-sm-6">
		{{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => '3', 'id' => 'description']) }}
	</div>
</div>

<div class="form-group">
	<label class="col-sm-3 control-label" for="caption">Caption</label>
	<div class="col-sm-6">
		{{ Form::textarea('caption', null, ['class' => 'form-control', 'rows' => '3', 'id' => 'caption']) }}
	</div>
</div>

<div class="form-group">
	<label class="col-sm-3 control-label" for="news_category_id">Category</label>
	<div class="col-sm-6">
		{{ Form::select(
			'news_category_id', 
			['0' => 'Select news category'] + $news_categories, 
			isset($news)?$news->news_category_id:null, 
			['class' => 'form-control', 'id' => 'news_category_id']
		) }}	
	</div>
</div>


<div class="form-group">
	<label class="col-sm-3 control-label" for="image">Image</label>
	<div class="col-sm-6">
		{{ Form::file('image','',array('id'=>'image','class'=>'')) }}
		@if(isset($news) && $news->image)
			<div class="image-preview"><img src="{{ asset($news->getImageThumbRelativeUrl()) }}" /></div>
			<div class="image-removal">{{ Form::checkbox('remove_image', $news->id, null) }} remove image</div>
		@endif
	</div>
</div>

<div class="forge-heading">
	<h5>Push Notification</h5>
</div>

<div class="form-group">
	<label class="col-sm-3 control-label" for="send_notification">Status</label>
	<div class="col-sm-6">
		{{ Form::select(
			'push_status', 
			['idle' => 'Idle (Do nothing)', 'pending' => 'Pending (will be pushed in next sheduled queue)', 'sent' => 'Sent'], 
			isset($news)?$news->push_status:null, 
			['class' => 'form-control', 'id' => 'push_status']
		) }}	
	</div>
</div>


<div class="form-submit">
	{{ Form::submit('Save News', ['class' => 'btn btn-primary']) }}
</div>