<div>
	<h4>You have requested withdrawal for the following accounts.</h4>
	<table id="withdrawal_request_table" class="table table-hover">
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
			<tr id="self">
				<td><?= Config::get('mlm_config.id_prefix') ?><?= $self['user_id'] ?></td>
				<td><?= $self['username'] ?></td>
				<td><?= $self['request'] ?></td>
				<td><?= $self["gateway"] ?></td>
				<td><?= $self['status'] ?></td>
			</tr>
			<?php if(Auth::user()->im_master == 1) 
			{
				$counter_w = 0;
				foreach ($childrenaccounts as $account) 
				{	
					 $counter_w = $counter_w + 1; ?>
				
					<tr id="withdraw_request_<?= $counter_w ?>">
						
					</tr>
			
			<?php	

				}
			} 

			?>
		</tbody>
	</table>
</div>
<div class="modal-footer">
	<button class="btn-primary btn" id="withdrawal-receipt-done">Done</button>
</div>

<script>
	$(document).ready(function () {
		$('#withdrawal-receipt-done').click(function () {
			location.reload(true); 
		});
	});
</script>

<script>
	$(document).ready(function () {
		<?php if(Auth::user()->im_master == 1) 
		{
			$counter_w = 0;
			foreach ($childrenaccounts as $account) 
			{	 
				$counter_w = $counter_w + 1; ?>
		
				$.ajax({
		            url:"<?= route('childrenwithdrawalrequest') ?>",
		            type: 'POST',
		            data: {
		            	user_id : <?= $account['id'] ?>,
		            	gateway : '<?= $self["gateway"] ?>'
		            },
		            beforeSend:function(){
		            	$('#withdraw_request_<?= $counter_w ?>').html('<img class="small-loader" src=\'<?= asset("assets/imgs/loading-img.gif") ?>\' alt="Loading" />');
		            },
		            success:function(result){

		            	var obj = JSON.parse(result);

		            	$('#withdraw_request_<?= $counter_w ?>').html('<td><?= Config::get("mlm_config.id_prefix") ?>' + obj.user_id + '</td><td>' + obj.username + '</td><td>' + obj.request + '</td><td>' + obj.gateway + '</td><td>' + '<b>' + obj.status + '</b></td>');
		            }

		        });

		<?php	

			}
		} 

		?>
	});
</script>