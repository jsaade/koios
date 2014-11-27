<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteFacebookIdFromSubscriberProfileTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('subscriber_profile', function(Blueprint $table)
		{
			$table->dropColumn('facebook_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('subscriber_profile', function(Blueprint $table)
		{
			$table->bigInteger('facebook_id');
		});
	}

}
