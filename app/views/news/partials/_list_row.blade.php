<tr>
	<td class="thumb">
		@if ($single_news->image)
			<img src="{{ asset($single_news->getImageThumbRelativeUrl()) }}" />
		@else
			<img src="{{ asset('assets/images/app_default.png') }}" width=30 />
		@endif
	</td>
	<td>{{ $single_news->name }}</td>
	<td>{{ $single_news->newsCategory->name }}</td>
	<td>
		{{ HTML::linkAction('NewsController@edit', 'Edit', [$application->slug, $single_news->id], ['class' => 'btn btn-info btn-xs']) }}
	</td>
</tr>