<?= View::make('common.header', array('page_title' => $page_title))->render(); ?>

<div class="container"></div>
<?php //strtolower(); ?>
<section class="section">
		<div class="container">
			<h3 class="hr-left">Affiliate List</h3>
            <h1><?= ucfirst($group) ?></h1>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <td>Area</td>
                        <td>Address</td>
                        <td>Contact</td>
                        <?php if (Auth::check()) {   ?>
                            <?php if(Auth::user()->im_master == true) { ?>

                                <td>Action</td>
                                
                            <?php } ?>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($affiliates as $each) { ?>
                    <tr>
                        <td><?= $each->name ?></td>
                        <td><?= $each->description ?></td>
                        <td><?= $each->contact ?></td>
                        <?php if (Auth::check()) {   ?>
                            <?php if(Auth::user()->im_master == true) { ?>
                                <td><a href="<?= route('suaffiliates', $each->id) ?>">Edit</a> / <a href="<?= route('sudeleteaffiliate', $each->id) ?>">Delete</a></td>
                            <?php } ?>
                        <?php } ?>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
</section>



<div class="container"></div>

<?= View::make('common.footer')->render(); ?>