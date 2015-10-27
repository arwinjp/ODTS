<?php namespace Pingpong\Admin\Validation\Version;

use Pingpong\Validator\Validator;
use Illuminate\Support\Facades\Request;

class Update extends Validator {

	public function rules()
	{
		$id = Request::segment(5);
		return [
	        'number' => 'required|unique_with:versions,project_id,' . $id .'=id',
	        'startdate' => 'required|before:enddate',
	        'enddate' => 'required|after:startdate'
	    ];
	}

}