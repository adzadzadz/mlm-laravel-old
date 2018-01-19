<?php

class AccountController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Account Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'AccountController@showRegister');
	|
	*/


	

	
	public function showProfile()
	{

		$me = User::find(Auth::user()->id);

		$bankinformation = unserialize($me->bankinformation);

		$withdrawal_requests = 0;
		$total_amount = 0;
		$requests_by_group = array(
			'id'       => null,
			'username' => null,
			'name'     => null,
			'last_update' => null,
			'status'   => null,
			'group'    => null,
		);
		$last_update = null;
		$request_status = null;
		$gateway = '';

		$requester = WithdrawRequestedBy::getUserrequest(Auth::user()->id);

		foreach ($requester as $my_request) 
		{
			$last_update = $my_request->updated_at;
			$request_status = $my_request->status;
		}
		
		$requests_by_group = array( 
			'id'       => Auth::user()->id,
			'username' => DB::table('users')->where('id', '=', Auth::user()->id)->pluck('username'),
			'name'     => DB::table('users')->where('id', '=', Auth::user()->id)->pluck('firstname') . ' ' . DB::table('users')->where('id', '=', Auth::user()->id)->pluck('lastname'),
			'last_update' => $last_update,
			'status'   => $request_status,
			'group'    => Withdraw::getRequestsfrom(Auth::user()->id),
		);
	
		foreach ($requests_by_group['group'] as $each) 
		{
			$total_amount = $total_amount + $each['request'];
			$gateway = $each['gateway'];
		}


		return View::make('account/profile', array(
			'page_title' => 'Profile',
			'me'         => $me,
			'my_gateway' => $bankinformation,
			'requests_by_group'    => $requests_by_group,
			'total_amount'         => $total_amount,
			'gateway'              => $gateway,
		));
	}

	public function showRegister()
	{
		$master_accounts = User::getMasteraccounts();

		$result = Codes::getCode(Input::get('activationcode'));

		return View::make('account/register', array(
			'activationcode'  => Input::get('activationcode'),
			'im_master'       => $result['im_master'],
			'master_accounts' => $master_accounts,			
		))->render();
	}

	public function addUser() 
	{	
		//PREPARING AND VALIDATING DATA FOR ENTRY
		$data_validator = Validator::make(
		    array(
		    	'username'  => Input::get('username'),
		        'firstname' =>  Input::get('firstname'),
		        'lastname'  => Input::get('lastname'),
		        'password'  => Input::get('password'),
		        // 'email'     => Input::get('username'), //Temporary - need to change to email
		        'directupline' => Input::get('direct_upline'),
				'sponsor'   => Input::get('sponsor'),
		    ),
		    array(
		        'username'  => 'required|min:3|unique:users,username',
		        'firstname' => 'required|min:2',
		        'lastname'  => 'required|min:2',
		        'password'  => 'required|min:5',
		        // 'email'     => 'required|email|unique:users',
		        'directupline' => 'required',
		        'sponsor'   => 'required',
		    )
		);

		if ($data_validator->fails())
		{
		    $messages = $data_validator->messages();
		    $error = '';
		    foreach ($messages->all() as $message)
			{
			    $error .= $message . '<br>';
			}
			return $error;
			exit;
		}
		
		// Code validation
		$codevalidation = Codes::validateCode(Input::get('activationcode'));

		if($codevalidation != false){

			foreach ($codevalidation as $codeinfo) {
				$membertype = $codeinfo['membertype'];
				$im_master  = $codeinfo['im_master'];
				$sponsor_id = $codeinfo['sponsor'];
				$code_id    = $codeinfo['code_id'];
			}

			$codedata = array(
				'status' => 1,
			);

			$position = (int)User::checkPosition(Input::get('direct_upline'));

			if ($position >= 2) {
				return 'Direct Upline(' .  Config::get('mlm_config.id_prefix') . Input::get('direct_upline') . ') already has the "left" and "right" member. Please select a different upline.';
				exit;
			}
			if ($position < 2) {
				$position = $position + 1;
			}

			$bankinformation = array(
				'b_bank'      => Input::get('b_bank'),
				'bankname'    => Input::get('bankname'),
				'bankaccount' => Input::get('bankaccount'),
				'b_palawan'   => Input::get('b_palawan'),
				'b_western'   => Input::get('b_western'),
			);

			$userdata = array(
				'membertype'=> $membertype,
				'master_account' => Input::get('master_account'),
				'username'  => Input::get('username'),
				'firstname' => Input::get('firstname'),
				'lastname'  => Input::get('lastname'),
				'email'     => Input::get('username'), //Temporary - need to change to email
				'password'  => Hash::make(Input::get('password')),
				'directupline' => Input::get('direct_upline'),
				'sponsor'   => Input::get('sponsor'),
				'position'  => $position,
				'phonenumber' => Input::get('phonenumber'),
				'im_master' => $im_master,
				'regcode_used' => Input::get('activationcode'),
				'bankinformation' => serialize($bankinformation), // $string_to_array = unserialize($column_array);
			);


			$codeupdate = Codes::updateCode($code_id, 'used');
			$result = User::addUser($userdata);

			return $result;
		}
		else {
			return 'Code entered is Unknown or Already used.';
		}
	}

	public function updateProfile()
	{
		$field = Input::get('field');

		if ($field == 'common') {
			
			$bankinformation = array(
				'b_bank'      => Input::get('b_bank'),
				'bankname'    => Input::get('bankname'),
				'bankaccount' => Input::get('bankaccount'),
				'b_palawan'   => Input::get('b_palawan'),
				'b_western'   => Input::get('b_western'),
			);

			$userdata = array(
				'master_account' => Input::get('master_account'),
				'username' => Input::get('username'),
				'firstname' => Input::get('firstname'),
				'middlename' => Input::get('middlename'),
				'lastname' => Input::get('lastname'),
				'phonenumber' => Input::get('phonenumber'),
				'sex' => Input::get('sex'),
				'bankinformation' => serialize($bankinformation), // $string_to_array = unserialize($column_array);
			);

			$input['username'] = Input::get('username');

			// Must not already exist in the `email` column of `users` table

			$rules = array('username' => 'unique:users,username');

			$validator = Validator::make($input, $rules);


			if (Input::get('username') != Auth::user()->username) {
				if ($validator->fails()) 
				{
				    return 'Username already exists.';
				    exit;
				}
			}			
			return json_encode(User::updateUser(Auth::user()->id, $userdata));
			exit;
		}
		if($field == 'password')
		{
			if (Hash::check(Input::get('currentpassword'), Auth::user()->password))
			{
			   $userdata = array('password' => Hash::make(Input::get('newpassword')));
			   return json_encode(User::updateUser(Auth::user()->id, $userdata));
			   exit;
			}
			else
			{
				return 'Current Password is Invalid';
				exit;
			}
		}
	}
	public function findUsers()
	{
		
	}
	
	public function getUsers()
	{
		return json_encode(User::getUsers());
	}
	
	public function showChildrenaccounts()
	{	
		if (Auth::check()) 
		{
			$total_earnings = 0;
			$total_withdrew = 0;
			$children_accounts = User::getChildrenUsers(Auth::user()->id);
			
			foreach ($children_accounts as $child) {
				$total_earnings = $total_earnings + Earnings::getEarnings($child['id']);	
				$total_withdrew = $total_withdrew + Withdraw::getRequestvalue($child['id']);
			}

			return View::make('modules.childrenaccountslist', array(
				'children_accounts' => $children_accounts,
				'total_earnings'	=> $total_earnings,
				'total_withdrew'    => $total_withdrew,
 			))->render();;
		}
		else
		{
			return Redirect::to('/')->with('message', 'You need to login.');
		}
	}

	public function login()
	{
		$userdata1 = array(
			'username' => Input::get('username'),
			'password' => Input::get('password'),
		);
		$userdata2 = array(
			'email' => Input::get('username'),
			'password' => Input::get('password'),
		);
		
		if (User::login($userdata1))
		{
			return 'verified';
		}
		else
		{
			if (User::login($userdata2))
			{
				return 'verified';
			}
			else
			{
				return 'Either your Username/Email or password is incorrect.';				
			}

		}		
	}

	public function logout()
	{	
		User::logout();
		Session::flush();

		return Redirect::to('/')->with('message', 'You are logged out.');
	}

}
