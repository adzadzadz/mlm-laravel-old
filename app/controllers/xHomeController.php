<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showHome');
	|
	*/

	public function showHome()
	{	
		$view = View::make('account.guest', array( 'page_title' => 'Home'));

		if (Auth::check()) 
		{
			$direct_upline_count = User::where('sponsor', '=', Auth::user()->id)->count();

			$me = User::find(Auth::user()->id);
		    $bankinfo = unserialize($me->bankinformation);
		    $withdraw_min_limit = Settings::getSpecificsetting('User', 'withdraw_min_amount_limit');

			$membertype = Auth::user()->membertype; 

			if($membertype == 'superuser')
			{	
				$users = User::getUsers();

				$earnings = 0;
				$income = 0;

				if(Auth::user()->im_master == true) 
				{
					$childrenaccounts = User::getChildrenUsers(Auth::user()->id);

					$income = $income + Earnings::getAvailablebalance(Auth::user()->id);
					foreach ($childrenaccounts as $account) 
					{	
						$income = $income + Earnings::getAvailablebalance($account['id']);
					}
				}

				$view = View::make('account.superuser', array( 
					'user_list_set'   => $users,
					'page_title'      => 'Home',
					'earnings'        => $income,
					'bankinfo'        => $bankinfo,
					'withdraw_min_limit' => $withdraw_min_limit,
					'direct_upline_count' => $direct_upline_count,
				));
			}
			elseif ($membertype == 'admin') 
			{	
				return View::make('account.admin');
			}
			else
			{
				// MASTER ACCOUNT EARNINGS
				$earnings = 0;
				$income = 0;
				$income = $income + Earnings::getAvailablebalance(Auth::user()->id);
				if(Auth::user()->im_master == true) 
				{
					$childrenaccounts = User::getChildrenUsers(Auth::user()->id);

					foreach ($childrenaccounts as $account) 
					{	
						$income = $income + Earnings::getAvailablebalance($account['id']);
					}
				}

				$view = View::make('account.member', array(
					'page_title' => 'Home',
					'earnings' => $income,
					'bankinfo' => $bankinfo,
					'withdraw_min_limit' => $withdraw_min_limit,
					'direct_upline_count' => $direct_upline_count,
				));
			}
		}

		return $view;

	}


}
