<ul class="form-handler">
	{{ Form::hidden('application_id', $application->id ) }}

	<p class="form-title no-mt">Question details</p>
	<li>
		{{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Enter question...']) }}
	</li>

	<p class="form-title">Choose Image:</p>
	<li>
		{{ Form::file('image','',array('id'=>'','class'=>'')) }}
	</li>

	<p class="form-title">Add answers:</p>

	<li>
		<table class="listing no-mt">
			<tr>
				<th>Is correct</th>
				<th>Answer</th>
			</tr>
			@include('question.partials._answers')
		</table>
	</li>

	<li>
		<br/>{{ Form::submit('Save Question', ['class' => 'btn btn-primary']) }}
	</li>
</ul>