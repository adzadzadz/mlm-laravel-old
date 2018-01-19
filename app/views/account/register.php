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
            <label for="reg-username">Username</label>
            <input type="text" class="form-control" name="reg-username" id="reg-username"  autocomplete="off">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="reg-sponsor">Sponsor</label>
            <input type="text" class="form-control" name="reg-sponsor" id="reg-sponsor">
        </div>
        <div class="form-group col-md-6">
            <label for="direct_upline">Direct Upline</label>
            <input id="direct_upline" type="text" class="form-control get-user-list" name="direct_upline">
        </div>
    </div>
    <?php if ($im_master == true): ?>
    <div class="row">
        <div class="form-group col-md-6">
            <label>Withdrawal Gateway</label>
            <div class="checkbox">
                <label>
                    <input id="check-palawan" type="checkbox" value="Palawan Pawnshop">
                    Palawan Pawnshop
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input id="check-western" type="checkbox" value="Mlhullier (Western Union)">
                    Mlhullier (Western Union)
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input id="check-bank" type="checkbox" value="Bank">
                    Bank (We only serve BDO, BPI and Metrobank for now)
                </label>
            </div>
            <div id="form-bank" style="display: none;">
            <div class="form-group col-md-12">
                <div class="input-group">
                    <div class="input-group-addon">Bank Name</div>
                    <input type="text" class="form-control" name="reg-bankname" id="reg-bankname">
                </div>
            </div>
            <div class="form-group col-md-12">
                <div class="input-group">
                    <div class="input-group-addon">Account #</div>
                    <input type="text" class="form-control" name="reg-bankaccount" id="reg-bankaccount">
                </div>
            </div>
        </div>
        </div>
        <div class="form-group col-md-6">
            <label for="reg-pn">Phone Number</label>
            <input class="form-control" type="text" placeholder="sample: 09201234567" name="reg-pn" id="reg-pn">
        </div> <br>
    </div> 
    <?php else: ?>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="reg-pn">Phone Number</label>
            <input class="form-control" type="text" placeholder="sample: 09201234567" name="reg-pn" id="reg-pn">
        </div>
        <div class="form-group col-md-6">
            <label for="reg-master-account">Master Account</label>
            <select name="reg-master-account" data-placeholder="Choose a user" class="chosen-select form-control" id="reg-master-account">
                    <option value=""></option>
                <?php  foreach ($master_accounts as $master_account) { ?>
                    <option value="<?= $master_account['id'] ?>"><?= Config::get('mlm_config.id_prefix') ?><?= $master_account['id'] . ' "' . $master_account['username'] . '" ' . $master_account['name'] ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <?php endif ?>
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
<div class="buttons">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" id="submit-registration">Submit</button>
</div>



<!-- Registration script -->
<script>
    $(document).ready(function () {

        $("#check-bank").change(function () {
            if ($('#check-bank').is(':checked')) {
                $('#form-bank').show('fast');
            }
            else {
                 $('#form-bank').hide('fast');
            }
        });

        $('#submit-registration').click(function () {

            var b_bank = "",
                bankname = "",
                bankaccount = "",
                b_palawan = "",
                b_western = "";

            if ($('#form-bank').is(':visible') && $('#check-bank').is(':checked')) {
                b_bank = $('#check-bank').val(); 
                bankname = $('#reg-bankname').val();
                bankaccount = $('#reg-bankaccount').val();                    
            }

            if ($('#check-palawan').is(':checked')) {
                b_palawan = 'Palawan Pawnshop';
            }

            if ($('#check-western').is(':checked')) {
                b_western = 'Mlhullier (Western Union)';
            }

            var master_account = $('#reg-master-account').val();

            var $firstname = $('#firstname').val(),
                $lastname = $('#lastname').val(),
                $username = $('#reg-username').val(),
                $activationcode = "<?= $activationcode ?>", 
                $password = $('#password').val(),
                $confirmpassword = $('#confirmpassword').val(),
                $direct_upline = $('#direct_upline').val(),
                $sponsor = $('#reg-sponsor').val(),
                $phonenumber = $('#reg-pn').val(),
                alertbox = $('#register_modal .reg-alert'),
                errormsg = '';

            validateName($firstname) || addError('*First name should be at least 2 characters');
            validateName($lastname) || addError('*Last name should be at least 2 characters');
            validateUsername($username) || addError('*Username should be at least 3 characters');
            validateSponsor($sponsor) || addError('*Please select an Upline');
            validatePassword($password) || addError('*Password should be at least 5 characters');
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
            function validateUsername(data) {
                var pattern = /^[a-z0-9]{3,}/i;
                return pattern.test(data);
            }
            function validateEmail(data) {
                var pattern = /^[a-z0-9._-]+@[a-z]+.[a-z.]{2,5}$/i;
                return pattern.test(data);
            }
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
                        <?php if ($im_master == true): ?>
                        master_account : 0,
                        <?php else: ?>
                        master_account : master_account,
                        <?php endif ?>
                        firstname : $firstname,
                        lastname : $lastname,
                        username : $username,
                        activationcode : $activationcode,
                        password : $password,
                        direct_upline : $direct_upline,
                        sponsor : $sponsor,
                        phonenumber : $phonenumber,
                        b_bank : b_bank,
                        bankname : bankname,
                        bankaccount : bankaccount,
                        b_palawan : b_palawan,
                        b_western : b_western,
                    },
                    beforeSend:function(){
                        $('.registration-form').slideUp('fast');
                    },
                    success:function(result){
                        $('.registration-form input').val('');
                        $('.reg-alert').html('<div class="alert alert-warning">' + result + '</div><?php if (Auth::check()) { ?><h3><b>Refresh page to update codes status.</b></h3><?php } ?>');
                        $('#submit-registration').fadeOut('fast');

                    }

                });
            }
        })

    });
</script>