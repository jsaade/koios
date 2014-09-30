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
		Schema::create('application_component', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('application_id')->unsigned()->index();
			$table->foreign('application_id')->references('id')->on('applications')->onDelete('cascade');
			$table->integer('component_id')->unsigned()->index();
			$table->foreign('component_id')->references('id')->on('components')->onDelete('cascade');
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
		Schema::drop('application_component');
	}

}
