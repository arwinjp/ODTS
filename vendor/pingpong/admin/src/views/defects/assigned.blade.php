@extends('admin::layouts.master')

@section('content-header')
	<h1>
		{{{ $title or 'All Defects' }}} ({{ $no }})
		&middot;
		<small>{{ link_to_route('admin.defects.create', 'Add New Defect') }}</small>
	</h1>
@stop

@section('content')

	@if(isset($search))
		@include('admin::users.search-form')
	@endif	
	<table class="table">
		<thead>
			<th>No</th>
			<th>Summary</th>
			<th>Logged By</th>
			<th>Severity</th>
			<th>Priority</th>
			<th>Status</th>
			<th class="text-center">Action</th>
		</thead>
		<tbody>
			<?php $no = 1 ?>
			@foreach ($defects as $defect)
			<tr>
				<td>{{ $no }}</td>
				<td>{{ $defect->DefectSummary}}</td>
				<td>{{ $defect->UserName }}</td>
				<td>{{ $defect->SeverityName }}</td>
				<td>{{ $defect->PriorityName }}</td>
				<td>{{ $defect->StatusName }}</td>
				<td class="text-center">
					<a href="{{ route('admin.defects.show', $defect->DefectID) }}">View</a>
					&middot;	
					<a href="{{ route('admin.defects.edit', $defect->DefectID) }}">Update</a>
				</td>
			</tr>
			<?php $no++ ;?>
			@endforeach
		</tbody>
	</table>

	<div class="text-center">
		{{ pagination_links($defects) }}
	</div>
@stop