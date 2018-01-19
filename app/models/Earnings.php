<?php

class Earnings extends Eloquent {

	protected $table = 'earnings';

	public static function checkLastupdate($id)
	{
		$updated_at = Earnings::where('user_id', '=', $id)->pluck('updated_at');

		return $updated_at;
	} 

	public static function getAvailablebalance($id)
	{	
		$total_requests = 0;
	    $earnings = Earnings::getEarnings($id);
	    $withdrew = Withdraw::getRequests($id);

	    foreach ($withdrew as $each) {
	    	$total_requests = $total_requests + $each['request'];
	    }

	    $balance = $earnings - $total_requests;

	    return $balance;
	}

	public static function getEarnings($id)
	{
		$earnings = Earnings::where('user_id', '=', $id)->pluck('earnings');

		return $earnings;
	}

	public static function getUserEarning($id)
	{	
		$earnings = 0;
		$master = User::find($id);

		$lvl['0']['0'] = array(
			'id' => $master->id,
		);

		for ($level=0; $level < 30; $level++) { 
			
			if (isset($lvl[$level])) 
			{
				if ($level > 1) 
				{
					$prevcount = count($lvl[$level]);
				}
				else if ($level == 0) 
				{
					$prevcount = 1;
				}
				else if ($level == 1) 
				{
					$prevcount = count($lvl[$level]);
				}
			}
			
			for ($group=0; $group < $prevcount; $group++) { 
				
				$makelevel = $level + 1;

				if (isset($lvl[$level])) 
				{
					$user = User::getCnsstatement($lvl[$level][$group]['id']);

					foreach ($user as $data) {
						$lvl[$makelevel][] = array(
							'id' => $data->id,
						);
					}

					$earnings = $earnings + Config::get("mlm_config.account_value_lvl_$level");

				}
				else
				{
					$level = 30;
				}
			}
		}

		return $earnings;
	}

	public static function getUnilevelEarning($id)
	{
		$total_earnings = 0;
		$totalVp = 0;
		$count = 0;
		$levelLimit = 9;

		$master = User::find($id);
		$total_members = -1;
		$total_earnings = $total_earnings + 0;

		$lvl['0']['0'] = array(
			'id'        => $master->id,
			'vp'        => $master->vp,
		);

		for ($level=0; $level < $levelLimit; $level++) { 
			
			if (isset($lvl[$level])) 
			{
				if ($level > 1) 
				{
					$prevcount = count($lvl[$level]);
				}
				else if ($level == 0) 
				{
					$prevcount = 1;
				}
				else if ($level == 1) 
				{
					$prevcount = count($lvl[$level]);
				}
			}
			
			for ($group=0; $group < $prevcount; $group++) { 
				
				$makelevel = $level + 1;

				if (isset($lvl[$level])) 
				{
					$user = User::getUnilevel($lvl[$level][$group]['id']);
					
					foreach ($user as $data) {

						$earnings = 0;
						$lvlfixfifference = 1;
						if ($makelevel == 1) {
							$earnings = $data->vp;
							$total_earnings = $total_earnings + $earnings;
						} elseif ($makelevel > 1-$lvlfixfifference && $makelevel <= 4) {
							$earnings = $data->vp * .5;
							$total_earnings = $total_earnings + $earnings;
						} elseif ($makelevel > 4-$lvlfixfifference && $makelevel <= 8) {
							$earnings = $data->vp * .25;
							$total_earnings = $total_earnings + $earnings;
						}

						$totalVp = $totalVp + $data->vp;

						$lvl[$makelevel][] = array(
							'id'        => $data->id,
							'vp'        => $data->vp,
						);

					}

					$total_members = $total_members + 1;
				}
				else
				{
					$level = 30;
				}
			}
		}

		return $total_earnings;

	}

	public static function addEarnings($data)
	{
		$id = $data['user_id'];
		$earnings = $data['earnings'];

		$check_user = DB::table('earnings')->where('user_id', '=', $id)->get();
		
		$newcount = 0;

		foreach ($check_user as $each) {
			$newcount = $each->updatecount + 1;
			$earnings_id = $each->id;
		}		

		if(count($check_user) > 0)
		{
			$find_earnings = Earnings::find($earnings_id);

			$find_earnings->earnings = $earnings;
			$find_earnings->updatecount = $newcount;
			$find_earnings->save();

			$result = 1;
		}
		else
		{
			$earnings = new Earnings;

			foreach ($data as $key => $value) {
				$earnings->$key = $value;
			}
			
			$earnings->save();

			$result = 1;
		}

		return $result;
	}

}