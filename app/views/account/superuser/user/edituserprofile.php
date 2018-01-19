<div class="row">
	<div class="col-sm-12">
		<div class="editprofile-error alert alert-success" style="display: none"></div>
	</div>
</div>
<div class="row">
	<div class="col-sm-4">
		<div class="row">
			<div class="col-sm-12">
				<h2>ID: <?= Config::get("mlm_config.id_prefix") ?><?= $user['id'] ?></h2>
			</div>
			<div class="col-sm-12">
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon">First Name</div>
						<input id="su-edit-firstname" class="form-control" type="text" placeholder="Enter first name" value="<?= $user['firstname'] ?>">
					</div>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon">Middle Name</div>
						<input id="su-edit-middlename" class="form-control" type="text" placeholder="Enter middle name" value="<?= $user['middlename'] ?>">
					</div>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon">Last Name</div>
						<input id="su-edit-lastname" class="form-control" type="text" placeholder="Enter last name" value="<?= $user['lastname'] ?>">
					</div>
				</div>
			</div>
			<div class="form-group col-sm-12">
				<labeL for="edit-dul"><div class="input-group-addon">Direct Upline</div></labeL>
				<select id="edit-dul" data-placeholder="Choose a user" class="chosen-select form-control">
					<option value="<?= $user['directupline'] ?>"><?= Config::get('mlm_config.id_prefix') ?><?= $user['directupline'] ?></option>
				<?php foreach ($users as $user_list) { ?>
					<option value="<?= $user_list['id'] ?>"><?= Config::get('mlm_config.id_prefix') ?><?= $user_list['id'] ?> "<?= $user_list['username'] ?>" <?= $user_list['name'] ?></option>
				<?php } ?>
				</select>
			</div>
			<div class="form-group col-sm-12">
				<label><div class="input-group-addon">Position</div></label>
				<div class="radio">
					<label>
						<input type="radio" name="position" id="su-position-left" value="1" <?php if($user['position'] == 1) echo 'checked'; ?>>
						Left
					</label>
				</div>
				<div class="radio">
					<label>
						<input type="radio" name="position" id="su-position-right" value="2" <?php if($user['position'] == 2) echo 'checked'; ?>>
						Right
					</label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-12">
				<labeL for="edit-sponsor"><div class="input-group-addon">Sponsor</div></labeL>
				<select id="edit-sponsor" data-placeholder="Choose a user" class="chosen-select form-control">
					<option value="<?= $user['sponsor'] ?>"><?= Config::get('mlm_config.id_prefix') ?><?= $user['sponsor'] ?></option>
				<?php foreach ($users as $user_list) { ?>
					<option value="<?= $user_list['id'] ?>"><?= Config::get('mlm_config.id_prefix') ?><?= $user_list['id'] ?> "<?= $user_list['username'] ?>" <?= $user_list['name'] ?></option>
				<?php } ?>
				</select>
		    </div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				Registered at: <?= $user['created_at'] ?> <br>
				Last Account Update: <?= $user['updated_at'] ?> <br>
			</div>
		</div>
		<button id="su-save-changes" class="btn btn-primary btn md">Save Changes</button>
	</div>
	<div class="col-sm-2">
		
	</div>
	<div class="col-sm-4">
		<div class="alert alert-danger text-center"><h4>Danger Zone!</h4></div>
		<div class="form-group">
			<div class="input-group">
				<div class="input-group-addon">New Password</div>
				<input id="su-edit-password" class="form-control" type="text" placeholder="Enter password" value="">
			</div>
		</div>
		<div class="form-group">
			<div class="input-group">
				<div class="input-group-addon">Confirm Password</div>
				<input id="su-confirm-edit-password" class="form-control" type="text" placeholder="Enter password" value="">
			</div>
		</div>
		<button id="su-submit-new-password" class="btn btn-lg btn-danger">Submit</button>
	</div>
