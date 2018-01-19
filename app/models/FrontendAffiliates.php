<?php

class FrontendAffiliates extends Eloquent {

	protected $table = 'frontend_affiliates';

	public static function addItem($data)
	{
		$item = new FrontendAffiliates;

		foreach ($data as $key => $value) {
			$item->$key = $value;
		}
		
		return $item->save();
	}

	public static function updateItem($id, $data)
	{
		$item = FrontendAffiliates::find($id);

		foreach ($data as $key => $value) {
			$item->$key = $value;
		}		

		$item->save();
		
		return $item->save();
	}


}