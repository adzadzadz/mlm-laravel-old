<section class="page">
	<div class="container">
		<div class="col-sm-5">
			<button id="su-update-all-earnings" class="btn btn-lg btn-danger btn-block">UPDATE ALL USER'S EARNINGS NOW! </button>
			<br><br>
			<div class="form-group">
				<textarea id="update-earnings-results" id="" cols="30" rows="10" class="form-control" disabled></textarea>
			</div>
		</div>
	</div>
</section>

<script>
	$(document).ready(function () {
		var text_earnings_stack = '';
		$('#su-update-all-earnings').click(function () {
			<?php foreach ($users as $user) { ?>
				
				$.ajax({
		            url:"<?= route('updateuserearnings', $user['id']) ?>",
		            type: 'POST',
		            data: {},
		            beforeSend:function(){},
		            success:function(result){
		            	text_earnings_stack += result;
		                $('#update-earnings-results').html(text_earnings_stack);
		                $('#update-earnings-results').scrollTop($('#update-earnings-results')[0].scrollHeight);
		            }
		        });    

	        <?php } ?>  
		});

	});
</script>

<!-- &#13;&#10; -->