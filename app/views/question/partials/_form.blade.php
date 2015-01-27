<div class="forge-heading forge-first">
	<h5>General Information</h5>
</div>

{{ Form::hidden('application_id', $application->id ) }}

<div class="form-group">
	<label class="col-sm-3 control-label" for="description">Question</label>
	<div class="col-sm-6">
		{{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => '3', 'id' => 'description']) }}
	</div>
</div>


<div class="form-group">
	<label class="col-sm-3 control-label" for="image">Image</label>
	<div class="col-sm-6">
		{{ Form::file('image','',array('id'=>'image','class'=>'')) }}
		@if(isset($question) && $question->image)
			<div class="image-preview"><img src="{{ asset($question->getImageThumbRelativeUrl()) }}" /></div>
			<div class="image-removal">{{ Form::checkbox('remove_image', $question->id, null) }} remove image</div>
		@endif
	</div>
</div>

<div class="form-group">
	<label class="col-sm-3 control-label">Answers</label>
	<div class="col-sm-6">
		<table>
			@include('question.partials._answers')
		</table>
	</div>
</div>


<div class="form-submit">
	<br/>{{ Form::submit('Save Question', ['class' => 'btn btn-primary']) }}
</div>