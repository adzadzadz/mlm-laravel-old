<?php

class CodesController extends BaseController {

	public function shoCodesgenerator()
	{
		$codes_list = Codes::getCodes();

		return View::make('modules.codesgenerator', array(
			'codes' 	 => $codes_list,
		))->render();
	}

	public function checkMastercode()
	{
		$im_master = 0;
		$result = Codes::getCode(Input::get('activationcode'));

		$im_master = $result['im_master'];

		return $im_master;
	}

	public function generateCode() 
	{
		$data = array();
		$result = '';

		$user = User::find(Auth::user()->id);
		$count = $user->codecount;
		$count_master = $user->codecount_master;

		if(($count < 1) && ($count_master < 1))
		{
			return 'Please order codes to generate.';
			exit;
		}

		if($count > 0)
		{
			for ($i=0; $i < $count; $i++) { 

				$data['activationcode'] = Crypt::encrypt(str_random(20));
				$data['membertype'] = Input::get('membertype');
				$data['status'] = 0;
				$data['im_master'] = 0;
				$data['sponsor'] = Auth::user()->id;
				$result = $result + Codes::makeCode($data);	
				$user->codecount = $user->codecount - 1;
				$user->save();
				
			}
		}

		if($count_master > 0)
		{
			for ($master_codes=0; $master_codes < $count_master; $master_codes++) { 

				$data['activationcode'] = Crypt::encrypt(str_random(20));
				$data['membertype'] = Input::get('membertype');
				$data['status'] = 0;
				$data['im_master'] = 1;
				$data['sponsor'] = Auth::user()->id;
				$result = $result + Codes::makeCode($data);	
				$user->codecount_master = $user->codecount_master - 1;
				$user->save();
				
			}
		}

		

		// Mail::send('emails.codes', $data, function($message)
		// {
		// 	$message->from('admin@adzbite.com', 'Adzbite Solutions');
		//     $message->to(Auth::user()->email, Auth::user()->firstname . " " . Auth::user()->middlename . " " . Auth::user()->lastname)->subject('Registration Codes');
		// });

		return $count . " activation codes added.";
	}

	public function showCodes()
	{
		$result = Codes::getCodes();
		return json_encode($result);
	}

	// Model -> Codes_user_limit.php
	public function allocateCodes()
	{
		$id = Input::get('id');
		$count = Input::get('count');
		$allocated_by = Auth::user()->id;

		$data_history = array(
			'item'        => 'Registration Code',
			'quantity'    => $count,
			'executed_by' => $allocated_by,
			'executed_for'=> $id,
		);
		$user = User::getUser($id);

		$data_user = array(
			'codecount'   => $count + $user->codecount,
		);

		$result_history = "";

		$allocate = User::updateUser($id, $data_user);
		return  $count . " " . $data_history['item'] . " added.<br>" . History::addItem($data_history);
	}

	public function allocateCodes_master()
	{
		$id = Input::get('id');
		$count = Input::get('count');
		$allocated_by = Auth::user()->id;

		$data_history = array(
			'item'        => 'Registration Code - Master Accounts',
			'quantity'    => $count,
			'executed_by' => $allocated_by,
			'executed_for'=> $id,
		);

		$user = User::getUser($id);

		$data_user = array(
			'codecount_master'   => $count + $user->codecount_master,
		);

		$result_history = "";
		$allocate = User::updateUser($id, $data_user);
		return  $count . " " . $data_history['item'] . " added.<br>" . History::addItem($data_history);
	}

	public function getAllocations_master()
	{
		return json_encode(History::getCodeallocations_master(10));
	}

	public function getAllocations()
	{
		return json_encode(History::getCodeallocations(10));
	}

}
