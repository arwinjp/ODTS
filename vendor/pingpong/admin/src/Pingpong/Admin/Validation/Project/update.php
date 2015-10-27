<?php namespace Pingpong\Admin\Validation\Project;

use Pingpong\Validator\Validator;
use Illuminate\Support\Facades\Request;

class Update extends Validator {

	public function rules()
	{
		$id = Request::segment(3);
		return [
	        'name' => 'required|unique:projects,id,' . $id
	    ];
	}

}