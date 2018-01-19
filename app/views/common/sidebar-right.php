<div class="col-sm-4 col-md-3 sidebar">
    <div class="row">
        <div class="col-sm-12 earnings">
        <?php 
	        if ($page_title == 'Home') 
	        { 
                echo View::make('earnings.earnings', array(
                    'earnings' => $earnings, 
                    'bankinfo' => $bankinfo,
                    'withdraw_min_limit' => $withdraw_min_limit,
                ))->render();  
	        } 
        ?>
        </div>
        <div class="col-sm-12">
            
        </div>
        <div class="col-sm-12">
          
        </div>
        
    </div>
</div>
</div>
</section>

<div class="container"></div>

