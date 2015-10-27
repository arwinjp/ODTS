@extends('admin::layouts.master')

@section('content-header')	
	<h1>
		Edit
		&middot;
		<small>{{ link_to_route('admin.projects.index', 'Back') }}</small>
	</h1>
@stop

@section('content')
	<div>
		@include('admin::projects.form', array('model' => $projects) + compact('owners'))
	</div>

@stop