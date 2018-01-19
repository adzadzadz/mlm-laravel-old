<div class="page">
	<div class="container">
		<div class="col-sm-12">
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group">
						<label for="suedit-userid">User ID</label>
						<select id="suedit-userid" data-placeholder="Choose a user" class="chosen-select form-control">
							<option value="<?= Auth::user()->id ?>">Personal Profile</option>
						<?php foreach ($users as $user) { ?>
							<option value="<?= $user['id'] ?>"><?= Config::get('mlm_config.id_prefix') ?><?= $user['id'] ?> "<?= $user['username'] ?>" <?= $user['name'] ?></option>
						<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<button id="su-editprofile" class="btn btn-md btn-primary">Get User</button><span class="alert editprofile-alert"></span>
					</div>
				</div>
			</div>
			<div class="row">
				<div id="profile-content" class="col-sm-12">
					
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function () {
		$('#su-editprofile').click(function () {

			var su_userid = $('#suedit-userid').val();

			$.ajax({
	            url:"<?= route('sugetprofile') ?>",
	            type: 'POST',
	            data: {
	                userid : su_userid,
	            },
	            beforeSend:function(){
	                $('.editprofile-alert').html('Please wait...');
	            },
	            success:function(result){
	            	$('.editprofile-alert').html('');
	            	$('#profile-content').html(result);	
	            }
	        });
	    });
	});
</script>