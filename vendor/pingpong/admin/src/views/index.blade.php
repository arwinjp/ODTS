@extends('admin::layouts.master')

@section('content-header')
	<h1>
		Dashboard
		<small>Control panel</small>
	</h1>
@stop

@section('content')

<div>
	<?php $default = DB::table('default_projects')->where('user_id', '=', \Auth::user()->id)->first(); ?>
	@if(isset($default))
		{{ Form::model($default, ['method' => 'PUT', 'route' => array('admin.default.update', $default->id)]) }}
	@else
		{{ Form::open(array('route'=>'admin.default.store')) }}
	@endif
		<div>
			{{ Form::hidden('user_id', \Auth::user()->id) }}
		</div>
    	<div class="form-group">
			{{ Form::label('default', 'Default Project:') }}		
			<?php $projects = Pingpong\Admin\Controllers\Project::lists('name', 'id'); ?>
			{{ Form::select('project_id', $projects, isset($default) ? $default->project_id : NULL, ['class' => 'form-control']) }}
			{{ $errors->first('user_id', '<div class="text-danger">:message</div>') }}
		</div>
		<div class="form-group">
			{{ Form::submit(isset($default) ? 'Update' : 'Save', ['class' => 'btn btn-primary']) }}
		</div>
	{{ Form::close() }}
</div>
<!-- Small boxes (Stat box) -->
<div class="row">
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-aqua">
			<div class="inner">
				<h3>
					{{ user()->count() }}
				</h3>

				<p>
					All Users
				</p>
			</div>
			<div class="icon">
				<i class="fa fa-users"></i>
			</div>
			<a href="{{ route('admin.users.index') }}" class="small-box-footer">
				More info <i class="fa fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>

	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-yellow">
			<div class="inner">
				<h3>
					{{ \DB::table('projects')->count() }}
				</h3>

				<p>
					All Projects
				</p>
			</div>
			<div class="icon">
				<i class="fa fa-users"></i>
			</div>
			<a href="{{ route('admin.projects.index') }}" class="small-box-footer">
				More info <i class="fa fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>

	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-blue">
			<div class="inner">
				<h3>
					<?php 
						$project = \DB::table('default_projects')->where('user_id', '=', \Auth::user()->id)->select('project_id')->first();
						echo \DB::table('defects')->where('project_id', '=', $project->project_id)->count();
					?>
				</h3>

				<p>
					All Defects
				</p>
			</div>
			<div class="icon">
				<i class="fa fa-bug"></i>
			</div>
			<a href="{{ route('admin.defects.index') }}" class="small-box-footer">
				More info <i class="fa fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>

	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-green">
			<div class="inner">
				<h3>
					<?php 
						$project = \DB::table('default_projects')->where('user_id', '=', \Auth::user()->id)->select('project_id')->first();
						echo \DB::table('defects')->where('project_id', '=', $project->project_id)->where('status_id', '=', '6')->count();
					?>					
				</h3>

				<p>
					Closed Defects
				</p>
			</div>
			<div class="icon">
				<i class="fa fa-bug"></i>
			</div>
			<a href="{{ route('admin.defects.index') }}" class="small-box-footer">
				More info <i class="fa fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>

	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-orange">
			<div class="inner">
				<h3>
					<?php 
						$project = \DB::table('default_projects')->where('user_id', '=', \Auth::user()->id)->select('project_id')->first();
						echo \DB::table('defects')->where('project_id', '=', $project->project_id)->where('status_id', '=', '1')->count();
					?>					
				</h3>

				<p>
					New Defects
				</p>
			</div>
			<div class="icon">
				<i class="fa fa-bug"></i>
			</div>
			<a href="{{ route('admin.defects.index') }}" class="small-box-footer">
				More info <i class="fa fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>

	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-orange">
			<div class="inner">
				<h3>
					<?php 
						$project = \DB::table('default_projects')->where('user_id', '=', \Auth::user()->id)->select('project_id')->first();
						echo \DB::table('defects')->where('project_id', '=', $project->project_id)->where('status_id', '=', '1')->count();
					?>					
				</h3>

				<p>
					New Defects
				</p>
			</div>
			<div class="icon">
				<i class="fa fa-bug"></i>
			</div>
			<a href="{{ route('admin.defects.index') }}" class="small-box-footer">
				More info <i class="fa fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>

	<!-- ./col -->
</div>
<!-- /.row -->

<!-- Main row -->
<div class="row">
	<!-- Left col -->
	<section class="col-lg-7 connectedSortable">

		</section>
		<!-- /.Left col -->
		<!-- right col (We are only adding the ID to make the widgets sortable)-->
		<section class="col-lg-5 connectedSortable">

			
			<!-- /.row (main row) -->

			@stop

@section('script')
	<script src="{{ admin_asset('components/raphael/raphael-min.js') }}"></script>
	<script src="{{ admin_asset('adminlte/js/plugins/morris/morris.min.js') }}"></script>
	<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
	<script src="{{ admin_asset('adminlte/js/AdminLTE/dashboard.js') }}" type="text/javascript"></script>

@stop
