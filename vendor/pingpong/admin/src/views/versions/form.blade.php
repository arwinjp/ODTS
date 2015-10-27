@if(isset($model))
{{ Form::model($model, ['method' => 'PUT', 'files' => true, 'route' => array('admin.project.{id}.releases.update', $model[0]->project_id, $model[0]->id)]) }}
@else
{{ Form::open(['files' => true, 'route' => array('admin.project.{id}.releases.store', $project[0]->id)]) }}
@endif
	<div>
		{{ Form::hidden('project_id', isset($model) ? $model[0]->project_id : $project[0]->id) }}
	</div>
	<div class="form-group">
		{{ Form::label('number', 'Release Number:') }}
		{{ Form::text('number', isset($model[0]) ? $model[0]->number : null, ['class' => 'form-control']) }}
		{{ $errors->first('number', '<div class="text-danger">:message</div>') }}
	</div>
	<div class="form-group">
		{{ Form::label('startdate', 'Start Date (YYYY-MM-DD):') }}
		{{ Form::text('startdate', isset($model[0]) ? $model[0]->start_date : null, ['class' => 'form-control', 'id' => 'datepicker']) }}
		{{ $errors->first('startdate', '<div class="text-danger">:message</div>') }}
	</div>
	<div class="form-group">
		{{ Form::label('enddate', 'End Date (YYYY-MM-DD):') }}
		{{ Form::text('enddate', isset($model[0]) ? $model[0]->end_date : null, ['class' => 'form-control', 'id' => 'datepicker2']) }}
		{{ $errors->first('enddate', '<div class="text-danger">:message</div>') }}
	</div>
	<div class="form-group">
		{{ Form::submit(isset($model) ? 'Update' : 'Save', ['class' => 'btn btn-primary']) }}
	</div>
{{ Form::close() }}
