<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('question', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('description');
			$table->string('image', 255)->nullable();

			//application_id acts like a foreign key, but doesn't have the relation
			//this is just to speed up the queries on the questions per application
			$table->integer('application_id')->unsigned()->index(); 

			$table->integer('question_category_id')->unsigned();
			$table->foreign('question_category_id')
						->references('id')
						->on('question_category')
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
		Schema::drop('question');
	}

}
