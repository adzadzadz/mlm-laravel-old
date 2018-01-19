<section class="call-box bg3">
    <div class="inner">
        <div class="container">
            <div class="row">
                <div class="table-cell col-md-9">
                    
                    <h2>Welcome!</h2>
                    
                    <p>
                        This is your dashboard. Here is where you will see your <strong>registration codes, earnings and members</strong>.
                    </p>
                </div>
                <div class="table-cell col-md-3 text-right">
                    
                </div>
            </div>

        </div>
    </div>
</section>

<div class="container">
<br>
<br>
<h3>
<?php if(Auth::user()->im_master == true) { ?>
<strong style="color: red; ">Master Account</strong> | 
<?php } ?>
  (<?= Auth::user()->username ?> - <?= Config::get("mlm_config.id_prefix") . Auth::user()->id ?>) <strong><?= Auth::user()->firstname . ' ' . Auth::user()->middlename . ' ' . Auth::user()->lastname ?></strong>
</h3>
<!--<h4><strong style="color: red; ">Direct Referrals:  <?= $direct_upline_count ?> </strong> <br>Note: You must have at least 10 direct referrals to qualify for the bonus.</h4>-->
</div>  

<section class="container">
    
    <div class="row">
        <div class="col-sm-8 col-md-9">
            <div class="row">
            <!-- <h3><b>Select Options</b></h3> -->
            <div class="panel-group" id="accordion">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a id="show-codes-module" data-status='0' class="btn btn-sm btn-success" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" style="color: #fff !important;">
                      <i class="fa fa-pencil"></i> Codes Area
                    </a> 
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="pull-right"><i class="fa fa-chevron-down"></i></a>
                  </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse">
                  <div class="panel-body codes-generator">
                    <div class="text-center">
                      <img class="loader" src='<?= asset("assets/imgs/loading-img.gif") ?>' alt="Loading" />
                    </div>
                  </div>
                </div>
              </div>
              
              <?php if (Auth::user()->im_master == true) { ?>
                
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a id="show-childrenaccounts-module" data-status='0' class="btn btn-sm btn-success" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" style="color: #fff !important;">
                      <i class="fa fa-users"></i> Slave Accounts 
                    </a>
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="pull-right"><i class="fa fa-chevron-down"></i></a>
                  </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse">
                  <div class="panel-body childrenaccounts">
                    <div class="text-center">
                     <img class="loader" src='<?= asset("assets/imgs/loading-img.gif") ?>' alt="Loading" />
                    </div>
                  </div>
                </div>
              </div>

              <?php } ?>

              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a id="show-membertree"  data-status="0" class="btn btn-sm btn-success" data-toggle="collapse" data-parent="#accordion" href="#collapsemembertree" style="color: #fff !important;">
                      <i class="fa fa-users"></i> Genealogy
                    </a>
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapsemembertree" class="pull-right"><i class="fa fa-chevron-down"></i></a>
                  </h4>
                </div>
                <div id="collapsemembertree" class="panel-collapse collapse">
                  <div class="panel-body membertree">
                    
                    <div class="genealogy-option">
                      <div class="radio">
                        <label>
                          <input type="radio" name="optionsRadios" id="genealogy-option-1" value="option1">
                          Genealogy
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="optionsRadios" id="genealogy-option-2" value="option2">
                          Unilevel
                        </label>
                      </div>
                    </div>

                    <div class="genealogy-content" style="display:none;">
                      <div class="text-center">
                        <img class="loader" src='<?= asset("assets/imgs/loading-img.gif") ?>' alt="Loading" />
                      </div>
                    </div>

                  </div>
                </div>
              </div>

              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a class="btn btn-sm btn-success" data-toggle="collapse" data-parent="#accordion" href="#collapsethree" style="color: #fff !important;">
                      <i class="fa fa-users"></i> Statement
                    </a>
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapsethree" class="pull-right"><i class="fa fa-chevron-down"></i></a>
                  </h4>
                </div>
                <div id="collapsethree" class="panel-collapse collapse in">
                  <div class="panel-body unilevel">
                    <ul class="nav nav-tabs" role="tablist" id="myTab">
                      <li role="presentation" class="active"><a href="#unilevel-statement-content" aria-controls="unilevel-statement-content" role="tab" data-toggle="tab">Unilevel</a></li>
                      <li role="presentation"><a href="#cns-statement-content" aria-controls="cns-statement-content" role="tab" data-toggle="tab" id="cns-statement-trigger">CNS</a></li>
                    </ul>
                    <div class="tab-content">
                      <div role="tabpanel" class="tab-pane active" id="unilevel-statement-content">
                        <div class="text-center">
                          <img class="loader" src='<?= asset("assets/imgs/loading-img.gif") ?>' alt="Loading" />
                        </div>
                      </div>
                      <div role="tabpanel" class="tab-pane" id="cns-statement-content">
                        <div class="text-center">
                          <img class="loader" src='<?= asset("assets/imgs/loading-img.gif") ?>' alt="Loading" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            </div>
        </div>
        
   
<script>
  $(document).ready(function () {
      $('#show-codes-module').click(function () {
        if($('#show-codes-module').attr('data-status') == 0){
          $.ajax({
            url:"<?= route('showcodesmodule') ?>",
            type: 'POST',
            success:function(result){
              $('#show-childrenaccounts-module').attr('data-status', 1);
              $('.codes-generator').html(result);
            }
          });
        }
      });
  });
</script>

<?php if (Auth::user()->im_master == true) { ?>
<script>
  $(document).ready(function () {
      $('#show-childrenaccounts-module').click(function () {
        if($('#show-childrenaccounts-module').attr('data-status') == 0){
          $.ajax({
            url:"<?= route('getchildrenaccounts') ?>",
            type: 'GET',
            success:function(result){
              $('#show-childrenaccounts-module').attr('data-status', 1);
              $('.childrenaccounts').html(result);
            }
          });
        }
      });
  });
</script>
<?php } ?>

<script>
  $(document).ready(function () {
      $('#genealogy-option-1').click(function () {
        if($('#show-membertree').attr('data-status') == 0){
          $.ajax({
            url:"<?= route('members', Auth::user()->id); ?>",
            type: 'POST',
            success:function(result){
              $('.genealogy-content').html(result);
              $('.genealogy-content').show();
            }
          });
        }
      });

      $('#genealogy-option-2').click(function () {
        if($('#show-membertree').attr('data-status') == 0){
          $.ajax({
            url:"<?= route('getUnilevel', Auth::user()->id); ?>",
            type: 'POST',
            success:function(result){
              $('.genealogy-content').html(result);
              $('.genealogy-content').show();
            }
          });
        }
      });
  });
</script>

<script>
  $(document).ready(function () {
    $.ajax({
      url:"<?= route('getUnilevelStatement', Auth::user()->id) ?>",
      type: 'GET',
      success:function(result){
        $('#unilevel-statement-content').html(result);
      }
    });
    $('#cns-statement-trigger').click(function () {
      $.ajax({
        url:"<?= route('getCnsstatement', Auth::user()->id) ?>",
        type: 'GET',
        success:function(result){
          $('#cns-statement-content').html(result);
        }
      });
    });    
  });
</script>