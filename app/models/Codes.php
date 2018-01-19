<?php

class Codes extends Eloquent {

	protected $table = 'codes';

	public static function makeCode($data) 
	{

		$codes = new Codes;

		foreach ($data as $key => $value) {
			$codes->$key = $value;
		}

		$codes->save();

		return 1;

	}

	public static function getCode($codetofetch)
	{
		$codes = Codes::all();
		$info = array(
			'sponsor' => 'none',
			'membertype' => 'none',
			'im_master' =>'none',
			'code_id' => 'none',
		);
		foreach ($codes as $code) 
		{
			if(Crypt::decrypt($code['activationcode']) == $codetofetch)
			{	
				$info = array(
					'sponsor' => $code['sponsor'],
					'membertype' => $code['membertype'],
					'im_master' =>$code['im_master'],
					'code_id' => $code['id'],
				);
			}
		}

		return $info;
	}

	public static function getCodebysponsor($new = false, $master = false)
	{
		$id = Auth::user()->id;

		if ($master == false) 
		{	
			if($new == false)
			{
				$code = Codes::where('sponsor', '=', $id)->where('status', '!=', 1)->where('im_master', '=', 0)->orderBy('created_at', 'asc')->take(1)->get();
			}
			else
			{
				$code = Codes::where('sponsor', '=', $id)->where('status', '!=', 1)->where('im_master', '=', 0)->orderBy('created_at', 'desc')->take(1)->get();	
			}
		}
		else
		{
			if($new == false)
			{
				$code = Codes::where('sponsor', '=', $id)->where('status', '!=', 1)->where('im_master', '=', 1)->orderBy('created_at', 'asc')->take(1)->get();
			}
			else
			{
				$code = Codes::where('sponsor', '=', $id)->where('status', '!=', 1)->where('im_master', '=', 1)->orderBy('created_at', 'desc')->take(1)->get();	
			}
		}

		return $code;
	}

	public static function countCode($master = false)
	{
		if ($master == false) 
		{
			$id = Auth::user()->id;
			$codes = count(Codes::where('sponsor', '=', $id)->where('status', '!=', 1)->where('im_master', '=', 0)->get());
		}
		if ($master == true) 
		{
			$id = Auth::user()->id;
			$codes = count(Codes::where('sponsor', '=', $id)->where('status', '!=', 1)->where('im_master', '=', 1)->get());
		}

		return $codes;
	}

	public static function getCodes()
	{
		$id = Auth::user()->id;
		$data = array();
		
		$codes = Codes::where('sponsor', '=', $id)->where('status', '!=', 1)->orderBy('id', 'desc')->get();

		foreach ($codes as $code) {
			$data[] = array(
				'membertype' => $code->im_master,
				'activationcode' => Crypt::decrypt($code->activationcode),
			);
		}
		return $data;
	}

	public static function validateCode($data)
	{
		$codetoverify = $data;
		$info = false;
		$codes = Codes::all();

		foreach ($codes as $code) 
		{
			if(Crypt::decrypt($code['activationcode']) == $codetoverify)
			{	
				$info[] = array(
					'sponsor' => $code['sponsor'],
					'membertype' => $code['membertype'],
					'code_id' => $code['id'],
					'im_master' => $code['im_master'],
				);
				if ($code['status'] == 1)
				{
					return false;
				}
			}
		}
		return $info;
	}

	public static function updateCode($data, $process)
	{
		$id = $data;

		if($process == 'used')
		{
			$codes = Codes::find($id);
			$codes->status = 1;
			$codes->save();
		}

		return 'Code updated';
	}
}