@extends('admin::layouts.master')

@section('content-header')
	<h1>
		{{{ $title or 'All Versions' }}} ( <?php if(isset($versions)){ echo $versions[0]->getTotal(); } ?>)
		&middot;
		<small>{{ link_to_route('admin.project.{id}.releases.create', 'Add New Version', $id) }}</small>
	</h1>
@stop

@section('content')

	@if(isset($search))
		@include('admin::users.search-form')
	@endif	
	<table class="table">
		<thead>
			<th>No</th>
			<th>Version Number</th>
			<th>Start Date</th>
			<th>End Date</th>
			<th class="text-center">Action</th>
		</thead>
		<tbody>
			<?php if(isset($verions)){ ?>
			@foreach ($versions as $version)
			<tr>
				<td>{{ $no }}</td>
				<td><a href="{{ route('admin.projects.show', $version->id) }}">{{$version->number}}</a></td>
				<td>{{ $verion->startdate }}</td>
				<td>{{ $verion->enddate }}</td>
				<td class="text-center">
					<a href="{{ route('admin.projects.edit', $version->id) }}" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span></a></a>
					&middot;
					@include('admin::partials.modal', ['data' => $version, 'name' => 'versions'])
				</td>
			</tr>
			<?php $no++ ;?>
			@endforeach
			<?php } ?>
		</tbody>
	</table>

	<div class="text-center">
		<?php if(isset($verions)){ ?>
			{{ pagination_links($versions) }}
		<?php } ?>
	</div>
@stop