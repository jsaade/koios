@extends('layouts.default')

@section('applicationMenu')
	{{ $application->renderMenu() }}
@stop

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="pull-left">{{ $application->name }}</div>
			<div class="pull-right">
				<span class="panel-heading-links">
					{{ HTML::linkAction('ApplicationController@edit', 'Edit', [$application->slug], ['class' => '']) }}
					<i class="icon-fixed-width  icon-edit"></i>
				</span>
			</div>
			<div class="clearfix"></div>
		</div> <!-- end heading -->
		<div class="panel-body">
			Dashboard here
		</div> <!-- end body -->
	</div>
@stop