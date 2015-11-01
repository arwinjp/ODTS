{{ Form::open() }}
	
	<div class="form-group col-xs-8 col-sm-8 col-md-8 col-lg-8">
		{{ Form::label('name', 'Project Name:') }}
		{{ Form::text('name', $model->ProjectName, ['class' => 'form-control', 'disabled']) }}
	</div>

	<div class="form-group col-xs-4 col-sm-4 col-md-4 col-lg-4">
		{{ Form::label('version', 'Release Version:') }}
		{{ Form::text('version', $model->VersionNumber, ['class' => 'form-control', 'disabled']) }}
	</div>	

	<div class="form-group col-xs-12 col-sm-12 col-lg-12">
		{{ Form::label('summary', 'Summary:') }}
		{{ Form::text('summary', $model->DefectSummary, ['class' => 'form-control', 'disabled']) }}
	</div>

	<div class="form-group col-xs-12 col-sm-12 col-lg-12">
		{{ Form::label('description', 'Description:') }}
		{{ Form::textarea('description', $model->DefectDescription, ['class' => 'form-control', 'disabled']) }}
	</div>

	<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
		{{ Form::label('logged', 'Logged By:') }}
		{{ Form::text('logged', $model->UserName, ['class' => 'form-control', 'disabled']) }}
	</div>	

	<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
		{{ Form::label('severity', 'Severity:') }}
		{{ Form::text('severity', $model->SeverityName, ['class' => 'form-control', 'disabled']) }}
	</div>

	<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
		{{ Form::label('priority', 'Priority:') }}
		{{ Form::text('priority', $model->PriorityName, ['class' => 'form-control', 'disabled']) }}
	</div>	

	<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
		{{ Form::label('status', 'Status:') }}
		{{ Form::text('status', $model->StatusName, ['class' => 'form-control', 'disabled']) }}
	</div>	

	<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
		{{ Form::label('histroy', 'History:') }}
		<table class="table">
			<thead>
				<th>No</th>
				<th>User</th>
				<th>Status Changed To</th>
				<th>Comment</th>
				<th>Date</th>
			</thead>
			<tbody>
				@foreach ($histories as $history)
				<tr>
					<td>{{ $no }}</td>
					<td>{{ $history->UserName }}</td>
					<td>{{ $history->StatusName }}</td>					
					<td>{{ $history->StatusComment }}</td>
					<td>{{ $history->UpdatedDate }}</td>
				</tr>
				<?php $no++ ;?>
				@endforeach
			</tbody>
		</table>
	</div>	

{{ Form::close() }}
