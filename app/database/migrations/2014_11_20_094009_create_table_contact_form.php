<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableContactForm extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contact_form', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 255);
			$table->string('email', 255);
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
		Schema::drop('contact_form');
	}

}
