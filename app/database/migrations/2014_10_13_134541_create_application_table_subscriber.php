<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationTableSubscriber extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('application_subscriber', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('application_id')->unsigned();
			$table->foreign('application_id')
						->references('id')
						->on('application')
						->onDelete('cascade');

			$table->integer('subscriber_id')->unsigned();
			$table->foreign('subscriber_id')
						->references('id')
						->on('subscriber')
						->onDelete('cascade');

			$table->integer('score');

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
		Schema::drop('application_subscriber');
	}

}
