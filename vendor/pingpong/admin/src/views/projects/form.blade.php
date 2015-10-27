@if(isset($model))
{{ Form::model($model, ['method' => 'PUT', 'files' => true, 'route' => ['admin.projects.update', $model[0]->id]]) }}
@else
{{ Form::open(['files' => true, 'route' => 'admin.projects.store']) }}
@endif
	<div class="form-group">
		{{ Form::label('name', 'Project Name:') }}
		{{ Form::text('name', isset($model[0]) ? $model[0]->projectname : null, ['class' => 'form-control']) }}
		{{ $errors->first('name', '<div class="text-danger">:message</div>') }}
	</div>
	<div class="form-group">
		{{ Form::label('owner', 'Project Owner:') }}
		{{ Form::select('owner', $owners, isset($model[0]) ? $model[0]->userid : null, ['class' => 'form-control']) }}
		{{ $errors->first('owner', '<div class="text-danger">:message</div>') }}
	</div>
	<div class="form-group">
		{{ Form::submit(isset($model) ? 'Update' : 'Save', ['class' => 'btn btn-primary']) }}
	</div>
{{ Form::close() }}
