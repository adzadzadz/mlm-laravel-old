<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('users')){
			Schema::create('users', function(Blueprint $table)
			{
				$table->increments('id');
			    $table->string('username');
			    $table->unique('username');
			    $table->string('membertype');
			    $table->string('email');
			    $table->string('password');
			    $table->string('firstname', 50);
			    $table->string('middlename', 50);
			    $table->string('lastname', 50);
			    $table->string('sex', 1);
			    $table->string('civilstatus');
			    $table->date('birthdate');
			    $table->integer('directupline');
			    $table->integer('position');
			    $table->integer('sponsor');
			    $table->integer('pointvalue');
			    $table->integer('codecount');
			    $table->integer('registeredby');
			    $table->string('active');
			    $table->string('remember_token', 100);
			    $table->timestamps();
			});
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
