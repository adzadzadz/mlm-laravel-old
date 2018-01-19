<div class="container">
	<strong><h3 class="current-group-label" style="color: red;"><?php if ($affiliate_to_edit != '') { echo ucfirst($affiliate_to_edit->group); } ?></h3></strong>
</div>

<section class="page">	
	<div class="container">
		<div class="row">
			<div class="col-sm-8">
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
						    <input id="affiliate-name" type="text" class="form-control input-lg" placeholder="Name" value="<?php if ($affiliate_to_edit != '') { echo $affiliate_to_edit->name; } ?>" required>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
						    <textarea id="affiliate-description" class="form-control" rows="10" style="resize: none;" placeholder="Description" required><?php 

									if ($affiliate_to_edit != '') {
										echo $affiliate_to_edit->description;
									}

							?></textarea>
						</div>
					</div>
				</div>		

				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
						    <textarea id="affiliate-contact" class="form-control" rows="5" style="resize: none;" placeholder="Contact" required><?php 

									if ($affiliate_to_edit != '') {
										echo $affiliate_to_edit->contact;
									}

							?></textarea>
						</div>
					</div>
				</div>	
			</div>
			<div class="col-sm-4">

				<div class="row">
					<div class="col-sm-12">
						<button id="su-affiliate-publish" type="button" class="btn btn-primary btn-lg btn-block"><?php if ($affiliate_to_edit != '') { ?> Update <?php } else { ?> Publish <?php } ?></button>
					</div>
				</div>  

				<div class="row">
					<div class="col-sm-12">
						<div id="accordion" class="panel-group accordion">
					        <div class="panel">
					            <div class="panel-heading">
					                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" class="">
					                    Groups
					                </a>
					            </div>
					            <div id="collapse1" class="panel-collapse collapse in" style="height: auto;">
					                <div class="panel-body">
								        <div class="row hr-mid">
						                	<div class="col-sm-12">
						                		<div class="input-group input-group-lg">
						                			<label for="su-affiliate-group-selector"><strong>Select Group</strong></label>
							                		<select class="form-control" id="su-affiliate-group-selector">
								                		<?php foreach ($affiliate_groups as $group) { ?>
								                			<option value="<?= $group->name ?>"><?= ucfirst($group->name) ?></option>
								                		<?php }	?>
							                		</select>
							                		<input type="hidden" id="su-current-post-group" value="<?php if ($affiliate_to_edit != '') { echo $affiliate_to_edit->group; } ?>">
						                		</div>
						                	</div>
						                	<div class="col-sm-12">
						                		<button id="su-affiliate-group-use" class="btn btn-md btn-primary pull-right">Use</button>
						                	</div>
						                </div>

						                <div class="row">
						                	<div class="col-sm-12">
							                	<div class="input-group input-group-lg form-group-float-label">
							                		<strong>Add Group</strong>
						                            <input id="affiliate-group-name" class="form-control" type="text" required=''>
						                            <label for="affiliate-group-name">Group</label>
						                        </div>
						                	</div>
						                	<div class="col-sm-12">
						                		<button id="su-affiliate-group-publish" class="btn btn-md btn-primary pull-right">Add</button>
						                	</div>
						                </div>

					                </div>
					            </div>
					        </div>
					        <!-- <div class="panel">
					            <div class="panel-heading">
					                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2" class="collapsed">
					                    This is Inactive Accordion Tab
					                </a>
					            </div>
					            <div id="collapse2" class="panel-collapse collapse">
					                <div class="panel-body">
					                    <strong>This is content</strong><br>
					                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue, suscipit a, scelerisque sed, lacinia in, mi.
					                </div>
					            </div>
					        </div> -->
					    </div>
					</div>
				</div>

			</div>
		</div>
	</div>
</section>

<div class="container"></div>

<script>
	$(document).ready(function () {
		$('#su-affiliate-group-use').click(function () {
			$('#su-current-post-group').val($('#su-affiliate-group-selector').val());
			$('.current-group-label').html($('#su-affiliate-group-selector').val());
		});
	});
</script>
	

<script>
	$(document).ready(function () {
		$('#su-affiliate-publish').click(function () {

			var group = $('#su-current-post-group').val(),
				name = $('#affiliate-name').val(),
				description = $('#affiliate-description').val(),
				contact = $('#affiliate-contact').val();

			$.ajax({
	            url:"<?php 
				if ($affiliate_to_edit != '') {
					echo route('suupdateaffiliate', $id);
				} else { 
		            echo route('suaddaffiliates'); 
				} ?>",
	            type: 'POST',
	            data: {
	            	group : group,
	            	name : name,
	            	description : description,
	            	contact : contact,
	            },
	            beforeSend:function(){},
	            success:function(result){
	            	alert(result);
	            	location.reload();
	            }
	        });
		});
	});
</script>

<script>
	$(document).ready(function () {
		$('#su-affiliate-group-publish').click(function () {

			var name = $('#affiliate-group-name').val(),
				description = '';

			$.ajax({
	            url:"<?= route('suaddaffiliatesgroup'); ?>",
	            type: 'POST',
	            data: {
	            	name : name,
	            	description : description,
	            },
	            beforeSend:function(){},
	            success:function(result){
	            	alert(result);
	            	location.reload();
	            }
	        });
		});
	});
</script>