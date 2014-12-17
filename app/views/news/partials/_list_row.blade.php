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
		@if($single_news->push_status == "pending")
			<i class="icon-fixed-width  icon-time"></i> 
		@elseif($single_news->push_status == "idle")
			<i class="icon-fixed-width  icon-moon"></i>
		@elseif($single_news->push_status == "sent")
			<i class="icon-fixed-width  icon-mail-forward"></i>
		@endif 
		{{ $single_news->push_status }}
	</td>
	<td>
		{{ HTML::linkAction('NewsController@edit', 'Edit', [$application->slug, $single_news->id], ['class' => 'btn btn-info btn-xs']) }}

		{{ Form::model($single_news, ['data-remote' => true, 'data-callback' => 'removeNews', 'method' => 'DELETE','route' => ['application.{application}.news.destroy', $application->slug, $single_news->id]]) }}
			{{ Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) }}
		{{ Form::close() }}
	</td>
</tr>