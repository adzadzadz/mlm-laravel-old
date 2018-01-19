<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public static function addUser($data) 
	{	
		$user = new User;

		foreach ($data as $key => $value) {
			$user->$key = $value;
		}
		
		$user->save();

		return 'The account has been registered.';
	}

	public static function checkPosition($id)
	{
		$position = DB::table('users')->where('directupline', '=', $id)->max('position');

		return $position;
	}

	public static function countUserdownline($id)
	{
		$position = DB::table('users')->where('directupline', '=', $id)->get();

		return count($position);
	}

	public static function findUser($keyword)
	{
		$users = User::where('votes', '>', 100)->take(10)->get();
	}

	public static function getUser($id)
	{
		return User::find($id);
	}

	public static function updateUser($id, $data)
	{
		$user = User::find($id);

		foreach ($data as $key => $value) {
			$user->$key = $value;
		}

		return $user->save();
	}

	public static function getUsers()
	{
		$data = array();

		$users = User::all();
		foreach ($users as $user) {
			$data[] = array(
				'id'      => $user['id'],
				'username'=> $user['username'],
				'name'    => $user['firstname'] . " " . $user['middlename'] . " " . $user['lastname'],
				'email'   => $user['email'],
			);
		}

		return $data;
	}

	public static function getMasteraccounts()
	{
		$data = array();

		$users = User::where('im_master', '=', 1)->get();
		foreach ($users as $user) {
			$data[] = array(
				'id'      => $user['id'],
				'username'=> $user['username'],
				'name'    => $user['firstname'] . " " . $user['middlename'] . " " . $user['lastname'],
				'email'   => $user['email'],
			);
		}

		return $data;
	}

	public static function getChildrenUsers($id)
	{
		$users = User::where('master_account', '=', $id)->get();

		return $users;
	}

	public static function getDownline($id, $position)
	{
		$downline = User::where('directupline', '=', $id)->where('position', '=', $position)->get();

		return $downline;
	}

	// This is the Unilevel downline
	public static function getUnilevel($id)
	{
		$downline = User::where('sponsor', '=', $id)->get();

		return $downline;
	}

	public static function getCnsstatement($id)
	{
		$downline = User::where('directupline', '=', $id)->get();

		return $downline;
	}

	public static function login($data)
	{
		if (Auth::attempt($data, false))
		{	
			return true;
		}
		else
		{
			return false;
		}
	}

	public static function logout()
	{
		Auth::logout();
		Session::flush();
	}

	public static function getCount()
	{
		$count = DB::table('codes_user_limit')
					->where('id', '=', Auth::user()->id)
                    ->get();

        return $count;
	}
	
}