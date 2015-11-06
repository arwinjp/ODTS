@extends('admin::layouts.master')

@section('content-header')
	<h1>
		{{{ $title or 'All Projects' }}} ({{ $projects->getTotal() }})
		&middot;
		<small>{{ link_to_route('admin.projects.create', 'Add New Project') }}</small>
	</h1>
@stop

@section('content')

	@if(isset($search))
		@include('admin::users.search-form')
	@endif	
	<table class="table">
		<thead>
			<th>No</th>
			<th>Name</th>
			<th>Project Owner</th>
			<th class="text-center">Action</th>
		</thead>
		<tbody>
			@foreach ($projects as $project)
			<tr>
				<td>{{ $no }}</td>
				<td><a href="{{ route('admin.projects.show', $project->id) }}">{{$project->projectname}}</a></td>
				<td>{{ $project->username }}</td>
				<td class="text-center">
					<a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span></a></a>
					&middot;
					@include('admin::partials.modal', ['data' => $project, 'name' => 'projects'])
				</td>
			</tr>
			<?php $no++ ;?>
			@endforeach
		</tbody>
	</table>

	<div class="text-center">
		{{ pagination_links($projects) }}
	</div>
@stop