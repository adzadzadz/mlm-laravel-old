<span id="activation-code" data-activation="<?= $activationcode ?>" style="display:none;"></span>
<span id="activation-code-master" data-activation="<?= $activationcode_master ?>" style="display:none;"></span>
<span id="toreg-direct-upline" data-upline="" style="display:none;"></span>
<section>
    <div class="row">
        <div class="col-sm-12">

    <span style="font-size: 25px;" class="pull-right"><a style="color: #000 !important;" class="fake-link" onclick="makeMemberlink( '<?= route('members',  Auth::user()->id) ?> ')"><i class="fa fa-refresh"></i></a></span>

	<div class="row level-0">
		<div class="binary-user" style="width: 100%;"><img src="<?= asset('assets/imgs/user-icon-master.png'); ?>" alt="member" class="binary-center" style="max-width: 60px !important;"> <br> <?= $lvl[Auth::user()->id]['0']['0']['0']['username'] ?></div>
	</div>
	
	<?php

		for ($level=0; $level < 3 ; $level++) {

			if($level == 0)
			{
				$counter1 = 1;
			}
			else if($level == 1)
			{
				$counter1 = 2;
			}
			else if($level == 3)
			{
				$counter1 = 8;
			}
			else
			{
				$counter1 = $level * $level;
			}

			$makegroup = -1;

			echo '<div class="row level-1">';
			for ($group=0; $group < $counter1; $group++) { 

				$prevgroup = $group;
				

				for ($position=0; $position < 2; $position++) {
					$makegroup = $makegroup + 1;
					#Start Binary Data
					
					
					if($lvl[Auth::user()->id][$level + 1][$group][$position]['id'] == null)
					{
						echo '<div class="binary-user" style="width:' . 100 / $counter1 / 2 . '%"><img onclick="chooseCode(' . $lvl[Auth::user()->id][$level +1][$group][$position]['directupline'] . ');" class="register-downline" src="' . asset('assets/imgs/user-icon-x.png') . '" alt="member" class="binary-center"></div>';
					}
					else
					{
						echo '<div class="binary-user" style="width:' . 100 / $counter1 / 2 . '%"><a class="fake-link" data-toggle="tooltip" data-placement="top" title="' . $lvl[Auth::user()->id][$level + 1][$group][$position]['id'] . " " . $lvl[Auth::user()->id][$level + 1][$group][$position]['firstname'] . ' ' . $lvl[Auth::user()->id][$level + 1][$group][$position]['middlename'] . ' ' . $lvl[Auth::user()->id][$level + 1][$group][$position]['lastname'] . '" onclick="makeMemberlink(\'' . route('members', $lvl[Auth::user()->id][$level + 1][$group][$position]['id']) . '\');"><img src="' . asset('assets/imgs/user-icon.png') . '" alt="member" class="binary-center"> <br>' . $lvl[Auth::user()->id][$level + 1][$group][$position]['username'] . '</a></div>';
					}
					
					#END FOREACH
				}
			}
			echo '</div>';
		}

	?>
</div>

<!-- CONFIRM CHANGES MODAL -->
<div class="modal fade" id="membertree-choose-code" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="su-review-changes small-modal-margin">
            <strong>Choose Account Type</strong>
            <div class="form-group small-modal-margin">
                <div class="radio <?php if ($codesavailable_master < 1) echo 'disabled'; ?>">
                <label>
                <input type="radio" name="optionsRadios" id="membertree-reg-master" value="" <?php if ($codesavailable_master > 0) echo 'checked'; ?>  <?php if ($codesavailable_master < 1) echo 'disabled'; ?>>
                Master (Available: <?= $codesavailable_master ?>)
                </label>
                </div>
                <div class="radio <?php if ($codesavailable < 1) echo 'disabled'; ?>">
                <label>
                <input type="radio" name="optionsRadios" id="membertree-reg-regular" value="" <?php if ($codesavailable < 1) echo 'disabled'; ?>>
                Regular (Available: <?= $codesavailable ?>)
                </label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button id="membertree-continue-registration" class="btn-sm btn btn-danger btn-block">Continue</button>
        </div>
    </div>
  </div>
</div>
<!-- CONFIRM CHANGES MODAL -END- -->


<!-- Register Modal -->
<div class="modal fade" id="membertree_register_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Registration</h4>
            </div>
            <div class="modal-body">.
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Register Modal - END-->


<?php echo View::make('common.sidebar-right', array( 'page_title' => $page_title))->render(); ?>

<script>
$(document).ready(function () {

    $('#membertree-continue-registration').click(function () {
        var activationcode = '';

        if ($('#membertree-reg-master').is(':checked')) {
            code = $('#activation-code-master').data('activation');
        }
        if ($('#membertree-reg-regular').is(':checked')) {
            code = $('#activation-code').data('activation');
        }

        getRegistrationForm(code);
        $('#membertree-choose-code').modal('toggle');
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
                $('#membertree_register_modal .modal-body').html(result);
                $('#membertree_register_modal').modal('toggle');
                $('#direct_upline').val($('#toreg-direct-upline').data('upline'));
            }
        });            
    }

    $("#check-bank").change(function () {
        if ($('#check-bank').is(':checked')) {
            $('#form-bank').show('fast');
        }
        else {
             $('#form-bank').hide('fast');
        }
    });
});    
</script>

