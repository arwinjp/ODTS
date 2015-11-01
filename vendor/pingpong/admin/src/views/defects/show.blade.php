@extends('admin::layouts.master')

@section('content-header')	
	<h1>
		View
		&middot;
		<small>{{ link_to_route('admin.defects.index', 'Back') }}</small>
	</h1>
@stop

@section('content')
	<div>
		@include('admin::defects.view', array('model' => $defects) + compact('histories', 'no'))
	</div>

@stop