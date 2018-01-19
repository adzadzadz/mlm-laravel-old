<?php

class SuperuserController extends BaseController {

	public function showUserprofile()
	{
		$users = User::getUsers();

		$content = View::make('account.superuser.user.userprofile', array(
			'users' => $users,
		))->render();

		return View::make('account.superuser.superuser', array(
			'page_title' => 'Edit User Profile',
			'content'    => $content,
		));
	}

	public function ajax_sushowEdituserprofile()
	{
		$user = User::getUser(Input::get('userid'));
		$users = User::getUsers();

		return View::make('account.superuser.user.edituserprofile', array(
			'user'       => $user,
			'users'      => $users,
		))->render();
	}

	public function suUpdateprofile()
	{
		$field = Input::get('field');

		$id = Input::get('id');

		if (Input::get('directupline') != Input::get('currentupline')) 
		{
			// $position = (int)User::checkPosition(Input::get('directupline'));
			// $count_downline = (int)User::countUserdownline(Input::get('directupline'));
			
			// if ($count_downline == 2)
			// {
			// 	return 'Direct Upline(' .  Config::get('mlm_config.id_prefix') . Input::get('direct_upline') . ') already has the "left" and "right" member. Please select a different upline.';
			// 	exit;
			// }
			// else
			// {
				
			// }
		}
		else
		{
			if (Input::get('directupline') == Input::get('currentupline')) 
			{

			}
			else
			{
				$position = (int)User::checkPosition(Input::get('directupline'));

				if (Input::get('position') != (int)User::checkPosition($id)) 
				{
					return 'Direct Upline(' .  Config::get('mlm_config.id_prefix') . Input::get('direct_upline') . ') already has a "member" for this leg. Please select a different upline.';
				}
			}
		}

		if ($field == 'common') 
		{
			$userdata = array(
				'firstname'    => Input::get('firstname'),
				'middlename'   => Input::get('middlename'),
				'lastname'     => Input::get('lastname'),
				'position'     => Input::get('position'),
				'directupline' => Input::get('directupline'),
				'sponsor'      => Input::get('sponsor'),
			);

			// Must not already exist in the `email` column of `users` table

			if (User::updateUser($id, $userdata))
			{
				return 'User Updated';
			}
			
		}

		if ($field == 'password')
		{
			if (Input::get('confirmpassword') == Input::get('password')) 
			{
				$userdata = array(
					'password' => Hash::make(Input::get('password')),
				);

				if (User::updateUser($id, $userdata))
				{
					return 'Password Updated';
				}
			}
			else
			{
				return 'Password does not match.';
			}
			
		}
		
	}

	public function showSettings()
	{
		$settings['user'] = Settings::getSettings('User');
		$settings['System'] = Settings::getSettings('System');
		$settings['Permissions'] = Settings::getSettings('Permissions');

		$content = View::make('account.superuser.settings.settings', array(
			'settings'   => $settings,
		));

		return View::make('account.superuser.superuser', array(
			'page_title' => 'Settings',
			'content'    => $content,
		));
	}

	public function addSettings($group)
	{
		$data = array(
			'callbackname' => Input::get('callbackname'),
			'name'  => Input::get('name'),
			'value' => Input::get('value'),
			'nodelete' => false,
		);

		$result = Settings::addSettings($group, $data);

		if ($result == 1) 
		{
			$result = '<div class="alert alert-success">New User Setting has been added.</div>';
		}
		else
		{
			$result = '<div class="alert alert-danger">An error has occured.</div>';
		}

		return Redirect::back()->with('message',$result);
	}

	public function editSettings($group)
	{
		$data = array(
			'name'     => Input::get('name'),
			'new_name' => Input::get('new_name'),
			'value'    => Input::get('value'),
		);

		$result = Settings::editSettings($group, $data);

		if ($result == 1) 
		{
			$result = '<div class="alert alert-success">User Setting has been updated.</div>';
		}
		else
		{
			$result = '<div class="alert alert-danger">An error has occured.</div>';
		}

		return Redirect::back()->with('message', $result);
	}

