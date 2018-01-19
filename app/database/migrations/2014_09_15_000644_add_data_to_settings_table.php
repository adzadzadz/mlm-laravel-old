<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDataToSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Eloquent::unguard();
		$settings = Settings::create(array(
		  'group' => 'User',
		  'data'  => serialize(
		  	array(
		  		array(
				  	'callbackname' => 'withdraw_min_amount_limit',
				  	'name'   => 'Minimum Withdrawal Limit',
				  	'value'  => 250,
				  	'nodelete' => true,
				 ),
		  	)),
		  'status' => true,
		));
		$settings = Settings::create(array(
		  'group' => 'System',
		  'data' => serialize(array()),
		  'status' => true,
		));
		$settings = Settings::create(array(
		  'group' => 'Permissions',
		  'data' => serialize(array()),
		  'status' => true,
		));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		
	}

}
