<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNestedFieldsToNewsCategoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('news_category', function(Blueprint $table)
		{
			$table->integer('parent_id')->nullable()->index()->before('created_at');
		    $table->integer('lft')->nullable()->index()->before('created_at');
		    $table->integer('rgt')->nullable()->index()->before('created_at');
		    $table->integer('depth')->nullable()->before('created_at');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('news_category', function(Blueprint $table)
		{
			$table->dropColumn('parent_id');
			$table->dropColumn('lft');
			$table->dropColumn('rgt');
			$table->dropColumn('depth');
		});
	}

}
