<div class="member-codes-allocation">
    <ul class="nav nav-pills nav-stacked">
        <div class="panel-group superuser-navigation" id="superuser-accordion">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h5 class="panel-title">
                <a class="btn btn-sm btn-danger btn-codes-allocation-free" data-toggle="collapse" data-parent="#superuser-accordion" href="#codes-allocation" style="color: #fff !important;">
                  <span class="glyphicon glyphicon-pencil"></span> Codes Allocation - Free Accounts
                </a> 
                <a data-toggle="collapse" data-parent="#superuser-accordion" href="#codes-allocation" class="pull-right btn-codes-allocation"></a>
              </h5>
            </div>
            <div id="free-codes-allocation" class="panel-collapse collapse">
              <div class="panel-body">
                <div class="form-group">
                    <label for="code-reciever-id-free">User ID</label>
                    <select class="form-control" data-placeholder="Choose a user" id="code-reciever-id-free">
                        <option value=""></option>
                        <?php foreach ($users as $user_list) { ?>
                            <option value="<?= $user_list['id'] ?>"><?= Config::get('mlm_config.id_prefix') ?><?= $user_list['id'] ?> "<?= $user_list['username'] ?>" <?= $user_list['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="code-allocation-count-free">Number of Codes</label>
                    <input class="form-control" type="number" id="code-allocation-count-free" placeholder="Input numbers only">
                </div>
                <div id="code-allocation-alert-free" class="alert alert-success" role="alert" style="display:none;"></div>
                <button class="btn btn-primary btn-sm pull-right" id="submit-code-allocation-free">Submit</button>
                
                <br>
                <hr style="clear:both;">

                <h4><b>Recent Allocations</b></h4>
                <table id="recent-allocations-free" class="table .table-hover">
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

        $('.btn-codes-allocation-free').click(function () {
            getRecentAllocations();
        });

        // Submit code allocation 
        $('#submit-code-allocation-free').click(function () {
            submitCodes();
        });

        function submitCodes() {
            var id = $('#code-reciever-id-free').val();
            var count = $('#code-allocation-count-free').val();

            $.ajax({
                url:"<?= action('CodesController@allocateCodes') ?>",
                type: 'POST',
                data: {
                    id: id,
                    count: count,
                },
                before:function(){

                },
                success:function(result){
                    $('#code-allocation-alert-free').html(result).fadeIn('fast').delay('5000').slideUp('slow');
                    getRecentAllocations_free();
                }

            });
        }

        function getRecentAllocations_free() {
            $.ajax({
                url:"<?= route('getAllocations_free') ?>",
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

                    $('#recent-allocations-free tbody').html(htmldata);
                }

            });
        }

    });
</script>