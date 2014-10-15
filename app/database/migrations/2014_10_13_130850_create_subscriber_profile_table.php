<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriberProfileTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subscriber_profile', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('first_name', 255);
			$table->string('last_name', 255);
			$table->string('image', 255);
			$table->bigInteger('facebook_id');

			$table->integer('subscriber_id')->unsigned();
			$table->foreign('subscriber_id')
					->references('id')
					->on('subscriber')
					->onDelete('cascade');

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
		Schema::drop('subscriber_profile');
	}

}
