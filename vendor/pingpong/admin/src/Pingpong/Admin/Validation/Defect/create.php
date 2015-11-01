<?php namespace Pingpong\Admin\Validation\Defect;

use Pingpong\Validator\Validator;

class Create extends Validator {

	public function rules()
	{
		return [
			'name' => 'required',
	        'summary' => 'required|min:15',
	        'description' => 'required|min:30',
	        'attachment' => 'required|max:1024|mimes:jpeg,png,bmp,doc,docx,xls,xlsx',
	        'status_id' => 'required|in:1',
	        'severity_id' => 'in:1,2,3,4',
	        'priority_id' => 'in:1,2,3',
	        'user_id' => 'required',
	        'comment' => 'required',
	    ];
	}

}