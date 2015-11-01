<?php
namespace Pingpong\Admin\Controllers;

Use Pingpong\Admin\Controllers\Defect as Defect;
Use Pingpong\Admin\Controllers\Project as Project;
Use Pingpong\Admin\Controllers\Status as Status;
Use Pingpong\Admin\Controllers\Priority as Priority;
Use Pingpong\Admin\Controllers\Severity as Severity;
Use Pingpong\Admin\Controllers\Version as Version;
Use Pingpong\Admin\Controllers\History as History;
Use Pingpong\Admin\Entities\User as User;
use DB;

class DefectsController extends BaseController {

	public function index()
	{
		$project = DB::table('default_projects')->where('user_id', '=', \Auth::user()->id)->select('project_id')->first();
		if(!$project){
			return $this->redirect('home')
					->withFlashMessage('Set Your Default Project Below!')
			        ->withFlashType('info');
		}
		else{
			$defects = DB::table('defects')
						->leftjoin('projects', 'defects.project_id', '=', 'projects.id')
						->leftjoin('versions', 'defects.version_id', '=', 'versions.id')
						->leftjoin('severities', 'defects.severity_id', '=', 'severities.id')
						->leftjoin('priorities', 'defects.priority_id', '=', 'priorities.id')
						->leftjoin('statuses', 'defects.status_id', '=', 'statuses.id')
						->leftjoin('users', 'defects.user_id', '=', 'users.id')
						->where('defects.project_id', '=', $project->project_id)
						->select('Defects.id AS DefectID', 'Defects.Summary AS DefectSummary', 'Defects.Description AS DefectDescription', 'users.name AS UserName', 'projects.name AS ProjectName', 'versions.number AS VersionNumber', 'severities.name AS SeverityName', 'priorities.name AS PriorityName', 'statuses.name AS StatusName')
						->paginate(25);
			
			$no = count($defects);
			
			return $this->view('defects.index', compact('defects', 'no'));
		}

	}

	public function create()
	{
		$project = DB::table('default_projects')->where('user_id', '=', \Auth::user()->id)->select('project_id')->first();
		if(!$project){
			return $this->redirect('home')
					->withFlashMessage('Set Your Default Project Below!')
			        ->withFlashType('info');
		}
		else{
			$severities = Severity::lists('name', 'id');
			$priorities = Priority::lists('name', 'id');
			$statuses = Status::lists('name', 'id');
			$versions = Version::where('project_id', '=', $project->project_id)->orderby('id', 'DESC')->lists('number', 'id');
			$users = User::where('id', '=', \Auth::user()->id)->lists('name', 'id');
			$projects = Project::where('id', '=', $project->project_id)->select('name', 'id')->first();

			$fields = $this->setFields(NULL, NULL, NULL, NULL, NULL, 'disabled', NULL, NULL, 'readonly');

			return $this->view('defects.create', compact('severities', 'priorities', 'statuses', 'versions', 'users', 'projects', 'fields'));
		}	
	}

	public function store()
	{
		app('Pingpong\Admin\Validation\Defect\Create')->validate($data = $this->inputAll());

		$destination = public_path() . '\attachments\\' . $data['name'] . '\\' . Version::find($data['version_id'])->number . '\\';
		$dbdestination = 'attachments/' . $data['name'] . '/' . Version::find($data['version_id'])->number . '/';

		$defect = new Defect;
		$defect->project_id = $data['project_id'];
		$defect->version_id = $data['version_id'];
		$defect->user_id = $data['user_id'];
		$defect->summary = $data['summary'];
		$defect->description = $data['description'];
		$defect->severity_id = $data['severity_id'];
		$defect->priority_id = $data['priority_id'];
		$defect->status_id = $data['status_id'];
		$defect->save();

		$filename = $defect->id . '.' . $data['attachment']->getClientOriginalExtension();
		$data['attachment']->move($destination, $filename);

		$defect->attachment = $dbdestination . $filename;
		$defect->save();

		$history = new History;
		$history->user_id = $data['user_id'];
		$history->defect_id = $defect->id;
		$history->status_id = $data['status_id'];
		$history->status_comment = $data['comment'];
		$history->save();

		return $this->redirect('defects.index');
	}

