<?php
namespace Pingpong\Admin\Controllers;
Use Pingpong\Presenters\Model as Model;

class Priority extends Model {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];
	
}