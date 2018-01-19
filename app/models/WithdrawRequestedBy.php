<?php

class WithdrawRequestedBy extends Eloquent {

	protected $table = 'withdraw_requested_by';

	public static function getUserrequest($id)
	{
		$request = Withdraw::where('user_id', '=', $id)->get();

		return $request;
	}

	public static function getAllrequesters()
	{
		$request = WithdrawRequestedBy::all();

		return $request;
	}

	public static function addRequester($data)
	{
		$requesters = new WithdrawRequestedBy;

		foreach ($data as $key => $value) {
			$requesters->$key = $value;
		}
		
		$requesters->save();

		return 1;
	}
}