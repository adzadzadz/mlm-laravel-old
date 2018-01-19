<div class="bg-gray">
	<div class="row">
		<div class="col-sm-12 earnings">
			<div class="icon-counter animated" data-fx="pulse">
				<span>
					<h2>PHP</h2>
				</span>
		        <span class="counter hr-mid" data-to="<?= $earnings ?>">
		           0
		        </span>
		        <span class="description">
                    <h3>Earnings</h3>
                </span>
		    </div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<button id="btn-withdraw" class="btn btn-lg btn-danger btn-block"  data-toggle="modal" data-target="#withdrawal-modal">WITHDRAW</button>
		</div>
	</div>
</div>
<div>
	<div class="row">
		<div class="col-sm-12">
			<p>Note: Earnings displayed are accumulated from earnings of all children accounts (Including this account) that can be seen under the Children Accounts tab on the dashboard.</p>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="withdrawal-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
		<div>
			<h2><small>Available Balance:</small> <span class="withdraw-earnings">P <?= $earnings ?>.00</span></h2>
			<strong>Reminders:</strong> <br>
			*You need a minimum of <strong>P<?= $withdraw_min_limit ?>.00</strong> to withdraw. <br>
			*Always correct profile details and gateway information as it will be used on withdrawal requests.
		</div>
		<br>
		<div class="form-group">
			<div class="input-group">
				<div class="input-group-addon"> 
			    <label class="checkbox-inline">Withdraw all
			      <input type="checkbox" id="check-withdraw-all" checked> 
			    </label>
  				</div>
				<input id="withdraw-amount" class="form-control" type="number" placeholder="Enter Amount in Philippine Peso" value="<?= $earnings ?>" disabled>
			</div>
		</div>

		<div>
			<strong>Gateway Options:</strong>
			<?php

				if (isset($bankinfo)) 
				{
					if($bankinfo['b_palawan'] == '')
					{
						if ($bankinfo['b_western'] == '') 
						{
							if ($bankinfo['b_bank'] == '') 
							{
								echo 'You need to update your bank information before withdrawal.';
								echo '<br>';
								echo 'You need to go to your <a href="' . route('profile')  . '">PROFILE</a> and do the update. Thank you.';
							}
						}
					}
					else
					{
						echo '<div class="radio"><label><input type="radio" name="gateway_opt" id="sendto_palawan" value="b_palawan" checked>Palawan Pawnshop</label></div>';
					}
					if ($bankinfo['b_western'] != '')
					{
						echo '<div class="radio"><label><input type="radio" name="gateway_opt" id="sendto_western" value="b_western" >Mlhullier (Western Union)</label></div>';
					}
					if ($bankinfo['b_bank'] != '')
					{
						echo '<div class="radio"><label><input type="radio" name="gateway_opt" id="sendto_bank" value="b_bank" >Bank</label></div>';
					}
				}
				else
				{
					echo 'You need to update your bank information before withdrawal.';
					echo '<br>';
					echo 'You need to go to your <a href="' . route('profile')  . '"><strong>PROFILE</strong></a> and do the update. Thank you.';
				}

			?>
		</div>
		<div class="modal-footer">
	        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	        <?php

				if (isset($bankinfo)) 
				{
					if($bankinfo['b_palawan'] == '')
					{
						if ($bankinfo['b_western'] == '') 
						{
							if ($bankinfo['b_bank'] == '') 
							{
								echo '<button id="confirm-withdrawal-request" type="button" class="btn btn-primary" disabled ?>Confirm Request</button>';
							}
						}
					}
					if ($bankinfo['b_palawan'] != '' || $bankinfo['b_western'] != '' || $bankinfo['b_bank'] != '')
					{ ?>
						<button id="confirm-withdrawal-request" type="button" class="btn btn-primary" <?php if($earnings < 1) echo 'disabled'; if($withdraw_min_limit > $earnings) echo 'disabled';?>>Confirm Request</button>
			<?php   } 
				}
				else
				{
					echo '<button id="confirm-withdrawal-request" type="button" class="btn btn-primary" disabled ?>Confirm Request</button>';
				}

			?>	        
      	</div>
      </div>
    </div>
  </div>
</div>

<script>
	$(document).ready(function () {
		var gateway = '';
		if($('#sendto_palawan').is(':checked')){
			var gateway = $('#sendto_palawan').val();
		}
		if($('#sendto_western').is(':checked')){
			var gateway = $('#sendto_western').val();
		}
		if($('#sendto_bank').is(':checked')){
			var gateway = $('#sendto_bank').val();
		}
		
		$('#check-withdraw-all').change(function () {
			if ($('#check-withdraw-all').is(':checked')) {
				$('#withdraw-amount').val('<?= $earnings ?>');
			}
			if (!$('#check-withdraw-all').is(':checked')) {
				$('#withdraw-amount').val('');
			}
		});		

		$('#confirm-withdrawal-request').click(function () {
			if ($('#check-withdraw-all').is(':checked')) {
				var request = 'all';
			}
			else {
				var request = $('#withdraw-amount').val();
			}

			$.ajax({
                url:"<?= route('requestwithdrawal') ?>",
                type: 'POST',
                data: {
                	request : request,
                	gateway : gateway,
                },
                beforeSend:function(){
                	$('#withdrawal-modal .modal-body').html('<img class="small-loader" src=\'<?= asset("assets/imgs/loading-img.gif") ?>\' alt="Loading" /><br><h2>Please wait...</h2>');
                },
                success:function(result){
                	$('#withdrawal-modal .modal-body').html(result);
                }

            });
		});
	});
</script>