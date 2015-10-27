<?php namespace Pingpong\Admin\Validation\Project;

use Pingpong\Validator\Validator;

class Create extends Validator {

	public function rules()
	{
		return [
	        'name' => 'required|unique:projects',
	    ];
	}

}