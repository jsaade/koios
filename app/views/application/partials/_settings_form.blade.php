@include('common.form_error_messages', array('errors' => $errors))
	{{ Form::model($application, ['method' => 'POST','route' => ['application.settings', $application->slug], 'class' => 'form-horizontal']) }}
	
	<div class="forge-heading forge-first">
		<h5>Emails</h5>
	</div>
	<p>Update the mail subject and address of the emails sent by the application.</p>
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

	<div class="forge-heading forge-first">
		<h5>Pagination</h5>
	</div>
	<p>Set the default number of items per page in all the paginated listing in the modules.</p>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="pagination_per_page">Nb. Items (Per Page)</label>
		<div class="col-sm-6">
			{{ Form::text('pagination_per_page', null, [ 'class' => 'form-control', 'id' => 'pagination_per_page'] ) }}
		</div>
	</div>

	<div class="forge-heading forge-first">
		<h5>Thumbnails</h5>
	</div>
	<p>Set the thumbnail size foreach module that supports a featured image. Resize will run first, and then the cropping. (supports null value to keep aspect ratio)</p>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="pagination_per_page">News image</label>
		<div class="col-sm-6">
			{{ Form::text('news_resize_width', null, [ 'class' => 'form-control thumb-input', 'id' => 'news_resize_width', 'placeholder' => 'resize width px'] ) }}
			{{ Form::text('news_resize_height', null, [ 'class' => 'form-control thumb-input', 'id' => 'news_resize_height', 'placeholder' => 'resize height px'] ) }}
			{{ Form::text('news_crop_width', null, [ 'class' => 'form-control thumb-input', 'id' => 'news_crop_width', 'placeholder' => 'crop width px'] ) }}
			{{ Form::text('news_crop_height', null, [ 'class' => 'form-control thumb-input', 'id' => 'news_crop_height', 'placeholder' => 'crop height px'] ) }}
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label" for="pagination_per_page">Question image</label>
		<div class="col-sm-6">
			{{ Form::text('question_resize_width', null, [ 'class' => 'form-control thumb-input', 'id' => 'questions_resize_width', 'placeholder' => 'resize width px'] ) }}
			{{ Form::text('question_resize_height', null, [ 'class' => 'form-control thumb-input', 'id' => 'question_resize_height', 'placeholder' => 'resize height px'] ) }}
			{{ Form::text('question_crop_width', null, [ 'class' => 'form-control thumb-input', 'id' => 'question_crop_width', 'placeholder' => 'crop width px'] ) }}
			{{ Form::text('question_crop_height', null, [ 'class' => 'form-control thumb-input', 'id' => 'question_crop_height', 'placeholder' => 'crop height px'] ) }}
		</div>
	</div>


	<div class="form-submit">
		{{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
	</div>
{{ Form::close() }}