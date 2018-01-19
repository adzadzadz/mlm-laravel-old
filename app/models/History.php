<?php

class History extends Eloquent {

	protected $table = 'history';

	public static function addItem($data)
	{
		$item = new History;

		foreach ($data as $key => $value) {
			$item->$key = $value;
		}
		
		$item->save();

		return 'Items added on History.';
	}

	public static function getCodeAllocations_master($limit)
	{
		$codecount = DB::table('history')
					->where('item', '=', 'Registration Code - Master Accounts')
					->orderBy('id', 'desc')
                   	->take($limit)
                    ->get();

		return $codecount;
	}

	public static function getCodeAllocations($limit)
	{
		$codecount = DB::table('history')
					->where('item', '=', 'Registration Code')
					->orderBy('id', 'desc')
                   	->take($limit)
                    ->get();

		return $codecount;
	}

}