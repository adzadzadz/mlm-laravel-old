<!DOCTYPE html>
<html lang="en">
<head>
	<title>MLM</title>
	<?= HTML::style('/assets/bootstrap-3.1.1-dist/css/bootstrap.min.css') ?>
	<?= HTML::style('/assets/css/style.css') ?>
	
	<!-- Placed temporarily -->
	<?= Config::get('mlm_config.get_jquery') ?>
</head>
<body>
<div class="container">

<header>
	<nav class="navbar navbar-inverse" role="navigation">
		<div class="navbar-header">
			<a class="navbar-brand" href="<?= route('home'); ?>">MLM</a>
		</div>
		<div class="main-menu">
			<?php if (Auth::check()) { ?>
				<a href="<?= route('logout') ?>"class="btn-login btn-logout btn btn-sm btn-primary navbar-btn pull-right">Logout</a>
			<?php } else { ?>
				<a class="btn-login btn btn-sm btn-primary navbar-btn pull-right" data-toggle="modal" data-target="#login_modal">Login</a>
			<?php } ?>
			<a class="btn-login btn btn-sm btn-primary navbar-btn pull-right" data-toggle="modal" data-target="#register_modal">Register</a>
		</div>
	</nav>	 
</header>

<!-- Login Modal -->
<div class="modal fade" id="login_modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title"><b>Login</b></h4>
			</div>
			<div class="modal-body">
				<div class="registration-form">
					<div class="row">
						<div class="form-group col-md-12">
							<label for="username">Email or Username</label>
							<input type="text" class="form-control" name="username" id="username"  autocomplete="off">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<label for="login-password">Password</label>
							<input type="password" class="form-control" name="login-password" id="login-password">
						</div>						
					</div>
				</div>
				<div class="login-error"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="submit-login">Login</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Login Modal - END-->



<!-- Register Modal -->
<div class="modal fade" id="register_modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Registration</h4>
			</div>
			<div class="modal-body">.
				<div class="row reg-alert"></div>
				<div class="registration-form">
					<div class="row">
						<div class="form-group col-md-6">
							<label for="firstname">First Name</label>
							<input type="text" class="form-control" name="firstname" id="firstname">
						</div>
						<div class="form-group col-md-6">
							<label for="lastname">Last Name</label>
							<input type="text" class="form-control" name="lastname" id="lastname">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="email">Email</label>
							<input type="email" class="form-control" name="email" id="email"  autocomplete="off">
						</div>
						<div class="form-group col-md-6">
							<label for="activationcode">Activation Code</label>
							<input type="text" class="form-control" name="activationcode" id="activationcode">
						</div>						
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="direct_upline">Direct Upline</label>
							<button class="btn btn-sm btn-danger btn-dul">Click me</button>
							<select name="direct_upline" class="form-control" id="direct_upline" style="display:none;">
								
							</select>
						</div>
						<div class="form-group col-md-6">
							<label for="sponsor">Sponsor</label>
							<button class="btn btn-sm btn-danger btn-sponsor">Click me</button>
							<select class="form-control" name="sponsor" id="sponsor" style="display:none;">
								
							</select>
						</div>						
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="password">Password</label>
							<input type="password" class="form-control" name="password" id="password">
						</div>
						<div class="form-group col-md-6">
							<label for="confirmpassword">Confirm Password</label>
							<input type="password" class="form-control" name="confirmpassword" id="confirmpassword">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="submit-registration">Submit</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Register Modal - END-->


<!-- Login script -->
<script>
	$(document).ready(function () {
		$('#submit-login').click(function () {
			var $username = $('#username').val(),
				$password = $('#login-password').val();

			$.ajax({
				url:"<?= action('AccountController@login') ?>",
				type: 'POST',
				data: {
					username : $username,
					password : $password,
				},
				beforeSend:function(){
					$('#submit-login').html('Verifying..');
				},
				success:function(result){
				    if(result == 'verified') {
				    	location.reload(true); 
				    }
				    else {
				    	$('.login-error').html('<h4 style="color: red;">' + result + '</h4>');
				    	$('#submit-login').html('Login');
				    }
				}
			});
		});

		$('.btn-logout').click(function () {
			$.ajax({
				url:"<?= action('AccountController@logout') ?>",
				type: 'POST',
				success:function(){
					location.reload(true); 
				}
			});
		});
	});
</script>

<!-- Registration script -->
<script>
	$(document).ready(function () {

		$('.btn-dul').click(function () {
			getUsers('#direct_upline');
			$(this).fadeOut('fast');
		});
		$('.btn-sponsor').click(function () {
			getUsers('#sponsor');
			$(this).fadeOut('fast');
		});
		function getUsers(insert) {
			$.ajax({
				url:"<?= action('AccountController@getUsers') ?>",
				type: 'POST',
				data: {

				},
				success:function(result){
					var data = JSON.parse(result);
					var htmldata;
					$.each(data, function(i, item) {
						htmldata += '<option value="' + item.id + '">' + item.name + ' - ID: <?= Config::get("mlm_config.id_prefix"); ?>' + item.id + '</option>';
					});
					$(insert).html(htmldata);
					$(insert).slideDown('fast');
				}

			});
		}

		$('#submit-registration').click(function () {

			var $firstname = $('#firstname').val(),
				$lastname = $('#lastname').val(),
				$email = $('#email').val(),
				$activationcode = $('#activationcode').val(),
				$password = $('#password').val(),
				$confirmpassword = $('#confirmpassword').val(),
				$direct_upline = $('#direct_upline').val(),
				$sponsor = $('#sponsor').val(),
				alertbox = $('#register_modal .reg-alert'),
				errormsg = '';

			validateName($firstname) || addError('*First name should be at least 2 characters');
			validateName($lastname) || addError('*Last name should be at least 2 characters');
			validateEmail($email) || addError('*Invalid Email');
			validateSponsor($direct_upline) || addError('*Please select an Upline');
			validateSponsor($sponsor) || addError('*Please select a Sponsor');
			validatePassword($password) || addError('*Password should be at least 8 characters');
			$password == $confirmpassword || addError('*password does not match');
			
			alertbox.html('<div class="alert alert-warning" role="alert">' + errormsg + '</div>');

			errormsg == '' && signUp();
			
			// Validation
			function addError(data) {
				errormsg += data + "<br>";
			}
			function validateName(data) {
				var pattern = /^[a-z0-9]{2,}/i;
				return pattern.test(data);
			}
			function validateEmail(data) {
				var pattern = /^[a-z0-9._-]+@[a-z]+.[a-z.]{2,5}$/i;
				return pattern.test(data);
			}
			function validatePassword(data) {
				if (data != undefined){
					if (data.length > 7) {
						return true;
					}
				}
				else {
					return false;
				}
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
			function signUp(){
				$.ajax({
					url:"<?= action('AccountController@addUser') ?>",
					type: 'POST',
					data: {
						firstname : $firstname,
						lastname : $lastname,
						email : $email,
						activationcode : $activationcode,
						password : $password,
						direct_upline : $direct_upline,
						sponsor : $sponsor,
					},
					beforeSend:function(){
						$('.registration-form').slideUp('fast');
					},
					success:function(result){
					    $('.registration-form input').val('');
					    $('#register_modal .modal-body').html('<div class="alert">' + result + '</div><?php if (Auth::check()) { ?><h3><b>Refresh page to update codes status.</b></h3><?php } ?>');
					    $('#submit-registration').fadeOut('fast');

					}

				});
			}
		})

	});
</script>