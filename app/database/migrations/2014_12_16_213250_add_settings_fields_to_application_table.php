<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSettingsFieldsToApplicationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('application', function(Blueprint $table)
		{
			$table->string('ios_certificate');
			$table->string('ios_password');
			$table->string('android_api_key');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('application', function(Blueprint $table)
		{
			$table->dropColumn('ios_certificate');
			$table->dropColumn('ios_password');
			$table->dropColumn('android_api_key');
		});
	}

}
