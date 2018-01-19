<?php

class SalesController extends BaseController {

	public function allocateVP()
	{
		$id = Input::get('id');
		$count = Input::get('count');
		$allocated_by = Auth::user()->id;

		$data_history = array(
			'item'        => 'VP',
			'quantity'    => $count,
			'executed_by' => $allocated_by,
			'executed_for'=> $id,
		);
		$user = User::getUser($id);

		$data_user = array(
			'vp'   => $count + $user->vp,
		);

		$result_history = "";

		$allocate = User::updateUser($id, $data_user);
		return  $count . " " . $data_history['item'] . " added.<br>" . History::addItem($data_history);
	}

}