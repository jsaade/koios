<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('news', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 255);
			$table->text('description')->nullable();
			$table->text('caption')->nullable();
			$table->string('image', 255)->nullable();

			//application_id acts like a foreign key, but doesn't have the relation
			//this is just to speed up the queries on the news per application
			$table->integer('application_id')->unsigned()->index(); 

			$table->integer('news_category_id')->unsigned();
			$table->foreign('news_category_id')
						->references('id')
						->on('news_category')
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
		Schema::drop('news');
	}

}
