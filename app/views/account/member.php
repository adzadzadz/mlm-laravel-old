<?= View::make('common.header', array('page_title' => $page_title))->render(); ?>

<?= View::make('account.dashboard', array(
	'direct_upline_count' => $direct_upline_count
))->render(); ?>

<?= View::make('common.sidebar-right', array(
	'page_title' => $page_title, 
	'earnings'   => $earnings, 
	'bankinfo'   => $bankinfo,
	'withdraw_min_limit' => $withdraw_min_limit,
))->render(); ?>

<?= View::make('common.footer')->render(); ?>