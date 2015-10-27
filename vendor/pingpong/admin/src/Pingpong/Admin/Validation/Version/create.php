<?php namespace Pingpong\Admin\Validation\Version;

use Pingpong\Validator\Validator;

class Create extends Validator {

	public function rules()
	{
		return [
	        'number' => 'required|unique_with:versions,project_id',
	        'startdate' => 'required|before:enddate',
	        'enddate' => 'required|after:startdate'
	    ];
	}

}