<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWithdrawTableWithdrawalReplaced extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::dropIfExists('withdrawal');
		Schema::create('withdraw', function(Blueprint $table)
		{
			$table->increments('id');
			$table->double('user_id')->references('id')->on('users');
			$table->double('request');
			$table->string('status');
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
		Schema::drop('withdraw');
	}

}
