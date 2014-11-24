<tr>
	<td class="thumb">
		@if ($single_news->image)
			<img src="{{ asset($single_news->getImageThumbRelativeUrl()) }}" />
		@else
			<img src="{{ asset('assets/images/app_default.png') }}" width=30 />
		@endif
	</td>
	<td>{{ $single_news->name }}</td>
	<td>{{ $single_news->created_at->format('F j, Y') }}</td>
	<td>{{ $single_news->newsCategory->name }}</td>
	<td>
		{{ HTML::linkAction('NewsController@edit', 'Edit', [$application->slug, $single_news->id], ['class' => 'btn btn-info btn-xs']) }}

		{{ Form::model($single_news, ['data-remote' => true, 'data-callback' => 'removeNews', 'method' => 'DELETE','route' => ['application.{application}.news.destroy', $application->slug, $single_news->id]]) }}
			{{ Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) }}
		{{ Form::close() }}
	</td>
</tr>