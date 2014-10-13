<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeviceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('device', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('model', 255);
			$table->string('os', 255);
			$table->string('version', 255);
			$table->string('token', 255);

			$table->integer('subscriber_id')->unsigned();
			$table->foreign('subscriber_id')
						->references('id')
						->on('subscriber');

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
		Schema::drop('device');
	}

}
