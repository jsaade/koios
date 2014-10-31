<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriberAnswerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subscriber_answer', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->integer('question_id')->unsigned();
			$table->foreign('question_id')
						->references('id')
						->on('question')
						->onDelete('cascade');

			$table->integer('subscriber_id')->unsigned();
			$table->foreign('subscriber_id')
						->references('id')
						->on('subscriber')
						->onDelete('cascade');

			$table->boolean('is_correct')->default(0);
			
			$table->integer('answer_id')->unsigned();
			$table->foreign('answer_id') 
						->references('id')
						->on('answer')
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
		Schema::drop('subscriber_answer');
	}

}