	public function show($id)
	{
		$defects = DB::table('defects')
					->leftjoin('projects', 'defects.project_id', '=', 'projects.id')
					->leftjoin('versions', 'defects.version_id', '=', 'versions.id')
					->leftjoin('severities', 'defects.severity_id', '=', 'severities.id')
					->leftjoin('priorities', 'defects.priority_id', '=', 'priorities.id')
					->leftjoin('statuses', 'defects.status_id', '=', 'statuses.id')
					->leftjoin('users', 'defects.user_id', '=', 'users.id')
					->where('defects.id', '=', $id)
					->select('Defects.id AS DefectID', 'Defects.Summary AS DefectSummary', 'Defects.Description AS DefectDescription', 'users.name AS UserName', 'projects.name AS ProjectName', 'versions.number AS VersionNumber', 'severities.name AS SeverityName', 'priorities.name AS PriorityName', 'statuses.name AS StatusName')
					->first();

		$histories = DB::table('histories')
					->leftjoin('users', 'histories.user_id', '=', 'users.id')
					->leftjoin('Statuses', 'histories.status_id', '=', 'statuses.id')					
					->where('histories.defect_id', '=', $id)
					->select('users.name AS UserName', 'statuses.name AS StatusName', 'histories.created_at AS UpdatedDate', 'histories.status_comment AS StatusComment')
					->orderby('histories.created_at', 'ASC')
					->get();

		$no = count($histories);
		
		return $this->view('defects.show', compact('defects', 'histories', 'no'));
	}

	public function edit($id)
	{
		$defect = Defect::find($id);
		$severities = Severity::lists('name', 'id');
		$priorities = Priority::lists('name', 'id');
		$statuses = Status::lists('name', 'id');
		$versions = Version::where('project_id', '=', $defect->project_id)->orderby('id', 'DESC')->lists('number', 'id');
		$users = User::where('id', '=', \Auth::user()->id)->lists('name', 'id');
		$projects = Project::where('id', '=', $defect->project_id)->select('name', 'id')->first();
		$server = $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . '/';
		$currentstatus = Status::find($defect->status_id);

		\Session::forget('flash_message');
		\Session::forget('flash_type');
		\Session::put('flash_type', 'warning');
		$role = \Auth::user()->getRole()->name;
		echo $role;
		$disablebutton = '0';

		if(($role == 'Tester'))
		{
			$fields = $this->setFields('disabled', 'readonly', 'readonly', 'disabled', 'disabled', NULL, NULL, 'disabled');

			if($defect->status_id == '4')
			{
				$statuses = Status::whereIn('name', ['Open', 'Verified'])->lists('name', 'id');
			}
			elseif($defect->status_id == '6')
			{
				$statuses = Status::where('name', '=', 'Reopened')->lists('name', 'id');
			}
			else
			{
				return $this->redirect('defects.show', $id);
			}
		}
		elseif(($role == 'Test Lead') OR ($role == 'Manager'))
		{
			$fields = $this->setFields(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'readonly');

			if($defect->status_id == '1')
			{
				$statuses = Status::whereIn('name', ['Assigned', 'Duplicate', 'Rejected'])->lists('name', 'id');
			}
			elseif($defect->status_id == '4')
			{
				$statuses = Status::whereIn('name', ['Open', 'Verified', 'Closed'])->lists('name', 'id');
			}
			elseif($defect->status_id == '5')
			{
				$statuses = Status::where('name', '=', 'Closed')->lists('name', 'id');
			}
			else{
				$fields = $this->setFields('disabled', 'readonly', 'readonly', 'disabled', 'disabled', 'disabled', 'disabled', 'readonly');
			}
		}
		elseif($role == 'Dev Lead')
		{
			$fields = $this->setFields('disabled', 'readonly', 'readonly', 'disabled', 'disabled', NULL, NULL, 'disabled', 'readonly');

			if($defect->status_id == '2')
			{
				$statuses = Status::whereIn('name', ['Open', 'Test', 'Rejected', 'Deferred', 'Duplicate'])->lists('name', 'id');
			}
			elseif($defect->status_id == '3')
			{
				$statuses = Status::whereIn('name', ['Open', 'Test'])->lists('name', 'id');
			}
			else{
				$fields = $this->setFields('disabled', 'readonly', 'readonly', 'disabled', 'disabled', 'disabled', 'disabled', 'readonly');
			}
		}
		elseif(($role == 'Developer'))
		{
			$fields = $this->setFields('disabled', 'readonly', 'readonly', 'disabled', 'disabled', NULL, NULL, NULL, 'readonly');

			if($defect->status_id == '3')
			{
				$statuses = Status::whereIn('name', ['Test', 'Duplicate'])->lists('name', 'id');
			}
			else{
				$fields = $this->setFields('disabled', 'readonly', 'readonly', 'disabled', 'disabled', 'disabled', 'disabled', 'readonly');
			}
		}
		else{
			$fields = $this->setFields(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'readonly');
		}

		return $this->view('defects.edit', compact('severities', 'priorities', 'statuses', 'versions', 'users', 'projects', 'defect', 'projects', 'server', 'fields', 'currentstatus', 'disablebutton'));
	}

