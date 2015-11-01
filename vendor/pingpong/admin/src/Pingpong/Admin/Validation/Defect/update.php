<?php namespace Pingpong\Admin\Validation\Defect;

use Pingpong\Validator\Validator;

class Update extends Validator {

	public function rules()
	{
		return [
			'name' => 'required',
	        'summary' => 'required|min:15',
	        'description' => 'required|min:30',
	        'attachment' => 'max:1024|mimes:jpeg,png,bmp,doc,docx,xls,xlsx',
	        'severity_id' => 'in:1,2,3,4',
	        'priority_id' => 'in:1,2,3',
	        'user_id' => 'required',
	        'comment' => 'required_with:status_id',
	    ];
	}

}