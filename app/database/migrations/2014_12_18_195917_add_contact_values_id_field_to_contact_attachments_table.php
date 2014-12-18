<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddContactValuesIdFieldToContactAttachmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('contact_attachments', function(Blueprint $table)
		{
			$table->integer('contact_values_id')->unsigned();
			$table->foreign('contact_values_id')
					->references('id')
					->on('contact_values')
					->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('contact_attachments', function(Blueprint $table)
		{
			$table->dropColumn('contact_values_id');
		});
	}

}
