<div class="row">
	<div class="col-sm-1"><b>Level</b></div>
	<div class="col-sm-11"><b>Members</b></div>
</div>

	<div class="row">
		<div class="col-sm-1 level"><strong>ME</strong></div>
		<div class="col-sm-11 count">
			<div class="overflow-x">
				<table>
					<tr>
						<?php foreach ($lvl[0] as $data) { ?>	
						<td>
							<div class="member-box id_<?= $data['id'] ?>">
								<em><?= Config::get('mlm_config.id_prefix')?><?= $data['id'] ?></em>
								<p>
									<strong>VP:</strong> <?= $data['vp'] ?>
									<br><strong><?= $data['username'] ?></strong> 
									<br><?= $data['firstname'] ?> <?= $data['middlename'] ?> <?= $data['lastname'] ?>
								</p>
							</div>
						</td>
						<?php } ?>
					</tr>
				</table>
			</div>
		</div>
	</div>

<?php for ($level=1; $level < $limit; $level++) {  ?>

	<div class="row">

		<?php if (isset($lvl[$level])) { ?>
			
			<div class="col-sm-1 level"><?= $level ?></div>
			<div class="col-sm-11 count">
				<div class="overflow-x">
					<table>
						<tr>
							<?php foreach ($lvl[$level] as $level_data) { ?>	
							<td>
								<div class="member-box fake-link id_<?= $level_data['id'] ?>" onclick="makeUnilevellink( '<?= route('getUnilevel', $level_data['id']) ?>' );" 
								data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Sponsor: <?= Config::get('mlm_config.id_prefix')?><?= $level_data['sponsor'] ?>">
									<em><?= Config::get('mlm_config.id_prefix')?><?= $level_data['id'] ?></em>
									<p>
										<strong>VP:</strong> <?= $level_data['vp'] ?>
										<br><strong><?= $level_data['username'] ?></strong>
										<br><?= $level_data['firstname'] ?> <?= $level_data['middlename'] ?> <?= $level_data['lastname'] ?>
									</p>
								</div>
							</td>
							<script>
								$(document).ready(function () {
									$('.id_<?= $level_data['id'] ?>').hover(
									function () {
										$('.id_<?= $level_data['id'] ?>').popover('show');
										// $('.id_<?= $level_data['sponsor'] ?>').css('background', '#c1ffc8');
									}, 
									function () {
										$('.id_<?= $level_data['id'] ?>').popover('hide');
										// $('.id_<?= $level_data['sponsor'] ?>').css('background', '#fff');
									});

								});
							</script>
							<?php } ?>
						</tr>
					</table>
				</div>
			</div>

		<?php } else { } ?>

	</div>

<?php }?>

</div>