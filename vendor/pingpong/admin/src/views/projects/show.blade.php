@extends('admin::layouts.master')

@section('content-header')
	<h1>
		{{{ $title or 'Project: ' . $projects[0]->projectname }}}
		&middot;
		<small>{{ link_to_route('admin.projects.index', 'Back') }}</small>
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
			<tr>
				<td>{{ $no }}</td>
				<td>{{ $projects[0]->projectname }}</td>
				<td>{{ $projects[0]->username }}</td>
				<td class="text-center">
					<a href="{{ route('admin.projects.edit', $projects[0]->id) }}" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span></a></a>
					&middot;			
					@include('admin::partials.modal', ['data' => $projects[0], 'name' => 'projects'])		
				</td>
			</tr>
			<?php $no++ ;?>
		</tbody>
	</table>
	<div class="form-group">
		{{ link_to_route('admin.project.{id}.releases.create', 'Add New Release', $projects[0]->id, array('class' => 'btn btn-primary')) }}
	</div>
	<hr/>
	<h3>
		{{{ 'Project: ' . $projects[0]->projectname . ' - All Releases' }}}
	</h3>
	<table class="table">
		<thead>
			<th>No</th>
			<th>Release Version</th>
			<th>Start Date</th>
			<th>End Date</th>
			<th class="text-center">Action</th>
		</thead>
		<tbody>		
			<?php $no=0; ?>
			@foreach($versions as $version)
			<tr>			
				<?php $no=$no+1; ?>
				<td>{{ $no }}</td>
				<td>{{ $version->number }}</td>
				<td>{{ $version->start_date }}</td>				
				<td>{{ $version->end_date }}</td>
				<td class="text-center">
					<a href="{{ route('admin.project.{id}.releases.edit', array($projects[0]->id, $version->id)) }}">Edit</a>
					&middot;			
					@include('admin::partials.modal', ['data' => $version, 'name' => 'project.release'])		
				</td>
			</tr>
			@endforeach
			<?php $no++ ;?>
		</tbody>
	</table>
	<div class="form-group">
		{{ link_to_route('admin.project.{id}.releases.create', 'Add New Release', $projects[0]->id, array('class' => 'btn btn-primary')) }}
	</div>
@stop