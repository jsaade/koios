<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeSubscriberFacebookIdToString extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement('ALTER TABLE `subscriber` CHANGE `facebook_id` `facebook_id` VARCHAR(45)');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement('ALTER TABLE `subscriber` CHANGE `facebook_id` `facebook_id` BIGINT(20)');
	}

}
