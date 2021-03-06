<?php
namespace Pingpong\Admin\Controllers;
Use Pingpong\Presenters\Model as Model;

class Project extends Model {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

	public function defects(){
		return $this->hasMany('Pingpong\Admin\Controllers\Defect');
	}

	public function versions(){
		return $this->hasMany('Pingpong\Admin\Controllers\Version');
	}

}