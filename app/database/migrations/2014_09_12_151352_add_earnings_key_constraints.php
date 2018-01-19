<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEarningsKeyConstraints extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::dropIfExists('earnings');
		Schema::create('earnings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->double('user_id')->references('id')->on('users');
			$table->double('earnings');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('earnings');
	}

}
