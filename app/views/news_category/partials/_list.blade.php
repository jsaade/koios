@if (!count($categories))
	<p class="unfortunate">You haven't created any category yet :(</p>
@else

	 <div class="dd" id="nestable">
        <ul class="dd-list">
			@foreach($categories as $category)
				{{ $category->renderNode($category) }}
			@endforeach
		</ul>
	</div>
@endif