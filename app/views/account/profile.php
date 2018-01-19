<?= View::make('common.header', array('page_title' => $page_title))->render(); ?>

<section class="media-section darkbg" data-height="220" data-type="kenburns">
    <div class="media-section-image-container">
        <img src="<?= asset('theme/assets/images/mlm/banner-2.jpg'); ?>" alt="image">
    </div>

    <div class="inner">
        <div class="text-center">
            <h2 class="uppercase">This is your Profile</h2>
        </div>
    </div>
</section>

<section class="container">
    <div class="row">
        <div class="col-sm-12">

<?php 
if (Auth::check()) 
{ 
?>
<div id="profile" class="col-sm-4">
	<h3>Account Details</h3>
	<b>MASTER ACCOUNT</b>: <?= Config::get('mlm_config.id_prefix') ?><?= Auth::user()->master_account ?> <br>
	ID: <?= Config::get('mlm_config.id_prefix') ?><?= Auth::user()->id ?> <br>
	Username: <?= Auth::user()->username ?> <br>
	Email: <?= Auth::user()->email ?> <br>
	Password: ****** <br>
	First Name: <?= Auth::user()->firstname ?> <br>
	Middle Name: <?= Auth::user()->middlename ?> <br>
	Last Name: <?= Auth::user()->lastname ?> <br>
	Phone Number: <?= Auth::user()->phonenumber ?> <br>
	Gender: <?= Auth::user()->sex ?> <br>
	Direct Upline: <?= Auth::user()->directupline ?> <br>
	Sponsor: <?= Auth::user()->sponsor ?> <br>
	<br>
	<strong>Withdrawal Gateway:</strong> <br>
	<?php if ($my_gateway['b_palawan'] != ''): ?>
	<i class="fa fa-check-square-o"></i> <strong>Palawan Pawnshop</strong> <br>
	<?php endif ?>
	<?php if ($my_gateway['b_western'] != ''): ?>
	<i class="fa fa-check-square-o"></i> <strong>Mlhullier (Western Union)</strong> <br>
	<?php endif ?>
	<?php if ($my_gateway['b_bank'] != ''): ?>
	<i class="fa fa-check-square-o"></i> <strong>Bank</strong> <br>
	<ul>
		<li>Bank Name: <?= $my_gateway['bankname']; ?></li>
		<li>Bank Account: <?= $my_gateway['bankaccount']; ?></li>
	</ul>
	<?php endif ?>
	<br>
	Registered at: <?= Auth::user()->created_at ?> <br>
	Last Account Update: <?= Auth::user()->updated_at ?>

	<br><br>
	<button class="btn btn-lg btn-primary" data-toggle="modal" data-target="#edit_profile">Edit Profile</button>
	<button class="btn btn-lg btn-primary" data-toggle="modal" data-target="#change_password">Change Password</button>
	<br><br>


	<!-- Editprofile Modal -->
	<div class="modal fade" id="edit_profile">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title"><b>Edit Profile</b></h4>
				</div>
				<div class="modal-body">
					<div class="editprofile-error"></div>
					<div class="registration-form">
						<div class="row">
							<div class="form-group col-md-12">
								<label for="update-username">Username</label>
								<input type="text" class="form-control" name="update-username" id="update-username" value="<?= Auth::user()->username ?>" autocomplete="off">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-12">
								<label for="update-firstname">First Name</label>
								<input type="text" class="form-control" name="update-firstname" id="update-firstname" value="<?= Auth::user()->firstname ?>" autocomplete="off">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-12">
								<label for="update-middlename">Middle Name</label>
								<input type="text" class="form-control" name="update-middlename" id="update-middlename" value="<?= Auth::user()->middlename ?>" autocomplete="off">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-12">
								<label for="update-lastname">Last Name</label>
								<input type="text" class="form-control" name="update-lastname" id="update-lastname" value="<?= Auth::user()->lastname ?>" autocomplete="off">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-6">
								<label for="update-pn">Phone Number</label>
								<input type="text" class="form-control" name="update-lastname" id="update-pn" value="<?= Auth::user()->lastname ?>" autocomplete="off">
							</div>
							<div class="form-group col-md-6">
								<label for="update-sex">Gender</label>
								<input type="text" class="form-control" name="update-sex" id="update-sex" value="<?= Auth::user()->sex ?>" autocomplete="off">
							</div>
						</div>
					    <div class="row">
					        <div class="form-group col-md-6">
					            <label><strong>Withdrawal Gateway</strong></label>
					            <div class="checkbox">
					                <label>
					                    <input id="myprofile-check-palawan" type="checkbox" value="Palawan Pawnshop" <?php if ($my_gateway['b_palawan'] != '') echo 'checked'; ?>>
					                    Palawan Pawnshop
					                </label>
					            </div>
					            <div class="checkbox">
					                <label>
					                    <input id="myprofile-check-western" type="checkbox" value="Mlhullier (Western Union)" <?php if ($my_gateway['b_western'] != '') echo 'checked'; ?>>
					                    Mlhullier (Western Union)
					                </label>
					            </div>
					            <div class="checkbox">
					                <label>
					                    <input id="myprofile-check-bank" type="checkbox" value="Bank" <?php if ($my_gateway['b_bank'] != '') echo 'checked'; ?>>
					                    Bank (We only serve BDO, BPI and Metrobank for now)
					                </label>
					            </div>
					        </div>
					        <div id="myprofile-form-bank" style="display: none;">
					            <div class="form-group col-md-6">
					                <div class="input-group">
					                    <div class="input-group-addon">Bank Name</div>
					                    <input type="text" class="form-control" name="myprofile-bankname" id="myprofile-bankname" value="<?= $my_gateway['bankname'] ?>">
					                </div>
					            </div>
					            <div class="form-group col-md-6">
					                <div class="input-group">
					                    <div class="input-group-addon">Account #</div>
					                    <input type="text" class="form-control" name="myprofile-bankaccount" id="myprofile-bankaccount" value="<?= $my_gateway['bankaccount'] ?>">
					                </div>
					            </div>
					        </div>
					    </div> 
					    
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" id="submit-profile-changes">Save Changes</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<!-- Editprofile Modal - END-->

	<!-- Change password Modal -->
	<div class="modal fade" id="change_password">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title"><b>Change Password</b></h4>
				</div>
				<div class="modal-body">
					<div class="changepassword-error"></div>
					<div class="registration-form">
						<div class="row">
							<div class="form-group col-md-12">
								<label for="update-currentpassword">Current Password</label>
								<input type="password" class="form-control" name="update-currentpassword" id="update-currentpassword">
							</div>						
						</div>
						<div class="row">
							<div class="form-group col-md-12">
								<label for="update-newpassword">New Password</label>
								<input type="password" class="form-control" name="update-newpassword" id="update-newpassword">
							</div>						
						</div>
						<div class="row">
							<div class="form-group col-md-12">
								<label for="update-confirmnewpassword">Confirm Password</label>
								<input type="password" class="form-control" name="update-confirmnewpassword" id="update-confirmnewpassword">
							</div>						
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" id="submit-password-changes">Save New Password</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<!-- Change password Modal - END-->
</div>
<?php if ($total_amount != 0) { ?>

<div class="col-sm-8">
	<h3>Withdrawal Status:</h3>
	<table class="table table-hover">
		<thead>
			<tr>
				<td>ID</td>
				<td>Username</td>
				<td>Request</td>
				<td>Gateway</td>
				<td>Status</td>
				<td>Action</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><?= Config::get('mlm_config.id_prefix') ?><?= $requests_by_group['id'] ?></td>
				<td><?= $requests_by_group['username'] ?></td>
				<td><?= $total_amount ?></td>
				<td><?= $gateway ?></td>
				<td><?= $requests_by_group['status'] ?></td>
				<td><a class="fake-link" id="profile-show-breakdown">Show Breakdown</a></td>
			</tr>
			<tr>
				<td colspan="6">
					<div style="display:none;" id="profile-withdrawal-breakdown">
						<table class="table table-hover">
							<thead>
								<tr>
									<td>ID</td>
									<td>Username</td>
									<td>Request</td>
									<td>Gateway</td>
									<td>Status</td>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($requests_by_group['group'] as $each) { ?>
								<tr>
									<td><?= Config::get('mlm_config.id_prefix') ?><?= $each['user_id'] ?></td>
									<td><?= DB::table('users')->where('id', '=', $each['user_id'])->pluck('username') ?></td>
									<td><?= $each['request'] ?></td>
									<td><?= $each['gateway'] ?></td>
									<td><?= $each['status'] ?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
	
</div>
<?php } ?>
</div>

<?php echo View::make('common.sidebar-right', array('page_title' => $page_title))->render(); ?>

<?php }
else 
{
	// If Guest.
} 
?>

<script>
	$(document).ready(function () {
		$('#profile-show-breakdown').click(function () {
			$('#profile-withdrawal-breakdown').toggle();
		});
	});
</script>

<script>
	$(document).ready(function () {
		
		if ($('#myprofile-check-bank').is(':checked')) {
            $('#myprofile-form-bank').show('fast');
        }

		$("#myprofile-check-bank").change(function () {
            if ($('#myprofile-check-bank').is(':checked')) {
                $('#myprofile-form-bank').show('fast');
            }
            else {
                 $('#myprofile-form-bank').hide('fast');
            }
        });

		// Validator
		function validateUsername(data) {
			var pattern = /^[a-z0-9]{3,}/i;
			return pattern.test(data);
		}
		function validateName(data) {
			var pattern = /^[a-z0-9]{1,}/i;
			return pattern.test(data);
		}
		function validateSponsor(data) {
			if(data != null){
				if (data.length != 0) {
					return true;
				}
			}
			else {
				return false;
			}
		}

		$('#submit-profile-changes').click(function() {

			var b_bank = "",
                bankname = "",
                bankaccount = "",
                b_palawan = "",
                b_western = "";

            if ($('#myprofile-form-bank').is(':visible') && $('#myprofile-check-bank').is(':checked')) {
                b_bank = $('#myprofile-check-bank').val(); 
                bankname = $('#myprofile-bankname').val();
                bankaccount = $('#myprofile-bankaccount').val();                    
            }

            if ($('#myprofile-check-palawan').is(':checked')) {
                b_palawan = 'Palawan Pawnshop';
            }

            if ($('#myprofile-check-western').is(':checked')) {
                b_western = 'Mlhullier (Western Union)';
            }


			var username = $('#update-username').val(),
				firstname = $('#update-firstname').val(),
				middlename = $('#update-middlename').val(),
				lastname = $('#update-lastname').val(),
				phonenumber = $('#update-pn').val(),
				sex = $('#update-sex').val(),
				errormsg = '';

			function addError(data) {
				errormsg += data + "<br>";
			}
			validateUsername(username) || addError('*Username must be at least 3 characters(Also use alphanumeric characters)');
			validateName(firstname) || addError('*First name should be at least 2 characters');
			validateName(middlename) || addError('*Middle name should be at least 1 character');
			validateName(lastname) || addError('*Last name should be at least 2 characters');
			$('.editprofile-error').html('<div class="alert alert-danger">' + errormsg + '</div>');
			errormsg == '' && updateProfile();
			

			function updateProfile() {
				$.ajax({
					url:"<?= route('updateprofile') ?>",
					type: 'POST',
					data: {
						field : 'common',
						username : username,
						firstname : firstname,
						middlename : middlename,
						lastname : lastname,
						phonenumber : phonenumber,
						sex : sex,
						b_bank : b_bank,
                        bankname : bankname,
                        bankaccount : bankaccount,
                        b_palawan : b_palawan,
                        b_western : b_western,
					},
					beforeSend:function(){
						$('#submit-profile-changes').html('Verifying and Saving');
					},
					success:function(result){
					    if (result == 'true') {
					    	location.reload(true); 
					    }
					    else {
					    	$('.editprofile-error').html('<h4 style="color: red;">' + result + '</h4>');
					    	$('#submit-profile-changes').html('Save Changes');
					    }
					}
				});
			}
		});
	});
</script>

<script>
	$(document).ready(function () {

		// Validator
		function validatePassword(data) {
			if (data != undefined){
				if (data.length > 4) {
					return true;
				}
			}
			else {
				return false;
			}
		}

		$('#submit-password-changes').click(function() {
			var currentpassword = $('#update-currentpassword').val(),
				newpassword = $('#update-newpassword').val(),
				confirmnewpassword = $('#update-confirmnewpassword').val(),
				errormsg = '';

			function addError(data) {
				errormsg += data + "<br>";
			}

			validatePassword(newpassword) || addError('*Password must be at least 5 characters');
			newpassword == confirmnewpassword || addError('New Password does not match');
			errormsg == '' && updatePassword();
			$('.changepassword-error').html('<div class="alert alert-danger">' + errormsg + '</div>');

			function updatePassword(){
				$.ajax({
					url:"<?= route('updateprofile') ?>",
					type: 'POST',
					data: {
						field : 'password',
						currentpassword : currentpassword,
						newpassword : newpassword,
					},
					beforeSend:function(){
						$('#submit-password-changes').html('Verifying and Saving');
					},
					success:function(result){
					    if (result == 'true') {
					    	location.reload(true); 
					    }
					    else
					    {
					    	$('.changepassword-error').html('<h4 style="color: red;">' + result + '</h4>');
					    }
					}
				});
			}
		});
	});
</script>

<?= View::make('common.footer')->render(); ?>