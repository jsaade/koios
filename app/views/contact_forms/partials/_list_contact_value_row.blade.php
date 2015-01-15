<tr>
	<td>{{ $contact_value->name }}</td>
	<td>{{ $contact_value->email }}</td>
	<td>{{ $contact_value->phone }}</td>
	<td>{{ $contact_value->message }}</td>
	<td>{{ $contact_value->ip }}</td>
	<td>{{ $contact_value->created_at->format('F j, Y') }}</td>
	<td>
		@foreach ($contact_value->contactAttachments as $key => $contact_attachment)
		    <a href="/{{ $contact_attachment->url}}" target="_blank">attachment-{{$key+1}}</a><br/>
		@endforeach
	</td>
</tr>