	public function update($id)
	{
		return \Input::All();
		app('Pingpong\Admin\Validation\Defect\Update')->validate($data = $this->inputAll());

		$defect = Defect::find($id);
		$data = \Input::All();
		isset($data['version_id']) ? $version = Version::find($data['version_id'])->number : $version = Version::find($defect->version_id)->number;
		$destination = public_path() . '\attachments\\' . $data['name'] . '\\' . $version . '\\';
		$dbdestination = 'attachments/' . $data['name'] . '/' . $version . '/';

		isset($data['version_id']) ? $defect->version_id = $data['version_id'] : $defect->version_id = $defect->version_id;
		isset($data['summary']) ? $defect->summary = $data['summary'] : $defect->summary = $defect->summary;
		isset($data['description']) ? $defect->description = $data['description'] : $defect->description = $defect->description;
		isset($data['severity_id']) ? $defect->severity_id = $data['severity_id'] : $defect->severity_id = $defect->severity_id;
		isset($data['priority_id']) ? $defect->priority_id = $data['priority_id'] : $defect->priority_id = $defect->priority_id;
		isset($data['status_id']) ? $defect->status_id = $data['status_id'] : $defect->status_id = $defect->status_id;
		$defect->save();

		if(isset($data['attachment']))
		{
			$filename = $defect->id . '.' . $data['attachment']->getClientOriginalExtension();
			$data['attachment']->move($destination, $filename);

			$defect->attachment = $dbdestination . $filename;
			$defect->save();
		}

		$history = new History;
		$history->user_id = $data['user_id'];
		$history->defect_id = $defect->id;
		$history->status_id = $data['status_id'];
		$history->status_comment = $data['comment'];
		$history->save();

		return $this->redirect('defects.index');
	}

	private function setFields($version_id, $summary, $description, $severity_id, $priority_id, $status_id, $comment, $attachment)
	{
		$fields = array('name' => 'readonly');
		$fields = array_add($fields, 'version_id', $version_id);
		$fields = array_add($fields, 'summary', $summary);
		$fields = array_add($fields, 'description', $description);
		$fields = array_add($fields, 'severity_id', $severity_id);
		$fields = array_add($fields, 'priority_id', $priority_id);
		$fields = array_add($fields, 'status_id', $status_id);
		$fields = array_add($fields, 'comment', $comment);
		$fields = array_add($fields, 'attachment', $attachment);
		$fields = array_add($fields, 'user_id', 'readonly');
		return $fields;
	}

}