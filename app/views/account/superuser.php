<?= View::make('common.header', array('page_title' => $page_title))->render(); ?>

<?= View::make('account.dashboard', array(
	'direct_upline_count' => $direct_upline_count
))->render(); ?>

<?= View::make('account.superuser.navigation.navigation', array(
	'user_list_set' => $user_list_set,
	'earnings' => $earnings, 
	'bankinfo' => $bankinfo,
	'withdraw_min_limit' => $withdraw_min_limit,
))->render(); ?>

<?= View::make('common.footer', array(
	'user_list_set' => $user_list_set,
))->render(); ?>