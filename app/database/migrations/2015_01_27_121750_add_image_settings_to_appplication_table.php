<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageSettingsToAppplicationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('application', function(Blueprint $table)
		{
			$table->string('news_resize_width');
			$table->string('news_resize_height');
			$table->string('news_crop_width');
			$table->string('news_crop_height');
			$table->string('question_resize_width');
			$table->string('question_resize_height');
			$table->string('question_crop_width');
			$table->string('question_crop_height');
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
			$table->dropColumn('news_resize_width');
			$table->dropColumn('news_resize_height');
			$table->dropColumn('news_crop_width');
			$table->dropColumn('news_crop_height');
			$table->dropColumn('question_resize_width');
			$table->dropColumn('question_resize_height');
			$table->dropColumn('question_crop_width');
			$table->dropColumn('question_crop_height');
		});
	}

}
