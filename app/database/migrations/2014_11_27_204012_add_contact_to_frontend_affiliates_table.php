<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddContactToFrontendAffiliatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('frontend_affiliates', function(Blueprint $table)
		{
			$table->string('contact')->after('description');
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('frontend_affiliates', function(Blueprint $table)
		{
			//
		});
	}

}
