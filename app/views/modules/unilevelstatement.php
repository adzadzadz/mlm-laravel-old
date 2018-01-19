<?php for ($i=1; $i < $limit; $i++) { 
	echo '<span id="modal-lvl' . $i . '"></span>';
}
?>
<table class="unilevel table table-bordered">
	<thead>
		<tr>
			<td><b>Level</b></td>
			<td><b>Member Count</b></td>
			<td><b>Volume Points</b></td>
			<td><b>Earnings in <?= $currency ?></b></td>
		</tr>
	</thead>
	<tbody>
		<?php for ($level=1; $level < $limit; $level++) {  ?>

			<?php if (isset($lvl[$level])) {

				$levelEarnings = 0;
				$levelVP = 0;

				foreach ($lvl[$level] as $each) { 
					$levelVP = $levelVP + $each['vp'];
					$levelEarnings = $levelEarnings + $each['earnings'];
				}
			?>
			
				<div id="data-container<?= $level ?>" data-level="<?= $level ?>" data-value="<?php foreach ($lvl[$level] as $data) { ?>	<tr><td><?= Config::get('mlm_config.id_prefix')?><?= $data['id'] ?></td>  <td><?= $data['firstname'] ?> <?= $data['middlename'] ?> <?= $data['lastname'] ?> </td><td><?= $data['vp'] ?></td><td><?= $data['earnings'] ?></td></tr>	<?php } ?>" style="display: none;"></div>
				
				<tr>
					<td class="level"><?= $level ?></td>
					<td class="count"> <button data-toggle="modal" data-target="#memberlist<?= $level ?>" class="btn btn-sm btn-danger show-lvl<?= $level ?>"><?= count($lvl[$level]) ?> </td>
					<td class="vp"><?= $levelVP ?></td>
					<td class="earnings"><?= $levelEarnings ?></td>
				</tr> 

			<?php } else { } ?>

		<?php }?>

		<tr class="unilevel-total">
			<td><button class="btn btn-success"><b>Total</b></button></td>
			<td><button class="btn btn-success"><b><?= $total_members ?></b></button></td>
			<td><button class="btn btn-success"><b><?= $totalVp ?></b></button></td>
			<td><button class="btn btn-success"><b><?= $earnings ?></b></button></td>
			<td></button></td>
		</tr>
		<?php if (Auth::user()->master_account == 0) { ?>

		<?php } ?>
		
	</tbody>
</table>
<div>
	<button class="btn btn-danger"><b>Recurring: PHP <?= Earnings::getEarnings(Auth::user()->id) ?>.00</b>
	<button class="btn btn-warning"><b>Withdrew: PHP <?= $withdrew?>.00</b></button>
	<button class="btn btn-success"><b>Available: PHP <?= Earnings::getAvailablebalance(Auth::user()->id) ?>.00</b></button>
</div>

<script>
	$(document).ready(function () {
		
		for (var counter = 1; counter < <?= $limit ?>; counter++) {

				var level = $('#data-container' + counter).data('level');
				var value = $('#data-container' + counter).data('value');

				$('#modal-lvl' + counter).html(makeModal(level, value));

		}
		
		function makeModal(level, data){
			var $output = '';
			$output += '<div class="modal fade" id="memberlist' + level + '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
			$output += '<div class="modal-dialog">';
			$output += '<div class="modal-content">';
			$output += '<div class="modal-header">';
			$output += '<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
			$output += '<h4 class="modal-title" id="myModalLabel">Members for this level</h4>';
			$output += '</div>';
			$output += '<div class="modal-body">';
			$output += '<table class="table table-hover" id="memberlist-table">';
			$output += '<thead>';
			$output += '<tr>';
			$output += '<td><b>ID</b></td>';
			$output += '<td><b>Name</b></td>';
			$output += '<td><b>VP</b></td>';
			$output += '<td><b>Earnings</b></td>';
			$output += '</tr>';
			$output += '</thead>';
			$output += '<tbody>' + data;
			$output += '</tbody>';
			$output += '</table>';
			$output += '</div>';
			$output += '<div class="modal-footer">';
			$output += '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
			$output += '</div>';
			$output += '</div>';
			$output += '</div>';
			$output += '</div>';

			return $output;
		}

	});
</script>