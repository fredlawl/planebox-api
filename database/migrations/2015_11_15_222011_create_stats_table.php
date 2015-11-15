<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('stats', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('session');

			$table->smallInteger('level', false, true);
			$table->mediumInteger('clicks', false, true);

			$table->boolean('won');
			$table->boolean('lost');
			$table->integer('time_taken', false, true);

			$table->index('session');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('stats');
	}

}
