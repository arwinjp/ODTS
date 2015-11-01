<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDefectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('defects', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('project_id')->unsigned();
			$table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
			$table->integer('version_id')->unsigned();
			$table->foreign('version_id')->references('id')->on('versions')->onDelete('cascade');
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->string('summary');
			$table->text('description');
			$table->integer('severity_id')->unsigned();
			$table->foreign('severity_id')->references('id')->on('severities')->onDelete('cascade');
			$table->integer('priority_id')->unsigned();
			$table->foreign('priority_id')->references('id')->on('priorities')->onDelete('cascade');
			$table->string('attachment');
			$table->integer('status_id')->unsigned();
			$table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('defects');
	}

}
