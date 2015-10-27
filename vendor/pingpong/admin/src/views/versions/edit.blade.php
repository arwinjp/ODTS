@extends('admin::layouts.master')

@section('content-header')	
	<h1>
		Edit
		&middot;
		<small>{{ link_to_route('admin.projects.show', 'Back', $versions[0]->project_id) }}</small>
	</h1>
@stop

@section('content')
	<div>
		@include('admin::versions.form', array('model' => $versions))
	</div>

@stop