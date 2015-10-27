<?php namespace Pingpong\Admin\Validation\DefaultProject;

use Pingpong\Validator\Validator;

class Create extends Validator {

	public function rules()
	{
		return [
			'user_id' => 'required|unique:default_projects',
	        'project_id' => 'required'
	    ];
	}

}