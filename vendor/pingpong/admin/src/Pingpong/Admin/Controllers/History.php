<?php
namespace Pingpong\Admin\Controllers;
Use Pingpong\Presenters\Model as Model;

class History extends Model {

	protected $table = 'histories';

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

	public function Defect(){
		return $this->belongsTo('Defect');
	}

}