<?php

class Withdraw extends Eloquent {

	protected $table = 'withdraw';

	public static function getRequestsfrom($id)
	{
		$request = Withdraw::where('executed_by', '=', $id)->get();

		return $request;
	}

	public static function getRequests($id)
	{
		$request = Withdraw::where('user_id', '=', $id)->get();

		return $request;
	}

	public static function getRequestvalue($id)
	{
		$request = Withdraw::where('user_id', '=', $id)->pluck('request');

		return $request;
	}

	public static function addRequest($data)
	{
		$withdraw = new Withdraw;

		foreach ($data as $key => $value) {
			$withdraw->$key = $value;
		}
		
		$withdraw->save();

		return array(
			'user_id'        => $data['user_id'],
			'username'  => DB::table('users')->where('id', '=', $data['user_id'])->pluck('username'),
			'request'   => $data['request'],
			'gateway'   => $data['gateway'],
			'status'    => '<i class="fa fa-check-square-o"></i>',
		);
	}

	public static function updateStatus($data)
	{
		$user = User::find(1);

		foreach ($data as $key => $value) {
			$withdraw->$key = $value;
		}
		
		$user->save();

		return 'Request has been updated';
	}

}