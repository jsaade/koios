@extends('layouts.default')

@section('applicationMenu')
	{{ $application->renderMenu() }}
@stop


@section('content')
	@if (!count($questions))
		<p class="unfortunate">You haven't created any news yet :(</p>
		{{ HTML::linkAction('QuestionsController@create', 'Create One Now', [$application->slug], ['class' => 'btn btn-primary centered']) }}
	@else
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left">Questions List</div>
				<div class="pull-right">
					<span class="panel-heading-links">
						{{ HTML::linkAction('QuestionsController@create', 'Create Question', [$application->slug], []) }}
						<i class="icon-fixed-width  icon-plus-sign"></i>
					</span>
				</div>
				<div class="clearfix"></div>
			</div> <!-- end heading -->
			<div class="panel-body">
				<table class="table table-striped">
					<tr>
						<th>Question</th>
						<th>Action</th>
					</tr>
					@foreach($questions as $question)
						@include('question.partials._list_row')
					@endforeach
				</table>
				<div class="centered">
					{{ $questions->appends(Request::except('page'))->links() }}
				</div>
			</div>
		</div>

	@endif
@stop