	public function deleteSettings($group, $callbackname)
	{
		$result = Settings::deleteSettings($group, $callbackname);

		if ($result == 1) 
		{
			$result = '<div class="alert alert-success">User Setting has been deleted.</div>';
		}
		else
		{
			$result = '<div class="alert alert-danger">An error has occured.</div>';
		}

		return Redirect::back()->with('message', $result);
	}

	public function showEarningspage()
	{
		$result = User::all();
		
		foreach ($result as $user) {
			$users[] = array('id' => $user['id']);
		}

		$content = View::make('account.superuser.earnings.earnings', array(
			'users' => $users,
		))->render();

		return View::make('account.superuser.superuser', array(
			'page_title' => 'Earnings',
			'content'    => $content,
		));
	}

	public function showWithdrawalspage()
	{
		$requesters = WithdrawRequestedBy::getAllrequesters();
		$requests = array();
		$group_total = 0;
		$gateway = '';

		foreach ($requesters as $each) {
			$requests[] = array( 
				'id'       => $each['user_id'],
				'username' => DB::table('users')->where('id', '=', $each['user_id'])->pluck('username'),
				'name'     => DB::table('users')->where('id', '=', $each['user_id'])->pluck('firstname') . ' ' . DB::table('users')->where('id', '=', $each['user_id'])->pluck('lastname'),
				'last_update' => $each['updated_at'],
				'status'   => $each['status'],
				'group'    => Withdraw::getRequestsfrom($each['user_id']),
			);
		}

		foreach ($requests as $each) {
			foreach ($each['group'] as $total) {
				$group_total = $group_total + $total['request'];
				$gateway = $total['gateway'];
			}
		}

		$content = View::make('account.superuser.withdrawals.withdrawals', array(
			'requests'    => $requests,
			'group_total' => $group_total,
			'gateway'     => $gateway,
		))->render();

		return View::make('account.superuser.superuser', array(
			'page_title' => 'Withdrawals',
			'content'    => $content,
		));
	}


	// FRONTEND AREA
	public function showAffiliatespage($id='')
	{		
		$affiliate_to_edit = '';

		if($id != '')
		{
			$affiliate_to_edit = FrontendAffiliates::find($id);
		}

		$affiliate_groups = FrontendAffiliatesGroup::all();

		$content = View::make('account.superuser.datacontent.affiliates', array(
			'id'                => $id,
			'affiliate_to_edit' => $affiliate_to_edit,
			'affiliate_groups'  => $affiliate_groups,
		))->render();

		return View::make('account.superuser.superuser', array(
			'page_title' => 'Affiliates',
			'content'    => $content,
		));
	}

	public function addAffiliate()
	{		
		$data = array(
			'group'       => strtolower(Input::get('group')),
			'name'        => Input::get('name'),
			'description' => Input::get('description'),
			'contact'     => Input::get('contact'),
			'status'      => 'Published',
		);

		$result = FrontendAffiliates::addItem($data);

		return "Affiliate Added";
	}

	public function updateAffiliate($id)
	{
		$data = array(
			'group'       => strtolower(Input::get('group')),
			'name'        => Input::get('name'),
			'description' => Input::get('description'),
			'contact'     => Input::get('contact'),
			'status'      => 'Published',
		);

		$result = FrontendAffiliates::updateItem($id, $data);

		return "Affiliate Updated";
	}

	public function deleteAffiliate($id)
	{
		$affiliate = DB::table('frontend_affiliates')->where('id', '=', $id)->delete();

		return Redirect::back()->with('message','Deleted');
	}

	public function addAffiliategroup()
	{
		$data = array(
			'name'        => strtolower(Input::get('name')),
			'description' => Input::get('description'),
			'status'      => 'Published',
		);

		$result = FrontendAffiliatesGroup::addItem($data);

		return "Affiliate Group Added";
	}

}
