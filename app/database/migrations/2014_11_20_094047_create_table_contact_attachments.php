<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableContactAttachments extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contact_attachments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('type', 255)->default('image');
			$table->string('url', 255);
			$table->integer('contact_form_id')->unsigned();
			$table->foreign('contact_form_id')
						->references('id')
						->on('contact_form')
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
		Schema::drop('contact_attachments');
	}

}
