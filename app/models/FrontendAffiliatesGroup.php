<?php

class FrontendAffiliatesGroup extends Eloquent {

	protected $table = 'frontend_affiliates_group';

	public static function addItem($data)
	{
		$item = new FrontendAffiliatesGroup;

		foreach ($data as $key => $value) {
			$item->$key = $value;
		}
		
		return $item->save();
	}

}