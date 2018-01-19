<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGatewayToUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('withdraw', function(Blueprint $table)
		{
			$table->string('gateway')->after('request');
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
			$table->string('gateway')->after('request');
		});
	}

}
