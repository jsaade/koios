<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddScoreLevelFieldsToSubscriberTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('subscriber', function(Blueprint $table)
		{
			$table->bigInteger('score');
			$table->integer('level');
			$table->text('fields')->nullable();
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
			$table->dropColumn('score');
			$table->dropColumn('level');
			$table->dropColumn('fields');
		});
	}

}
