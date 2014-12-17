<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeNotificationTypeInNewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement('ALTER TABLE `news` CHANGE `send_notification` `push_status` VARCHAR(45) NOT NULL DEFAULT "idle"');
		DB::statement('UPDATE `news` SET `push_status`= "idle"');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement('ALTER TABLE `news` CHANGE `push_status` `send_notification` BOOLEAN NOT NULL DEFAULT 0');
		DB::statement('UPDATE `news` SET `send_notification`= 0');
	}

}
