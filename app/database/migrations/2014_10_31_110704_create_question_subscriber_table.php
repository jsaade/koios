<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuestionSubscriberTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('question_subscriber', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('question_id')->unsigned()->index();
			$table->foreign('question_id')->references('id')->on('question')->onDelete('cascade');
			$table->integer('subscriber_id')->unsigned()->index();
			$table->foreign('subscriber_id')->references('id')->on('subscriber')->onDelete('cascade');

			$table->integer('answer_id')->unsigned()->index();

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
		Schema::drop('question_subscriber');
	}

}
