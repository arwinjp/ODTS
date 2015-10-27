@extends('admin::layouts.master')

@section('content-header')
	
	
	<h1>
		Add New Release to '{{ $project[0]->name }}'
		&middot;
		<small>{{ link_to_route('admin.projects.show', 'Back', $project[0]->id) }}</small>
	</h1>

@stop

@section('content')
	<div>
		@include('admin::versions.form', compact('project'))
	</div>

@stop