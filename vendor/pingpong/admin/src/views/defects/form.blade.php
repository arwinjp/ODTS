@if(isset($model))
{{ Form::model($model, ['method' => 'PUT', 'files' => true, 'route' => ['admin.defects.update', $model->id]]) }}
@else
{{ Form::open(['files' => true, 'route' => 'admin.defects.store']) }}
@endif

	<div class="form-group col-xs-12 col-sm-8 col-md-8 col-lg-8">
		{{ Form::hidden('project_id', isset($model) ? $model->ProjectID : $projects->id) }}
		{{ Form::label('name', 'Project Name:') }}
		{{ Form::text('name', isset($model) ? $projects->name : $projects->name, ['class' => 'form-control', $fields['name']]) }}
		{{ $errors->first('name', '<div class="text-danger">:message</div>') }}
	</div>

	<div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-4">
		{{ Form::label('version_id', 'Release Version:') }}
		{{ Form::select('version_id', $versions, isset($model) ? $model->version_id : NULL, ['class' => 'form-control', $fields['version_id']]) }}
		{{ $errors->first('version_id', '<div class="text-danger">:message</div>') }}
	</div>	

	<div class="form-group col-xs-12 col-sm-12 col-lg-12">
		{{ Form::label('summary', 'Summary:') }}
		{{ Form::text('summary', isset($model) ? $model->summary : NULL, ['class' => 'form-control', 'placeholder' => 'Short summary of the defect', $fields['summary']]) }}
		{{ $errors->first('summary', '<div class="text-danger">:message</div>') }}
	</div>

	<div class="form-group col-xs-12 col-sm-12 col-lg-12">
		{{ Form::label('description', 'Description:') }}
		{{ Form::textarea('description', isset($model) ? $model->description : NULL, ['class' => 'form-control', 'placeholder' => 'More details on the defect, steps to reproduce, location of the defect, etc.', $fields['description']]) }}
		{{ $errors->first('description', '<div class="text-danger">:message</div>') }}
	</div>

	<div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
		{{ Form::label('severity_id', 'Severity:') }}
		{{ Form::select('severity_id', $severities, isset($model) ? $model->severity_id : NULL, ['class' => 'form-control', $fields['severity_id']]) }}
		{{ $errors->first('severity_id', '<div class="text-danger">:message</div>') }}
	</div>

	<div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
		{{ Form::label('priority_id', 'Priority:') }}
		{{ Form::select('priority_id', $priorities, isset($model) ? $model->priority_id : NULL, ['class' => 'form-control', $fields['priority_id']]) }}
		{{ $errors->first('priority_id', '<div class="text-danger">:message</div>') }}
	</div>	

	<div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
		{{ Form::hidden('status_id', isset($model) ? $model->StatusID : 1) }}
		{{ Form::label('status_id', 'Status:') }}
		{{ Form::select('status_id', $statuses, isset($model) ? $model->status_id : 1, ['class' => 'form-control', $fields['status_id']]) }}
		{{ $errors->first('status_id', '<div class="text-danger">:message</div>') }}
	</div>

	<div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
		{{ Form::label('comment', 'Status Comment:') }}
		{{ Form::text('comment', NULL, ['class' => 'form-control' , 'placeholder' => 'Mandatory comment for the status change.', $fields['comment']]) }}
		{{ $errors->first('comment', '<div class="text-danger">:message</div>') }}
	</div>

	<div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
		{{ Form::label('attachment', isset($model) ? 'Attachment (Max size 1MB) (Previous file will be overwritten):' : 'Attachment (Max size 1MB):') }}
		{{ Form::file('attachment',  ['class' => 'form-control', $fields['attachment']]) }}
		{{ $errors->first('attachment', '<div class="text-danger">:message</div>') }}
	</div>

	<div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
		{{ Form::label('user_id', isset($model) ? 'Updated By:' : 'Logged By:') }}
		{{ Form::select('user_id', $users, isset($model) ? $model->user_id : \Auth::user()->id, ['class' => 'form-control', $fields['user_id']]) }}
		{{ $errors->first('user_id', '<div class="text-danger">:message</div>') }}
	</div>	

	@if(isset($model))
		<div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
			<a class="btn btn-app" href='http://{{ $server . $model->attachment }}'>
				<i class="fa fa-save"></i> Download Attachment
			</a>
		</div>
	@endif

	@if(!$disablebutton == '1')
		<div class="form-group  col-xs-12 col-sm-12 col-md-12 col-lg-12">
			{{ Form::submit(isset($model) ? 'Update' : 'Save', ['class' => 'btn btn-primary']) }}
		</div>
	@endif
{{ Form::close() }}
