<tr>
	<td>{{ $contact_form->id }}</td>
	<td>{{ $contact_form->name }}</td>
	<td>{{ $contact_form->email }}</td>
	<td>{{ $contact_form->created_at->format('F j, Y') }}</td>
	<td>
		{{ HTML::linkAction('ContactFormController@edit', 'Edit', [$application->slug, $contact_form->id], ['class' => 'btn btn-info btn-xs']) }}
		
		{{ HTML::linkAction('ContactFormController@edit', 'Responses', [$application->slug, $contact_form->id], ['class' => 'btn btn-success btn-xs']) }}

		{{ Form::model($contact_form, ['data-remote' => true, 'data-callback' => 'removeContactForm', 'method' => 'DELETE','route' => ['application.{application}.contact-forms.destroy', $application->slug, $contact_form->id]]) }}
			{{ Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) }}
		{{ Form::close() }}
	</td>
</tr>