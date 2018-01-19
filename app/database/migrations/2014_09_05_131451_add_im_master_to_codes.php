<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImMasterToCodes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('codes', function(Blueprint $table)
		{
			$table->boolean('im_master')->default('0')->after('membertype');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('codes', function(Blueprint $table)
		{
			//
		});
	}

}
