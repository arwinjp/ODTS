<?php

namespace Pingpong\Admin\Controllers;
Use Pingpong\Admin\Controllers\Version as Version;
use Illuminate\Support\Facades\Config;
use DB;

class VersionsController extends BaseController {

	public function __construct()
    {
    	$this->users = app(Config::get('auth.model'));
    }

	/**
	 * Display a listing of the resource.
	 * GET /versions
	 *
	 * @return Response
	 */
	public function index($id)
	{
		$versions = Version::find($id);
		return $this->view('versions.index', compact('versions', '1', 'id'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /versions/create
	 *
	 * @return Response
	 */
	public function create($id)
	{		
		$project = DB::table('projects')
									->where('id', '=', $id)
									->get();
		return $this->view('versions.create', compact('project'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /versions
	 *
	 * @return Response
	 */
	public function store()
	{
		app('Pingpong\Admin\Validation\Version\Create')->validate($data = $this->inputAll());

		$start_day = date("Y-m-d", strtotime(\Input::get('startdate')));
		$end_day = date("Y-m-d", strtotime(\Input::get('enddate')));

		$version = new Version;
		$version->number = \Input::get('number');
		$version->project_id = \Input::get('project_id');
		$version->start_date = $start_day;
		$version->end_date = $end_day;
		$version->save();

		return $this->redirect('projects.show', \Input::get('project_id'));
	}

	/**
	 * Display the specified resource.
	 * GET /versions/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /versions/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($_project_id,$id)
	{
		try
        {
            $versions = DB::table('versions')
									->select('start_date', 'end_date', 'number', 'project_id', 'id')
									->where('id', '=', $id)
									->get();

									
            return $this->view('versions.edit', compact('versions'));

        }
        catch (ModelNotFoundException $e)
        {
            return $this->redirectNotFound();
        }

	}

	/**
	 * Update the specified resource in storage.
	 * PUT /versions/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($project_id, $id)
	{
		app('Pingpong\Admin\Validation\Version\update')->validate($data = $this->inputAll());

		$start_day = date("Y-m-d", strtotime(\Input::get('startdate')));
		$end_day = date("Y-m-d", strtotime(\Input::get('enddate')));

		$version = Version::find($id);
		$version->number = \Input::get('number');
		$version->project_id = \Input::get('project_id');
		$version->start_date = $start_day;
		$version->end_date = $end_day;
		$version->save();
		return $this->redirect('projects.show', \Input::get('project_id'));
		
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /versions/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$project = Version::find($id);

		Version::destroy($id);		

		return $this->redirect('projects.show', $project->project_id);
	}

}