<div class="col-sm-3 sidebar">
    <div class="row">
        <div class="col-sm-12 superuser_section">
            <?= View::make('account.superuser.codes.membercodesallocation', array('users' => $user_list_set))->render(); ?>
            <?= View::make('account.superuser.codes.mastercodesallocation', array('users' => $user_list_set))->render(); ?>
            <?= View::make('account.superuser.sales.membervpallocation', array('users' => $user_list_set))->render(); ?>
        </div>
    </div>
    <div class="row">
    	<div class="col-sm-12">
    		<?= View::make('earnings.earnings', array(
                'earnings' => $earnings, 
                'bankinfo' => $bankinfo,
                'withdraw_min_limit' => $withdraw_min_limit,
            ))->render(); ?>
    	</div>
    </div>
</div>
</div>
</section>

<div class="container"></div>
