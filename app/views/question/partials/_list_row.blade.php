<tr>
	<td>{{ $question->description }}</td>
	<td>
		{{ HTML::linkAction('QuestionsController@edit', 'Edit', [$application->slug, $question->id], ['class' => 'btn btn-info btn-xs']) }}

		{{ Form::model($question, ['data-remote' => true, 'data-callback' => 'removeQuestion', 'method' => 'DELETE','route' => ['application.{application}.questions.destroy', $application->slug, $question->id]]) }}
			{{ Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) }}
		{{ Form::close() }}
	</td>
</tr>