<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAsset extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('asset', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('caption');
			$table->string('type');
			$table->string('url');
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
		Schema::drop('asset');
	}

}
