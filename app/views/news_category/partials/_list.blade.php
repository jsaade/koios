@if (!count($categories))
	<p class="unfortunate">You haven't created any category yet :(</p>
@else
	<table class="listing">
		<tr>
			<th>Category</th>
			<th>Nb. news</th>
			<th>Action</th>
		</tr>
		@foreach($categories as $category)
			@include('news_category.partials._list_row')
		@endforeach
	</table>
@endif