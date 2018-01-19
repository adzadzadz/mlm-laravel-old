<!DOCTYPE html>
<!--[if IE 8 ]>    <html class="no-js ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]>    <html class="no-js ie9" lang="en"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?= $page_title ?> - PBB150</title>
    <?= HTML::style('/jquery-ui/jquery-ui.min.css') ?>
    <?= HTML::style('/theme/assets/css/bootstrap.css') ?>
    <?= HTML::style('/theme/assets/css/style.css') ?>
    <?= HTML::style('/chosen/chosen.min.css') ?>
    <?= HTML::style('/assets/glyph/css/glyph.min.css') ?>
    <?= HTML::style('/assets/css/style.css') ?>
    <!--[if lt IE 9]>
    <script src="assets/bootstrap/js/html5shiv.min.js"></script>
    <script src="assets/bootstrap/js/respond.min.js"></script>
    <![endif]-->
    <?= HTML::script('/theme/assets/js/modernizr.custom.js') ?>
    <?= HTML::script('/theme/assets/js/device.min.js') ?>
    <?= HTML::script('/theme/assets/js/jquery.min.js') ?>
    <?= HTML::script('/jquery-ui/jquery-ui.min.js') ?>
</head>
<body class="header-light navbar-light navbar-fixed with-topbar withAnimation">

