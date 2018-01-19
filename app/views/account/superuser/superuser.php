<?= View::make('common.header', array('page_title' => $page_title))->render(); ?>
<section class="call-box bg3">
    <div class="inner">
        <div class="container">
            <div class="row">
                <div class="table-cell col-md-9">
                    
                    <h2><?= $page_title ?></h2>
                    
                </div>
                <div class="table-cell col-md-3 text-right">
                    
                </div>
            </div>

        </div>
    </div>
</section><br>

<?= $content ?>

<?= View::make('common.footer')->render(); ?>