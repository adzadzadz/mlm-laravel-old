<?php

class MembertreeController extends BaseController {

	public function getCnsstatement($id)
	{
		$count = 0;
		if (Auth::check()) 
		{ 
			$master = User::find($id);
			$total_members = -1;

			$lvl['0']['0'] = array(
				'id'        => $master->id,
				'username'  => $master->username,
				'firstname' => $master->firstname,
				'middlename'=> $master->middlename,
				'lastname'  => $master->lastname,
				'pointvalue'=> $master->pointvalue,
				'sponsor'   => $master->sponsor,
				'directupline' => $master->directupline,
			);

			for ($level=0; $level < 15; $level++) { 
				
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
								'id'        => $data->id,
								'username'  => $data->username,
								'firstname' => $data->firstname,
								'middlename'=> $data->middlename,
								'lastname'  => $data->lastname,
								'pointvalue'=> $data->pointvalue,
								'sponsor'   => $data->sponsor,
								'directupline' => $data->directupline,
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

			$withdrew = Withdraw::getRequests(Auth::user()->id);
			$total_withdrew = 0;
		    foreach ($withdrew as $each) {
		    	$total_withdrew = $total_withdrew + $each['request'];
		    }

			return View::make('modules.cnsstatement', array( 
				'lvl'      => $lvl,
				'limit'    => 31,
				'currency' => 'PhP',
				'withdrew' => $total_withdrew,
				'earnings' => Earnings::getEarnings(Auth::user()->id),
				'total_members' => $total_members,
			))->render();
		}
		else
		{
			return View::make('errors.requiredlogin', array(
				'message' => 'You need to login to view this page.',
			))->render();
		}
	}

	public function getUnilevel($id)
	{
		if (Auth::check()) 
		{ 
			$count = 0;
			$levelLimit = 8;
			if (Auth::check()) 
			{ 
				$master = User::find($id);
				$total_members = -1;

				$lvl['0']['0'] = array(
					'id'        => $master->id,
					'username'  => $master->username,
					'firstname' => $master->firstname,
					'middlename'=> $master->middlename,
					'lastname'  => $master->lastname,
					'vp'        => $master->vp,
					'sponsor'   => $master->sponsor,
					'directupline' => $master->directupline,
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
								$lvl[$makelevel][] = array(
									'id'        => $data->id,
									'username'  => $data->username,
									'firstname' => $data->firstname,
									'middlename'=> $data->middlename,
									'lastname'  => $data->lastname,
									'vp'        => $data->vp,
									'sponsor'   => $data->sponsor,
									'directupline' => $data->directupline,
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

				$withdrew = Withdraw::getRequests(Auth::user()->id);
				$total_withdrew = 0;
			    foreach ($withdrew as $each) {
			    	$total_withdrew = $total_withdrew + $each['request'];
			    }

				return View::make('modules.unilevel', array( 
					'lvl'      => $lvl,
					'limit'    => 31,
					'currency' => 'PhP',
					'withdrew' => $total_withdrew,
					'earnings' => $total_members,
					'total_members' => $total_members,
				))->render();
			}
			else
			{
				return View::make('errors.requiredlogin', array(
					'message' => 'You need to login to view this page.',
				))->render();
			}
		}
		else
		{
			return Redirect::to('/')->with('message', 'You need to login.');
		}
	}

	public function getUnilevelStatement($id)
	{
		if (Auth::check()) 
		{ 
			$total_earnings = 0;
			$totalVp = 0;
			$count = 0;
			$levelLimit = 9;
			if (Auth::check()) 
			{ 
				$master = User::find($id);
				$total_members = -1;
				$total_earnings = $total_earnings + 0;

				$lvl['0']['0'] = array(
					'id'        => $master->id,
					'username'  => $master->username,
					'firstname' => $master->firstname,
					'middlename'=> $master->middlename,
					'lastname'  => $master->lastname,
					'vp'        => $master->vp,
					'earnings'  => 0,
					'sponsor'   => $master->sponsor,
					'directupline' => $master->directupline,
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
									$earnings = $data->vp*10;
									$total_earnings = $total_earnings + $earnings;
								} elseif ($makelevel > 1-$lvlfixfifference && $makelevel <= 2) {
									$earnings = $data->vp * 5;
									$total_earnings = $total_earnings + $earnings;
								} elseif ($makelevel > 2-$lvlfixfifference && $makelevel <= 5) {
									$earnings = $data->vp * 3;
									$total_earnings = $total_earnings + $earnings;
								}

								$totalVp = $totalVp + $data->vp;

								$lvl[$makelevel][] = array(
									'id'        => $data->id,
									'username'  => $data->username,
									'firstname' => $data->firstname,
									'middlename'=> $data->middlename,
									'lastname'  => $data->lastname,
									'vp'        => $data->vp,
									'earnings'  => $earnings,
									'sponsor'   => $data->sponsor,
									'directupline' => $data->directupline,
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

				$withdrew = Withdraw::getRequests(Auth::user()->id);
				$total_withdrew = 0;
			    foreach ($withdrew as $each) {
			    	$total_withdrew = $total_withdrew + $each['request'];
			    }

				return View::make('modules.unilevelstatement', array( 
					'lvl'      => $lvl,
					'limit'    => 9,
					'currency' => 'PhP',
					'withdrew' => $total_withdrew,
					'earnings' => $total_earnings,
					'totalVp'  => $totalVp,
					'total_members' => $total_members,
				))->render();
			}
			else
			{
				return View::make('errors.requiredlogin', array(
					'message' => 'You need to login to view this page.',
				))->render();
			}
		}
		else
		{
			return Redirect::to('/')->with('message', 'You need to login.');
		}
	}

	public function showMemberTree($id)
	{
		if (Auth::check()) 
		{ 
			$user = User::find($id);

			$lvl[Auth::user()->id]['0']['0']['0'] = array( 
				'id'       => $user->id,
				'username' => $user->username,
			);
			
			for ($level=0; $level < 4 ; $level++) {

				if($level == 0)
				{
					$counter1 = 1;
				}
				else if($level == 1)
				{
					$counter1 = 2;
				}
				else if($level == 3)
				{
					$counter1 = 8;
				}
				else
				{
					$counter1 = $level * $level;
				}

				$makegroup = -1;

				for ($group=0; $group < $counter1; $group++) { 

					$prevgroup = $group;
					

					if ($level == 0) {
						$upline = $lvl[Auth::user()->id][0][0][0]['id'];
						$downline['left'] = User::getDownline($lvl[Auth::user()->id][0][0][0]['id'], 1);
						$downline['right'] = User::getDownline($lvl[Auth::user()->id][0][0][0]['id'], 2);
					}

					for ($position=0; $position < 2; $position++) {
						$makegroup = $makegroup + 1;
						#Start Binary Data
						if ($level != 0) {
							$upline = $lvl[Auth::user()->id][$level][$prevgroup][$position]['id'];
							$downline['left'] = User::getDownline($lvl[Auth::user()->id][$level][$prevgroup][$position]['id'], 1);
							$downline['right'] = User::getDownline($lvl[Auth::user()->id][$level][$prevgroup][$position]['id'], 2);
						}
						

						$lvl[Auth::user()->id][$level + 1][$makegroup]['0'] = array(
							'id'        => null,
							'username'  => 'None',
							'firstname' => 'None',
							'lastname'  => 'None',
							'middlename'=> 'None',
							'sponsor'   => 'None',
							'position'  => 'None',
							'directupline' => $upline,
						);
						$lvl[Auth::user()->id][$level + 1][$makegroup]['1'] = array(
							'id'        => null,
							'username'  => 'None',
							'firstname' => 'None',
							'lastname'  => 'None',
							'middlename'=> 'None',
							'sponsor'   => 'None',
							'position'  => 'None',
							'directupline' => $upline,
						);
						foreach ($downline['left'] as $data) {
							$lvl[Auth::user()->id][$level + 1][$makegroup]['0'] = array(
								'id'        => $data->id,
								'username'  => $data->username,
								'firstname' => $data->firstname,
								'lastname'  => $data->lastname,
								'middlename'=> $data->middlename,
								'sponsor'   => $data->sponsor,
								'position'  => $data->position,
								'directupline' => $data->directupline,
							);
						}
						foreach ($downline['right'] as $data) {
							$lvl[Auth::user()->id][$level + 1][$makegroup]['1'] = array(
								'id'        => $data->id,
								'username'  => $data->username,
								'firstname' => $data->firstname,
								'lastname'  => $data->lastname,
								'middlename'=> $data->middlename,
								'sponsor'   => $data->sponsor,
								'position'  => $data->position,
								'directupline' => $data->directupline,
							);
						}
						
						#END FOREACH
					}
				}
			}

			$code = Codes::getCodebysponsor();
			$code_master = Codes::getCodebysponsor(false, true);
			$codesavailable = Codes::countCode();
			$codesavailable_master = Codes::countCode(true);
			$activationcode = null;
			$activationcode_master = null;
			
			foreach ($code as $data) {
				$activationcode = Crypt::decrypt($data['activationcode']);
			}
			foreach ($code_master as $data) {
				$activationcode_master = Crypt::decrypt($data['activationcode']);
			}

			return View::make('account/membertree', array(
				'earnings' => 0,
				'page_title'   => 'Members',
				'lvl'   => $lvl,
				'activationcode' => $activationcode,
				'activationcode_master' => $activationcode_master,
				'codesavailable' => $codesavailable,
				'codesavailable_master' => $codesavailable_master,
				'users'          => User::getMasteraccounts(),
			));
		}
		else
		{
			return Redirect::to('/')->with('message', 'You need to login.');
		}
	}


}