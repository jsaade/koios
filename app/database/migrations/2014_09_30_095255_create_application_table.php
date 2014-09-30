<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('application', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 255);
			$table->text('description')->nullable();
			$table->string('image', 255)->nullable();
			$table->string('slug', 255)
					->unique()
					->index();

			$table->string('api_key', 255)
					->unique(); 

			$table->string('api_secret', 255)
					->unique(); 

			$table->integer('client_id')->unsigned();
			$table->foreign('client_id')
						->references('id')
						->on('client')
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
		Schema::drop('application');
	}

}
