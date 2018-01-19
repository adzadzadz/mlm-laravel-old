<section class="page">
	<div class="container">
		<div class="cns-alert"><?= Session::get('message') ?></div>
		<div class="col-sm-12">
			<div class="col-sm-8">
				<div class="settings-list">
					<h4 class="input-title">User Settings</h4>
					<table class="table table-striped">
						<thead>
							<tr>
								<td>Callback Name</td>
								<td>Name</td>
								<td>Value</td>
								<td>Action</td>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($settings['user'] as $setting) {  $nodelete = $setting['nodelete']; ?>
							<?php if (count($setting) != 0 ): ?>
								<tr>
									<td><?= $setting['callbackname'] ?></td>
									<td><?= $setting['name'] ?></td>
									<td><?= $setting['value'] ?></td>
									<td>
										<a class="fake-link" onclick="getUpdatesettingsmodal('user', '<?= $setting['name'] ?>', '<?= $setting['value'] ?>');">Edit</a> 
										<?php if ($setting['nodelete'] == 0) { ?>
											/ <a href="<?= route('sudeletesettings', array('User', $setting["callbackname"]) ) ?>">Delete</a>
										<?php } ?>
									</td>
								</tr>
							<?php endif; ?>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-sm-4 add_setting">
				<?= Form::open(array('route' => array('suaddsettings', 'User'))) ?>
					<h5 class="input-title">Add User Settings</h5>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">Callback Name</div>
							<input type="text" class="form-control" id="add-setting-callbackname" name="callbackname">
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">Name</div>
							<input type="text" class="form-control" id="add-setting-value" name="name">
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">Value</div>
							<input type="text" class="form-control" id="add-setting-value" name="value">
						</div>
					</div>
					<input type="hidden" class="form-control" id="add-setting-nodelete" name="nodelete" value="0">
					<div class="form-group">
						<input type="submit" class="btn btn-primary" value="Submit">
					</div>
				<?= Form::close() ?>
			</div>
		</div>
	</div>
</section>

<!-- Edit User Settings -->
<div class="modal fade" id="su-user-settings" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    	<?= Form::open(array('route' => array('sueditsettings', 'User'))) ?>
        <div class="su-update-user-settings-body small-modal-margin">
			<h5 class="input-title"><b>Edit User Settings</b></h5>
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon">Name</div>
					<input type="hidden" class="form-control" id="edit-setting-name" name="name">
					<input type="text" class="form-control" id="edit-setting-new-name" name="new_name">
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon">Value</div>
					<input type="text" class="form-control" id="edit-setting-value" name="value">
				</div>
			</div>
        </div>
        <div class="modal-footer">
            <input type="submit" class="btn btn-primary" value="Submit">
        </div>
        <?= Form::close() ?>
    </div>
  </div>
</div>
<!-- Edit User Settings -END- -->