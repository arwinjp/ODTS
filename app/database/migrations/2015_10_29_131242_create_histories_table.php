<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHistoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('histories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->integer('defect_id')->unsigned();
			$table->foreign('defect_id')->references('id')->on('defects')->onDelete('cascade');
			$table->integer('status_id')->unsigned();
			$table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');
			$table->text('status_comment');
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
		Schema::drop('histories');
	}

}
