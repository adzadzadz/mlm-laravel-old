<div class="row">
	<div class="activation-codes col-md-12 col-sm-12">
		<div class="jumbotron">
			<div class="form" style="text-align: center;">
				<div class="alert alert-success">You have <?= Auth::user()->codecount ?> Codes ready to generate.</div>
				<div class="alert alert-warning">You have <?= Auth::user()->codecount_master ?> Master Account Codes ready to generate.</div>
				<button class="btn btn-lg btn-primary" id="generate-codes">GENERATE CODES NOW!</button>
				<br><div class="info alert alert-danger" style="display:none;"></div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="activation-codes col-md-12 col-sm-12">
		<div class="jumbotron">
			<div class="title">
				<h3><strong>Available Codes</strong></h3>
			</div>
			<table class="activation-codes table table-hover">
				<thead>
					<tr>
						<td>Member Type</td>
						<td>Code</td>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($codes as $code) { ?>
					<tr>
						<td><?php if($code['membertype'] == 1) { echo 'Master'; } else {echo 'Regular'; } ?></td>
						<td><?= $code['activationcode'] ?></td>
					</tr>
				<?php } ?>
					
				</tbody>
			</table>
		</div>
	</div>
</div>




<script>

	$(document).ready(function () {
		
		$('#generate-codes').click(function () {

			<?php if ((Auth::user()->codecount < 1) && (Auth::user()->codecount_master < 1)) { ?>

				$('div.info').html('Please order codes to generate.').slideDown('fast');

			<?php } else { ?>

			$.ajax({
				url:"<?= route('generatecodes') ?>",
				type: 'POST',
				data: {
					membertype : 'member',
				},
				beforeSend:function(){
					$('.generate-form-btn').html('<button class="btn btn-lg btn-primary"> Generating codes</button>');

				},
				success:function(result){
				    $('.form').slideUp('fast');
				    $('.generate-form-btn').html('<button class="btn btn-lg btn-primary">' + result + '</button>');

				    location.reload(true); 
				}
			});

			<?php } ?>

		});
		
		
	});
	
</script>

