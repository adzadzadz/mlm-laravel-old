<div class="member-vp-allocation">
    <ul class="nav nav-pills nav-stacked">
        <div class="panel-group superuser-navigation" id="vp-accordion">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h5 class="panel-title">
                <a class="btn btn-sm btn-danger btn-vp-allocation" data-toggle="collapse" data-parent="#vp-accordion" href="#vp-allocation" style="color: #fff !important;">
                  <span class="glyphicon glyphicon-pencil"></span> VP Allocation
                </a> 
                <a data-toggle="collapse" data-parent="#vp-accordion" href="#vp-allocation" class="pull-right btn-vp-allocation"></a>
              </h5>
            </div>
            <div id="vp-allocation" class="panel-collapse collapse">
              <div class="panel-body">
                <div class="form-group">
                    <label for="vp-reciever-id">User ID</label>
                    <select class="form-control" data-placeholder="Choose a user" id="vp-reciever-id">
                        <option value=""></option>
                        <?php foreach ($users as $user_list) { ?>
                            <option value="<?= $user_list['id'] ?>"><?= Config::get('mlm_config.id_prefix') ?><?= $user_list['id'] ?> "<?= $user_list['username'] ?>" <?= $user_list['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="vp-allocation-count">Number of VP</label>
                    <input class="form-control" type="number" id="vp-allocation-count" placeholder="Input numbers only">
                </div>
                <div id="vp-allocation-alert" class="alert alert-success" role="alert" style="display:none;"></div>
                <button class="btn btn-primary btn-sm pull-right" id="submit-vp-allocation">Submit</button>
                
                <br>
                <hr style="clear:both;">

                <h4><b>Recent Allocations</b></h4>
                <table id="recent-allocations" class="table .table-hover">
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

        // $('.btn-vp-allocation').click(function () {
        //     getRecentAllocations();
        // });

        // Submit code allocation 
        $('#submit-vp-allocation').click(function () {
            submitCodes();
        });

        function submitCodes() {
            var id = $('#vp-reciever-id').val();
            var count = $('#vp-allocation-count').val();

            $.ajax({
                url:"<?= route('addvp') ?>",
                type: 'POST',
                data: {
                    id: id,
                    count: count,
                },
                before:function(){

                },
                success:function(result){
                    $('#vp-allocation-alert').html(result).fadeIn('fast').delay('5000').slideUp('slow');
                    getRecentAllocations();
                }

            });
        }

        // function getRecentAllocations() {
        //     $.ajax({
        //         url:"<?= route('getAllocations') ?>",
        //         type: 'POST',
        //         data: {
        //         },
        //         before:function(){

        //         },
        //         success:function(result){
        //             var htmldata = '';
        //             var data = JSON.parse(result);
        //             $.each(data, function(i, item) {
        //                 htmldata += '<tr><td><?= Config::get("mlm_config.id_prefix")?>' + item.executed_by + '</td><td>' + item.quantity + '</td><td><?= Config::get("mlm_config.id_prefix")?>' + item.executed_for + '</td></tr>';
        //             });

        //             $('#recent-allocations tbody').html(htmldata);
        //         }

        //     });
        // }

    });
</script>