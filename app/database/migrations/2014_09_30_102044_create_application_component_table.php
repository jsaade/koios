<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateApplicationComponentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');

		Schema::create('application_component', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('application_id')->unsigned();
			$table->integer('component_id')->unsigned();
			$table->timestamps();
		});

		Schema::table('application_component', function(Blueprint $table)
		{
			$table->foreign('application_id')->references('id')->on('application')->onDelete('cascade');
			$table->foreign('component_id')->references('id')->on('component')->onDelete('cascade');
		});
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');

	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
		Schema::drop('application_component');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
