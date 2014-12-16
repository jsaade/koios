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
	</div>
</div>

<div class="form-group">
	<label class="col-sm-3 control-label" for="send_notification">Send Push Notification</label>
	<div class="col-sm-6">
		{{ Form::checkbox('send_notification', 1, isset($news->send_notification)? true : null, ['class' => 'field', 'id' => 'send_notification']) }}
	</div>
</div>


<div class="form-submit">
	{{ Form::submit('Save News', ['class' => 'btn btn-primary']) }}
</div>