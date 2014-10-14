<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriberTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subscriber', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('username', 255)->index();
			$table->string('email', 255)->index();
			$table->string('password', 255);
			$table->boolean('is_verified')->default(0);
			$table->string('verification_token', 255);

			$table->integer('application_id')->unsigned();
			$table->foreign('application_id')
						->references('id')
						->on('application')
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
		Schema::drop('subscriber');
	}

}
