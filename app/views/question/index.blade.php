@extends('layouts.default')

@section('applicationMenu')
	{{ $application->renderMenu() }}
@stop


@section('content')
	<div class="row">
		<div class="col-md-12">
			<h1>
				{{ $application->name }} - Questions List
				{{ HTML::linkAction('QuestionsController@create', 'Create Question', [$application->slug], ['class' => 'btn btn-primary pull-right']) }}
			</h1>
		</div>
	</div>

	@if (!count($questions))
		<div class="row">
			<div class="col-md-12 centered">
				<p class="unfortunate">You haven't created any question yet :(</p>
				{{ HTML::linkAction('QuestionsController@create', 'Create One Now', [$application->slug], ['class' => 'btn btn-primary centered']) }}
			</div>
		</div>
	@else
		<div class="row">
			<div class="col-md-12">
				<table class="listing">
					<tr>
						<th>Thumb</th>
						<th>Question</th>
						<th>Action</th>
					</tr>
					@foreach($questions as $question)
						@include('question.partials._list_row')
					@endforeach
				</table>
			</div>
		</div>
	@endif
@stop