<?php

class Settings extends Eloquent {

	protected $table = 'settings';

	public static function addSettings($group, $data)
	{
		$settings = Settings::getSettings($group);

		foreach ($settings as $each) 
		{
			if(count($each) > 0) 
			{
				if ($data['callbackname'] == $each['callbackname']) 
				{
					return '<div class="alert alert-danger">Duplicate "User Setting Name" entry.</div>'; exit;
				}
				else 
				{
					$data_new[] = array(
						'callbackname' => $each['callbackname'],
						'name'  => $each['name'],
						'value' => $each['value'],
						'nodelete' => (bool)$each['nodelete'],
					);
				}
			}
		}

		$data_new[] = array(
			'callbackname' => $data['callbackname'],
			'name'  => $data['name'],
			'value' => $data['value'],
			'nodelete' => $data['nodelete'],
		);

		$result = Settings::where('group', '=', 'User')->update(array('data' => serialize($data_new)));

		return $result;
	}

	public static function editSettings($group, $data)
	{
		$settings = Settings::getSettings($group);

		foreach ($settings as $each) 
		{
			if ($data['name'] == $each['name']) 
			{
				$data_new[] = array(
					'callbackname' => $each['callbackname'],
					'name'  => $data['new_name'],
					'value' => $data['value'],
					'nodelete' => (bool)$each['nodelete'],
				);
			}
			else
			{
				$data_new[] = array(
					'callbackname' => $each['callbackname'],
					'name'  => $each['name'],
					'value' => $each['value'],
					'nodelete' => (bool)$each['nodelete'],
				);
			}
		}		

		$result = Settings::where('group', '=', 'User')->update(array('data' => serialize($data_new)));

		return $result;
	}

	public static function deleteSettings($group, $callbackname)
	{
		$settings = Settings::getSettings($group);

		foreach ($settings as $each) 
		{
			if ($callbackname == $each['callbackname']) 
			{
				
			}
			else 
			{
				$data_new[] = array(
					'callbackname' => $each['callbackname'],
					'name'  => $each['name'],
					'value' => $each['value'],
					'nodelete' => (bool)$each['nodelete'],
				);
			}
		}

		$result = Settings::where('group', '=', $group)->update(array('data' => serialize($data_new)));

		return $result;
	}

	public static function getSettings($group)
	{
		$settings = Settings::where('group', '=', $group)->pluck('data');

		return unserialize($settings);
	}

	public static function getSpecificsetting($group, $callbackname)
	{
		$settings = Settings::getSettings($group);

		$result = false;

		foreach ($settings as $setting) 
		{
			if ($setting['callbackname'] == $callbackname) {
				$result =  $setting['value'];
			}			
		}

		return $result;
	}

}