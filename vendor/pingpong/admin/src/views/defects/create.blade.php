@extends('admin::layouts.master')

@section('content-header')
	
	
	<h1>
		Add New Defect
		&middot;
		<small>{{ link_to_route('admin.defects.index', 'Back') }}</small>
	</h1>

@stop

@section('content')
	<div>
		@include('admin::defects.form')
	</div>

@stop