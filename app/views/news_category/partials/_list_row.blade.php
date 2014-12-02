
{{ $data['name'] }} 
<a href='{{ $data["url"] }}' data-toggle='tooltip' title='{{ $data["title"] }}' class='pull-right'>
	<span class='badge badge-info'>{{ $data["count"] }}</span>
</a>

{{ Form::model($data['category'], ['data-remote' => true, 'data-callback' => 'removeNewsCategory', 'method' => 'DELETE','route' => ['application.{application}.news-categories.destroy', $application->slug, $data['id']]]) }}
		{{ Form::submit('Delete', ['class' => 'btn btn-danger btn-xs pull-right']) }}
{{ Form::close() }}

{{ HTML::linkAction('NewsCategoryController@edit', 'Edit', [$application->slug, $data['id']], ['class' => 'btn pull-right btn-info btn-xs']) }}
