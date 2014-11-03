<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddScoreLevelFieldsToSubscribers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('subscriber', function(Blueprint $table)
		{
			$table->integer('level');
			$table->bigInteger('score');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('subscriber', function(Blueprint $table)
		{
			$table->dropColumn('level');
			$table->dropColumn('score');
		});
	}

}
