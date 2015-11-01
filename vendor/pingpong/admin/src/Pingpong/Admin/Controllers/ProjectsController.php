<?php namespace Pingpong\Admin\Controllers;

use Illuminate\Support\Facades\Config;
use DB;
use DateTime;

class ProjectsController extends BaseController {

	protected $projects;

	public function __construct()
    {
    	
    }

	/**
	 * Display a listing of projects
	 *
	 * @return Response
	 */	

	public function index()
	{
		$projects = DB::table('projects')
									->leftjoin('users', 'projects.owner_id', '=', 'users.id')
									->select('users.name as username', 'projects.name as projectname', 'projects.id')
									->orderby('projects.name')
									->paginate(10);
		$no = $projects->getFrom();

		return $this->view('projects.index', compact('projects', 'no'));
	}

	/**
	 * Show the form for creating a new project
	 *
	 * @return Response
	 */
	public function create()
	{
		$owners = DB::table('users')->lists('name','id');

		return $this->view('projects.create', compact('owners'));
	}

	/**
	 * Store a newly created project in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$date = new DateTime;
		$time = $date->format('m-d-y H:i:s');

		app('Pingpong\Admin\Validation\Project\Create')->validate($data = $this->inputAll());

		DB::table('projects')->insert(array('name'=>$data['name'], 'owner_id'=>$data['owner'], 'created_at'=>$time));

		return $this->redirect('projects.index');
	}

	/**
	 * Display the specified project.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$projects = DB::table('projects')
									->leftjoin('users', 'projects.owner_id', '=', 'users.id')
									->select('users.name as username', 'projects.name as projectname', 'projects.id')
									->where('projects.id', '=', $id)
									->get();
		$no = 1;

		$versions = DB::table('versions')->where('project_id', '=', $id)->paginate(10);;

		return $this->view('projects.show', compact('projects','no', 'versions'));
	}

	/**
	 * Show the form for editing the specified project.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		try
        {
            $projects = DB::table('projects')
            						->join('users', 'projects.owner_id', '=', 'users.id')
									->select('users.name as username', 'projects.name as projectname', 'projects.id', 'users.id as userid')
									->where('projects.id', '=', $id)
									->get();

			$owners = DB::table('users')->lists('name','id');

            return $this->view('projects.edit', compact('projects', 'owners', 'id'));
        }
        catch (ModelNotFoundException $e)
        {
            return $this->redirectNotFound();
        }
	}

	/**
	 * Update the specified project in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		app('Pingpong\Admin\Validation\Project\Update')->validate($data = $this->inputAll());

		$date = new DateTime;
		$time = $date->format('m-d-y H:i:s');

		DB::table('projects')
						->where('id', '=', $id)
						->update(array('name'=>$data['name'], 'owner_id'=>$data['owner'], 'updated_at'=>$time));						

		return $this->redirect('projects.index');
	}

	/**
	 * Remove the specified project from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		DB::table('projects')->delete($id);

		return $this->redirect('projects.index');
	}

}
