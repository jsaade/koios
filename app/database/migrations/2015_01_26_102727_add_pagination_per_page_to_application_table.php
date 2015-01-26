<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaginationPerPageToApplicationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('application', function(Blueprint $table)
		{
			$table->integer("pagination_per_page");
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
			$table->dropColumn('pagination_per_page');
		});
	}

}