<header class="">
    <div class="container">
        <div class="row">
            <div class="col-md-6 hidden-sm hidden-xs">
                <div class="text-wrapper">
                    <?php if (Auth::check()){  ?> (<?= Config::get("mlm_config.id_prefix") . Auth::user()->id ?>) <strong><?= Auth::user()->firstname . ' ' . Auth::user()->middlename . ' ' . Auth::user()->lastname ?></strong> <?php }else {?> Contact us: <i class="fa fa-envelope-o fa-fw"></i> <a href="mailto:cns_ph@yahoo.com">PBB150@yahoo.com</a> <?php } ?>
                </div>
            </div>
            <div class="col-md-6 text-right">
                <div class="text-wrapper">
                     <a href="#" id='register-btn'><i class="fa fa-fw fa-plus-circle"></i> Register</a>
                </div>
                <div class="text-wrapper">
                    <?php if (Auth::check()) { ?>
                    <a id="btn-logout" href="<?= route('logout') ?>"><i class="fa fa-fw fa-user"></i>Logout</a>
                    <?php } else { ?>
                    <a href="#" data-toggle="modal" data-target="#login_modal"><i class="fa fa-fw fa-user"></i>Login</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="container"></div>

<nav class="navbar yamm" role="navigation">
<div class="container">
<!-- Brand and toggle get grouped for better mobile display -->
<div class="hidden-xs">
    <a class="navbar-brand" href="<?= route('home'); ?>">PBB 150 Online System</a>
</div>

<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse no-transition" id="bs-example-navbar-collapse-1">
<ul class="nav navbar-nav navbar-right">
<li class="<?php if($page_title == 'Home') { echo 'active'; } ?>"><a href="<?= route('home'); ?>">Home</a></li>
<?php if (Auth::check()){  ?>
<li class="<?php if($page_title == 'Profile') { echo 'active'; } ?>"><a href="<?= route('profile'); ?>">Profile</a></li>
<?php if (Auth::user()->membertype == 'superuser') { ?> 
<li class="dropdown <?php if($page_title == 'Members' || $page_title == 'Settings' || $page_title == 'Earnings' || $page_title == 'Withdrawals') echo 'active'; ?>">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin <i class="fa fa-fw fa-angle-down"></i></a>
    <ul class="dropdown-menu yamm-dropdown">
        <li>
            <div class="yamm-content">
                <div class="row">
                    <div class="col-sm-7">
                                        <span class="navbar-title">
                                            Admin Options
                                        </span>
                        <ul class="list-unstyled">
                            <li><a href="<?= route('sueditprofile'); ?>"><i class="fa fa-fw fa-angle-right"></i>Edit User Profile</a></li>
                            <li><a href="<?= route('sushowearnings'); ?>"><i class="fa fa-fw fa-angle-right"></i>Earnings</a></li>
                            <li><a href="<?= route('sushowwithdrawals'); ?>"><i class="fa fa-fw fa-angle-right"></i>Withdrawals</a></li>
                            <li><a href="<?= route('susettings'); ?>"><i class="fa fa-fw fa-angle-right"></i>Settings</a></li>
                        </ul>
                    </div>
                    <!-- <div class="col-sm-3"></div> -->
                    <div class="col-sm-5">
                                        <span class="navbar-title">
                                            Frontend Options
                                        </span>
                        <ul class="list-unstyled">
                            <li><a href="<?= route('suaffiliates'); ?>"><i class="fa fa-fw fa-angle-right"></i>Add Affiliate</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</li>
<?php } ?>
<?php } else {?>

<?php } ?>
<li class="<?php if($page_title == 'Marketing Plan') { echo 'active'; } ?>"><a href="<?= route('marketingplan'); ?>">Opportunity</a></li>
<?php if (Auth::check()){  ?>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Affiliates <i class="fa fa-fw fa-angle-down"></i></a>
    <ul class="dropdown-menu yamm-dropdown">
        <li>
            <div class="yamm-content">
                <div class="row">
                    <div class="col-sm-5 nav-image" style="text-align:center;">
                        <img src="<?= asset('assets/imgs/cns-logo-9.png') ?>" alt="image"/ width="80%">
                    </div>
                    <div class="col-sm-7">
                                        <span class="navbar-title">
                                            Affiliates Menu
                                        </span>
                        <ul class="list-unstyled">
                            <li><a href="<?= route('affiliate_list','luzon') ?>"><i class="fa fa-fw fa-angle-right"></i>Luzon</a></li>
                            <li><a href="<?= route('affiliate_list','visayas') ?>"><i class="fa fa-fw fa-angle-right"></i>Visayas</a></li>
                            <li><a href="<?= route('affiliate_list','mindanao') ?>"><i class="fa fa-fw fa-angle-right"></i>Mindanao</a></li>
                        </ul>

                    </div>
                </div>
            </div>
        </li>
    </ul>
</li>
<?php } ?>
<li class="<?php if($page_title == 'About Us') { echo 'active'; } ?>"><a href="<?= route('aboutus'); ?>">About us</a></li>
</ul>

</div><!-- /.navbar-collapse
</div><!-- /.container-fluid -->
</nav>

<div class="container"></div>

<div id="wrapper">

<!-- VISIBLE COPY OF THE HEADER ONLY IN MOBILE NEEDED FOR THE SIDE MENU EFFECT -->

<div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header visible-xs">
        <a class="navbar-brand" href="<?= route('home'); ?>">PBB150</a>
        <button type="button" class="navbar-toggle" id="sidebar-toggle">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
</div>

<!-- END -->



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
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
            <div class="modal-body registration">.

            </div>
            <div class="modal-footer">
               
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Register Modal - END-->

<!-- check Activation Code Modal -->
<div class="modal fade" id="check_activationcode">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Activation Code Verification</h4>
            </div>
            <div class="modal-body check_activationcode_body">.
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">Activation code</div>
                                <input id="activation-code-input" class="form-control" type="text" placeholder="Enter activation code">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-md btn-danger" data-dismiss="modal">Close</button>
                <button id="activation-code-check-submit" class="btn btn-md btn-primary">Continue</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- check Activation Code Modal - END-->

<!-- Login script -->
<script>
    $(document).ready(function () {

        $('#register-btn').click(function () {

             $('#check_activationcode').modal('toggle');

        });
        
        $('#activation-code-check-submit').click(function () {

            var activationcode = $('#activation-code-input').val();

            $('#check_activationcode').modal('toggle');

            getRegistrationForm(activationcode);

        });

        function getRegistrationForm(code) {
            $.ajax({
                url:"<?= route('registration') ?>",
                type: 'POST',
                data: {
                    activationcode : code,
                },
                beforeSend:function(){
                    $('.registration').html('<div style="text-align: center;"><img class="earnings-loader" src=\'<?= asset("assets/imgs/loading-img.gif") ?>\' alt="Loading" /></div>');
                },
                success:function(result){
                    $('.registration').html(result);
                    $('#register_modal').modal('toggle');
                }
            });            
        }

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

        $('#btn-logout').click(function () {
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