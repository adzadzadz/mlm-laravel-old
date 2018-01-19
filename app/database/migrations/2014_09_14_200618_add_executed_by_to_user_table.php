<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExecutedByToUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('withdraw', function(Blueprint $table)
		{
			$table->string('executed_by')->after('gateway');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('withdraw', function(Blueprint $table)
		{
			$table->string('executed_by')->after('gateway');
		});
	}

}
