@extends('layouts.default')

@section('applicationMenu')
	
@stop

@section('content')
	<div class="row">
		<div class="col-md-12">
			<h1>API Docs</h1>
			<div class="row">
				<div class="col-md-9 api-docs" data-spy="scroll" data-target="#api-navbar" data-offset="0">
					<div class="section" id="authorization">authorization</div>
					<div class="section" id="subscriber-create">create</div>
					<div class="section" id="subscriber-create-profile">profile</div>
					<div class="section" id="subscriber-add-device">device</div>
					<div class="section" id="subscribers-list">list</div>
					<div class="section" id="subscribers-show">show</div>
				</div>
				<div class="col-md-3 sidebar-nav">
					@include('developer.partials._sidebar_api_nav')
				</div>
			</div>
		</div>
	</div>
@stop