</div>
<!-- CONFIRM CHANGES MODAL -->
<div class="modal fade" id="su-confirm-changes" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="row">
      	<div class="col-sm-12 su-review-changes small-modal-margin">
      		
      	</div>
      	<div class="modal-footer">
      		<button id="su-submit-profile-changes" class="btn-sm btn btn-danger btn-block">Confirm Changes</button>
      	</div>
      </div>
    </div>
  </div>
</div>
<!-- CONFIRM CHANGES MODAL -END- -->

<script>
$(document).ready(function () {

	$('#su-submit-new-password').click(function () {

		var password = $('#su-edit-password').val(),
			confirmpassword = $('#su-confirm-edit-password').val();

			if(password == confirmpassword)
			{
				$.ajax({
					url:"<?= route('suUpdateprofile') ?>",
					type: 'POST',
					data: {
						field : 'password',
						id : <?= $user['id'] ?>,
						password : password,
						confirmpassword : confirmpassword,
					},
					beforeSend:function(){

					},
					success:function(result){
					    $('.editprofile-error').html('<strong>' + result + '</strong>');
					    $('#su-confirm-changes').delay(3000).modal('hide');
					    $("html, body").animate({ scrollTop: 0 }, "slow");
					    $('.editprofile-error').fadeIn('slow');
					}
				});
			}
			else
			{
				alert('Password does not match!');
			}
	});

});
</script>

<script>
$(document).ready(function () {

	$(".chosen-select").chosen();

	$('#su-save-changes').click(function () {
		var sponsor = $('#edit-sponsor').val(),
			directupline = $('#edit-dul').val(),
			firstname = $('#su-edit-firstname').val(),
			middlename = $('#su-edit-middlename').val(),
			lastname = $('#su-edit-lastname').val(),			
			errormsg = '';
			if ($('#su-position-left').is(":checked"))
			{
			  var position = $('#su-position-left').val();
			  var position_word = 'left';
			}
			if ($('#su-position-right').is(":checked"))
			{
			  var position = $('#su-position-right').val();
			  var position_word = 'right';
			}

		save_changes_content = '';
		save_changes_content += 'Firstname: ' + firstname + '<br>';
		save_changes_content += 'Middlename: ' + middlename + '<br>';
		save_changes_content += 'Lastname: ' + lastname + '<br>';
		save_changes_content += 'Direct Upline: <?= Config::get('mlm_config.id_prefix') ?>' + directupline + '<br>';
		save_changes_content += 'Position: ' + position_word + '<br>';
		save_changes_content += 'Sponsor: <?= Config::get('mlm_config.id_prefix') ?>' + sponsor;

		$('.su-review-changes').html(save_changes_content);

		$('#su-confirm-changes').modal('toggle');
	});

	$('#su-submit-profile-changes').click(function() {

		updateProfile();

	});

	function updateProfile() {
		var sponsor = $('#edit-sponsor').val(),
			directupline = $('#edit-dul').val(),
			firstname = $('#su-edit-firstname').val(),
			middlename = $('#su-edit-middlename').val(),
			lastname = $('#su-edit-lastname').val(),
			currentupline = <?= $user['directupline'] ?>,
			errormsg = '';
			if ($('#su-position-left').is(":checked"))
			{
			  var position = $('#su-position-left').val();
			}
			if ($('#su-position-right').is(":checked"))
			{
			  var position = $('#su-position-right').val();
			}

		$.ajax({
			url:"<?= route('suUpdateprofile') ?>",
			type: 'POST',
			data: {
				field : 'common',
				id : <?= $user['id'] ?>,
				directupline : directupline,
				position : position,
				sponsor : sponsor,
				firstname : firstname,
				middlename : middlename,
				lastname : lastname,
				currentupline : currentupline,
			},
			beforeSend:function(){
				$('#su-submit-profile-changes').html('Verifying and Saving');
			},
			success:function(result){
			    $('.editprofile-error').html('<strong>' + result + '</strong>');
			    $('#su-submit-profile-changes').html('Save Changes');
			    $('#su-confirm-changes').delay(3000).modal('hide');
			    $("html, body").animate({ scrollTop: 0 }, "slow");
			    $('.editprofile-error').fadeIn('slow');
			}
		});
	}
});
</script>