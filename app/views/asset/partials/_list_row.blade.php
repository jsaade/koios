<tr>
	<td>{{ $single_asset->name }}</td>
	<td>{{ $single_asset->created_at->format('F j, Y') }}</td>
	<td>{{ $single_asset->type }}</td>
	<td>{{ $single_asset->caption }}</td>
	<td>
		<a href="{{ $single_asset->getAssetFullUrl() }}" target="_blank"> {{ $single_asset->getAssetFullUrl() }}</a>
	</td>
	<td>
		{{ Form::model($single_asset, ['data-remote' => true, 'data-callback' => 'removeAsset', 'method' => 'DELETE','route' => ['application.{application}.assets.destroy', $application->slug, $single_asset->id]]) }}
			{{ Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) }}
		{{ Form::close() }}
	</td>
</tr>