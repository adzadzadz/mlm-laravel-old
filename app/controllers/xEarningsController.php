<?php

class EarningsController extends BaseController {

	public function test($id)
	{
			$earnings = Earnings::getUserEarning(Auth::user()->id)  * Config::get("mlm_config.account_value");
			$unilevelEarnings = Earnings::getUnilevelEarning(Auth::user()->id); 

			$total_earnings = $earnings + $unilevelEarnings;
			$data = array(
				'user_id' => $id,
				'earnings' => $total_earnings,
			);

			// $result = Earnings::addEarnings($data);
		return $earnings . ' + ' . $unilevelEarnings . ' = ' . $total_earnings; 
	}

	public function updateUserearnings($id)
	{
		$earnings = 0;
		$earnings_last_update = Earnings::checkLastupdate($id);
		
		$dateFromDatabase = strtotime($earnings_last_update);
		$dateTwelveHoursAgo = strtotime("-600 seconds");

		$user = User::find($id);
		$username = $user->username;

		$message = '';

		if ($dateFromDatabase >= $dateTwelveHoursAgo) // less than 12 hours ago
		{
		    
		}
		else // more than 12 hours ago
		{
			$earnings = Earnings::getUserEarning($id); 
			$unilevelEarnings = Earnings::getUnilevelEarning($id); 

			$total_earnings = $earnings + $unilevelEarnings;
			$data = array(
				'user_id' => $id,
				'earnings' => $total_earnings,
			);

			$result = Earnings::addEarnings($data);
			
			if($result == 1)
			{
				$message = $username . '\'s earnings has been updated.&#13;&#10;';
			}
			else
			{
				$message = 'There seems to be an error.&#13;&#10;';
			}
		}

		return $message;
	}

	public function updateTotalearnings()
	{
		$earnings = 0;
		
		if (Auth::check()) 
		{ 
			$sum = 0;
			$earnings = Earnings::getUserEarning(Auth::user()->id);
			$unilevelEarnings = Earnings::getUnilevelEarning(Auth::user()->id); 

			$total_earnings = $earnings + $unilevelEarnings;
			$data = array(
				'user_id' => Auth::user()->id,
				'earnings' => $total_earnings,
			);
			$result = Earnings::addEarnings($data);

			$childrenaccounts = User::getChildrenUsers(Auth::user()->id);

			$sum = (int)Earnings::getAvailablebalance(Auth::user()->id); //ADD ALL EARNINGS STARTING SELF

			foreach ($childrenaccounts as $account) 
			{
				$earnings = (int)Earnings::getUserEarning($account['id']);
				$data = array(
					'user_id' => $account['id'],
					'earnings' => $earnings,
				);
				$result = Earnings::addEarnings($data);

				$sum = $sum + Earnings::getAvailablebalance($account['id']); //CONTINUE ADDING CHILDREN ACCOUNT'S EARNINGS
			}				
		}

		return $sum;

	}

	public function requestWithdrawaleach()
	{
		$earnings = (int)Earnings::getAvailablebalance(Input::get('user_id'));

		if($earnings > 0) 
		{
			$data = array(
				'user_id'  => Input::get('user_id'),
				'request'  => $earnings,
				'gateway'  => Input::get('gateway'),
				'executed_by' => Auth::user()->id,
				'status'   => 'Pending',
			);

			return json_encode(Withdraw::addRequest($data));
		}
		else
		{
			return json_encode(array(
				'user_id'  => Input::get('user_id'),
				'username' => DB::table('users')->where('id', '=', Input::get('user_id'))->pluck('username'),
				'request'  => 'Nothing to withdraw',
				'gateway'  => Input::get('gateway'),
				'status'   => '<i class="fa fa-times"></i>',
			));
		}
	}

	public function requestWithdrawal()
	{
		$income = 0;
		$withdraw_min_limit = Settings::getSpecificsetting('User', 'withdraw_min_amount_limit');
		$income = $income + Earnings::getAvailablebalance(Auth::user()->id);

		if(Auth::user()->im_master == true) 
		{
			$childrenaccounts = User::getChildrenUsers(Auth::user()->id);

			foreach ($childrenaccounts as $account) 
			{	
				$income = $income + Earnings::getAvailablebalance($account['id']);
			}

			if($withdraw_min_limit > $income)
			{
				return 'Don\'t Push It BRAAAH! You need at least ' . $withdraw_min_limit . ' to withdraw.';
			}
		}

		if($income == 0)
		{
			return 'Whoops! You do not have any balance to withdraw.'; exit;
		}

		$earnings = (int)Earnings::getAvailablebalance(Auth::user()->id);

			if (Input::get('request') == 'all')
			{
				$data = array(
					'user_id' => Auth::user()->id,
					'request' => $earnings,
					'gateway' => Input::get('gateway'),
					'executed_by' => Auth::user()->id,
					'status'  => 'Pending',
				);

				$requester_data = array(
					'user_id' => Auth::user()->id,
				);
				
				if($earnings > 0) 
				{
					$self = Withdraw::addRequest($data);
					$requester = WithdrawRequestedBy::addRequester($requester_data);
				}
				else
				{
					$self = array(
						'user_id'  => Auth::user()->id,
						'username' => DB::table('users')->where('id', '=', Auth::user()->id)->pluck('username'),
						'request'  => 'Nothing to withdraw',
						'gateway' => Input::get('gateway'),
						'status'   => '<i class="fa fa-times"></i>',
					);
				}
				
				return View::make('modules.each_requestwithdrawal', array(
					'self'             => $self,
					'childrenaccounts' => User::getChildrenUsers(Auth::user()->id),
				))->render(); exit;
			}
			else
			{
				if (Input::get('request') > $income) 
				{
					return 'The request is larger than your actual Income.'; exit;
				}
				if (Input::get('request') <= $income)
				{
					return 'We only allow full withdrawal for now.'; exit;
				}
			}
		
	}

}
