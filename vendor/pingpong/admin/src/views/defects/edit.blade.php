@extends('admin::layouts.master')

@section('content-header')	
	<h1>
		Update (Current status: {{ $currentstatus->name }})
		&middot;
		<small>{{ link_to_route('admin.defects.index', 'Back') }}</small>
	</h1>
@stop

@section('content')
	<div>
		@include('admin::defects.form', array('model' => $defect) + compact('severities', 'priorities', 'statuses', 'versions', 'users', 'projects', 'fields', 'disablebutton'))
	</div>

@stop