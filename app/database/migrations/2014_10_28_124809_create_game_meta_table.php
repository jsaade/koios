<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameMetaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('game_meta', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('meta_key');
			$table->string('meta_value');
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
		Schema::drop('game_meta');
	}

}
