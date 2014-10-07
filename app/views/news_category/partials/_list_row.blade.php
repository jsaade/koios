<tr>
	<td>{{ $category->name }}</td>
	<td>{{ $category->news->count() }}</td>
	<td>
		{{ HTML::linkAction('NewsCategoryController@edit', 'Edit', [$application->slug, $category->id], ['class' => 'btn btn-info btn-xs']) }}

		{{ Form::model($category, ['data-remote' => true, 'data-callback' => 'removeNewsCategory', 'method' => 'DELETE','route' => ['application.{application}.news-categories.destroy', $application->slug, $category->id]]) }}
			{{ Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) }}
		{{ Form::close() }}
	</td>
</tr>