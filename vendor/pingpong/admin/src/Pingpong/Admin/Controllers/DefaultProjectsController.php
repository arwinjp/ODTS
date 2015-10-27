<?php

namespace Pingpong\Admin\Controllers;
Use Pingpong\Admin\Controllers\DefaultProject as DefaultProject;

class DefaultProjectsController extends BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /defaults
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /defaults/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /defaults
	 *
	 * @return Response
	 */
	public function store()
	{
		$default = new DefaultProject;
		$default->user_id = \Input::get('user_id');
		$default->project_id = \Input::get('project_id');
		$default->save();
		
		return $this->redirect('home');
	}

	/**
	 * Display the specified resource.
	 * GET /defaults/{id}
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
	 * GET /defaults/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /defaults/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$default = DefaultProject::find($id);	
		$default->project_id = \Input::get('project_id');
		$default->user_id = \Input::get('user_id');
		$default->save();

		return $this->redirect('home');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /defaults/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}