<?php
namespace Pingpong\Admin\Controllers;
Use Pingpong\Presenters\Model as Model;

class Defect extends Model {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

	public function histories(){
		return $this->hasMany('History');
	}

	public function severity(){
		return $this->hasOne('Severity');
	}

	public function priority(){
		return $this->hasOne('Priority');
	}

	public function status(){
		return $this->hasOne('Status');
	}

	public function user(){
		return $this->belongsTo('Pingpong\Admin\Entities\User');
	}

	public function project(){
		return $this->belongsTo('Pingpong\Admin\Controllers\Project');
	}

}