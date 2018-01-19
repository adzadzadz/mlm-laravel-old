<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		$user = User::create(array(
		  'username' => 'pax',
		  'firstname' => 'Papo',
		  'lastname' => 'Saycon',
		  'email' => 'paposaycon@yahoo.com',
		  'password' => Hash::make('105612'),
		));
	}

}
