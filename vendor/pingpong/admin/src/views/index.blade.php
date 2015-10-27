@extends('admin::layouts.master')

@section('content-header')
	<h1>
		Dashboard
		<small>Control panel</small>
	</h1>
@stop

@section('content')

<div>
	<?php $default = DB::table('default_projects')->where('user_id', '=', \Auth::user()->id)->get(); ?>
	@if(isset($default))
		{{ Form::model($default, ['method' => 'PUT', 'route' => array('admin.default.update', $default[0]->id)]) }}
	@else
		{{ Form::open(array('route'=>'admin.default.store')) }}
	@endif
		<div>
			{{ Form::hidden('user_id', \Auth::user()->id) }}
		</div>
    	<div class="form-group">
			{{ Form::label('default', 'Default Project:') }}		
			<?php $projects = Pingpong\Admin\Controllers\Project::lists('name', 'id'); ?>
			{{ Form::select('project_id', $projects, isset($default) ? $default[0]->project_id : NULL, ['class' => 'form-control']) }}
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
	<!-- ./col -->
</div>
<!-- /.row -->

<!-- Main row -->
<div class="row">
	<!-- Left col -->
	<section class="col-lg-7 connectedSortable">

		<!-- TO DO List -->
		<div class="box box-primary">
			<div class="box-header">
				<i class="ion ion-clipboard"></i>

				<h3 class="box-title">To Do List</h3>

				<div class="box-tools pull-right">
					<ul class="pagination pagination-sm inline">
						<li><a href="#">&laquo;</a></li>
						<li><a href="#">1</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">&raquo;</a></li>
					</ul>
				</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<ul class="todo-list">
					<li>
						<!-- drag handle -->
						<span class="handle">
							<i class="fa fa-ellipsis-v"></i>
							<i class="fa fa-ellipsis-v"></i>
						</span>
						<!-- checkbox -->
						<input type="checkbox" value="" name=""/>
						<!-- todo text -->
						<span class="text">Design a nice theme</span>
						<!-- Emphasis label -->
						<small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
						<!-- General tools such as edit or delete-->
						<div class="tools">
							<i class="fa fa-edit"></i>
							<i class="fa fa-trash-o"></i>
						</div>
					</li>
					<li>
						<span class="handle">
							<i class="fa fa-ellipsis-v"></i>
							<i class="fa fa-ellipsis-v"></i>
						</span>
						<input type="checkbox" value="" name=""/>
						<span class="text">Make the theme responsive</span>
						<small class="label label-info"><i class="fa fa-clock-o"></i> 4 hours</small>
						<div class="tools">
							<i class="fa fa-edit"></i>
							<i class="fa fa-trash-o"></i>
						</div>
					</li>
					<li>
						<span class="handle">
							<i class="fa fa-ellipsis-v"></i>
							<i class="fa fa-ellipsis-v"></i>
						</span>
						<input type="checkbox" value="" name=""/>
						<span class="text">Let theme shine like a star</span>
						<small class="label label-warning"><i class="fa fa-clock-o"></i> 1 day</small>
						<div class="tools">
							<i class="fa fa-edit"></i>
							<i class="fa fa-trash-o"></i>
						</div>
					</li>
					<li>
						<span class="handle">
							<i class="fa fa-ellipsis-v"></i>
							<i class="fa fa-ellipsis-v"></i>
						</span>
						<input type="checkbox" value="" name=""/>
						<span class="text">Let theme shine like a star</span>
						<small class="label label-success"><i class="fa fa-clock-o"></i> 3 days</small>
						<div class="tools">
							<i class="fa fa-edit"></i>
							<i class="fa fa-trash-o"></i>
						</div>
					</li>
					<li>
						<span class="handle">
							<i class="fa fa-ellipsis-v"></i>
							<i class="fa fa-ellipsis-v"></i>
						</span>
						<input type="checkbox" value="" name=""/>
						<span class="text">Check your messages and notifications</span>
						<small class="label label-primary"><i class="fa fa-clock-o"></i> 1 week</small>
						<div class="tools">
							<i class="fa fa-edit"></i>
							<i class="fa fa-trash-o"></i>
						</div>
					</li>
					<li>
						<span class="handle">
							<i class="fa fa-ellipsis-v"></i>
							<i class="fa fa-ellipsis-v"></i>
						</span>
						<input type="checkbox" value="" name=""/>
						<span class="text">Let theme shine like a star</span>
						<small class="label label-default"><i class="fa fa-clock-o"></i> 1 month</small>
						<div class="tools">
							<i class="fa fa-edit"></i>
							<i class="fa fa-trash-o"></i>
						</div>
					</li>
				</ul>
			</div>
			<!-- /.box-body -->
			<div class="box-footer clearfix no-border">
				<button class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</button>
			</div>
		</div>
		<!-- /.box -->

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
