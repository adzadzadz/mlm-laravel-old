<div class="master-codes-allocation">
    <ul class="nav nav-pills nav-stacked">
        <div class="panel-group superuser-navigation" id="mastercodesallocation-accordion">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h5 class="panel-title">
                <a class="btn btn-sm btn-danger btn-codes-allocation-master" data-toggle="collapse" data-parent="#mastercodesallocation-accordion" href="#master-codes-allocation" style="color: #fff !important;">
                  <span class="glyphicon glyphicon-pencil"></span> Codes Allocation - Master Accounts
                </a> 
                <a data-toggle="collapse" data-parent="#mastercodesallocation-accordion" href="#codes-allocation" class="pull-right btn-codes-allocation"></a>
              </h5>
            </div>
            <div id="master-codes-allocation" class="panel-collapse collapse">
              <div class="panel-body">
                <div class="form-group">
                    <label for="code-reciever-id-master">User ID</label>
                    <select id="code-reciever-id-master" data-placeholder="Choose a user" class="form-control" name="code-reciever-id-master">
                        <option value=""></option>
                        <?php foreach ($users as $user_list) { ?>
                            <option value="<?= $user_list['id'] ?>"><?= Config::get('mlm_config.id_prefix') ?><?= $user_list['id'] ?> "<?= $user_list['username'] ?>" <?= $user_list['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="code-allocation-count-master">Number of Codes</label>
                    <input class="form-control" type="number" id="code-allocation-count-master" placeholder="Input numbers only">
                </div>
                <div id="code-allocation-alert-master" class="alert alert-success" role="alert" style="display:none;"></div>
                <button class="btn btn-primary btn-sm pull-right" id="submit-code-allocation-master">Submit</button>
                
                <br>
                <hr style="clear:both;">

                <h4><b>Recent Allocations</b></h4>
                <table id="recent-allocations-master" class="table .table-hover">
                    <thead>
                        <tr>
                            <td>From</td>
                            <td>Count</td>
                            <td>To</td>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
    </ul>
</div>

<!-- FETCH IDs for code allocation -->
<script>
    $(document).ready(function () {
        
        $('.btn-codes-allocation-master').click(function () {
            getRecentAllocations_master();
        });

        // Submit code allocation 
        $('#submit-code-allocation-master').click(function () {
            submitCodes();
        });

        function submitCodes() {
            var id = $('#code-reciever-id-master').val();
            var count = $('#code-allocation-count-master').val();

            $.ajax({
                url:"<?= route('allocatecodes_master') ?>",
                type: 'POST',
                data: {
                    id: id,
                    count: count,
                },
                before:function(){

                },
                success:function(result){
                    $('#code-allocation-alert-master').html(result).fadeIn('fast').delay('5000').slideUp('slow');
                    getRecentAllocations_master();
                }

            });
        }

        function getRecentAllocations_master() {
            $.ajax({
                url:"<?= route('getAllocations_master') ?>",
                type: 'POST',
                data: {
                },
                before:function(){

                },
                success:function(result){
                    var htmldata = '';
                    var data = JSON.parse(result);
                    $.each(data, function(i, item) {
                        htmldata += '<tr><td><?= Config::get("mlm_config.id_prefix")?>' + item.executed_by + '</td><td>' + item.quantity + '</td><td><?= Config::get("mlm_config.id_prefix")?>' + item.executed_for + '</td></tr>';
                    });

                    $('#recent-allocations-master tbody').html(htmldata);
                }

            });
        }

    });
</script>