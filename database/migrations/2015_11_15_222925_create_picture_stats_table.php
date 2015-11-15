<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePictureStatsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('picture_stats', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('category');
			$table->string('picture');
			$table->boolean('won');
			$table->boolean('lost');

			$table->index('picture');
			$table->index('category');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('picture_stats');
	}

}
