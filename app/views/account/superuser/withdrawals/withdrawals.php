<div class="page">
<div class="container">
	<table class="table table-condensed table-hover">
		<thead>
			<tr>
				<td>ID</td>
				<td>Username</td>
				<td>Name</td>
				<td>Amount</td>
				<td>Gateway</td>
				<td>Last Update</td>
				<td>Status</td>
				<td>Action</td>
			</tr>
		</thead>
		<tbody>

		<?php foreach ($requests as $request) {  ?>
		
		<tr>
			<td><?= Config::get('mlm_config.id_prefix') ?><?= $request['id'] ?></td>
			<td><?= $request['username'] ?></td>
			<td><?= $request['name'] ?></td>
			<td>P <?= $group_total ?>.00</td>
			<td><?= $gateway ?></td>
			<td><?= $request['last_update'] ?></td>
			<td><?= $request['status'] ?></td>
			<td><a class="fake-link" id="toggle-breakdown">Show Breakdown</a></td>
		</tr>
		<tr class="hide-element" id="breakdown-display">
			<td colspan="7">
			<table class="table table-condensed table-hover">
				<thead>
					<tr>
						<td>ID</td>
						<td>Username</td>
						<td>Amount</td>
						<td>Gateway</td>
						<td>Last Update</td>
						<td>Status</td>
					</tr>
				</thead>			
				<tbody>
					<?php foreach ($request['group'] as $each) { ?>
					<tr>
						<td><?= $each['user_id'] ?></td>
						<td><?= DB::table('users')->where('id', '=', $each['user_id'])->pluck('username') ?></td>
						<td><?= $each['request'] ?></td>
						<td><?= $each['gateway'] ?></td>
						<td><?= $each['updated_at'] ?></td>
						<td><?= $each['status'] ?></td>
					</tr>
					<?php } ?>	
				</tbody>
			</table>
			</td>
		</tr>
	  <?php } ?>

		</tbody>
	</table>
</div>
</div>

<script>
	$(document).ready(function () {
		$('#toggle-breakdown').click(function () {
			$('#breakdown-display').toggle();
		});
	});
</script>