@extends('admin::layouts.master')

@section('content-header')
	<h1>
		{{{ $title or 'My Defects' }}} ({{ $no }})
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
			<th>Project</th>
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
				<td>{{ $defect->ProjectName }}</td>
				<td>{{ $defect->SeverityName }}</td>
				<td>{{ $defect->PriorityName }}</td>
				<td>{{ $defect->StatusName }}</td>
				<td class="text-center">
					<a href="{{ route('admin.defects.show', $defect->DefectID) }}" class="btn btn-info" title="View">
					<span class="glyphicon glyphicon-eye-open"></a>
					&middot;	
					<a href="{{ route('admin.defects.edit', $defect->DefectID) }}"  class="btn btn-primary" title="Update">
					<span class="glyphicon glyphicon-open"></a>
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