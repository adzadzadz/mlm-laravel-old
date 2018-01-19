<div class="row">
	<div class="col-sm-12">
		<table class="table table-striped">
			<thead>
				<tr>
					<td colspan="2">Total (Does not include own)</td>
					<td>Recurring: P<?= $total_earnings ?>.00</td>
					<td>Withdrew: P<?= $total_withdrew ?>.00</td>
					<td>Current: P<?= $total_earnings - $total_withdrew ?>.00</td>
				</tr>
				<tr>
					<td><b>ID</b></td>
					<td><b>USERNAME</b></td>
					<td><b>NAME</b></td>
					<td><b>RECURRING</b></td>
					<td><b>CURRENT</b></td>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($children_accounts as $account) { $total_recurring = Earnings::getEarnings($account['id']);?>
				<tr>
					<td><?= Config::get("mlm_config.id_prefix"); ?><?= $account['id'] ?></td>
					<td><?= $account['username'] ?></td>
					<td><?= $account['firstname'] ?> <?= $account['lastname'] ?></td>
					<td>P<?= $total_recurring ?>.00</td>
					<td>P<?= $total_recurring - Withdraw::getRequestvalue($account['id']) ?>.00</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>