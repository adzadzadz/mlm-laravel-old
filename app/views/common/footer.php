
<div class="container"></div>

<footer class="main-footer">
    <div class="container">
        <div class="row">
        </div>
    </div>
    <span id="backtoTop"><i class="fa fa-fw fa-angle-double-up"></i></span>
</footer>

<div class="container"></div>

<div class="post-footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                Powered by <a href="http://www.adzbitesolutions.com">Adzbite Solutions</a> © 2014
            </div>
        </div>
    </div>

</div>
</div>


<!-- scripts bellow -->

<!-- JQUERY AUTO COMPLETE -->
<?php if(isset($user_list_set)): ?>
<script>

$(function() {

    var availableTags = [

    <?php foreach ($user_list_set as $user) { ?>

       "<?= Config::get('mlm_config.id_prefix') ?><?= $user['id'] ?> <?= $user['username'] ?> <?= $user['name'] ?>",

    <?php } ?>

    ];

    $( ".get-user-list" ).autocomplete({

      { appendTo: ".search-user" }

    });

});

</script>
<?php endif; ?>

<?= HTML::script('/theme/assets/bootstrap/js/bootstrap.min.js') ?>
<?= HTML::script('/theme/assets/js/jquery.easing.1.3.js') ?>
<!-- IE -->
<?= HTML::script('/theme/assets/js/modernizr.custom.js') ?>

<!-- JS responsible for hover in touch devices -->
<?= HTML::script('/theme/assets/js/jquery.hoverIntent.js') ?>

<!-- Detects when a element is on wiewport -->
<?= HTML::script('/theme/assets/js/jquery.appear.js') ?>

<!-- Fits Videos to container -->
<?= HTML::script('/theme/assets/js/jquery.fitvids.js') ?>

<!-- Count to plugin -->
<?= HTML::script('/theme/assets/js/jquery.countTo.js') ?>

<!-- Revolution Slider -->
<?= HTML::script('/theme/assets/plugins/revslider/js/jquery.themepunch.revolution.min.js') ?>
<?= HTML::script('/theme/assets/plugins/revslider/js/jquery.themepunch.plugins.min.js') ?>

<!-- Flexslider -->
<?= HTML::script('/theme/assets/plugins/flexslider/jquery.flexslider-min.js') ?>

<!-- Thumb slider with mouse hover navigation -->
<?= HTML::script('/theme/assets/plugins/thumbscroller/jquery-ui-1.8.13.custom.min.js') ?>
<?= HTML::script('/theme/assets/plugins/thumbscroller/jquery.thumbnailScroller.js') ?>

<!-- magnific popup -->
<?= HTML::script('/theme/assets/plugins/magnificpopup/jquery.magnific-popup.min.js') ?>

<!-- Responsible for the sidebar navigation in mobile -->
<?= HTML::script('/theme/assets/js/snap.min.js') ?>

<!-- Twitter -->
<?= HTML::script('/theme/assets/twitter/js/jquery.tweet.js') ?>

<!-- Contact form validation -->
<?= HTML::script('/theme/assets/form/js/contact-form.js') ?>

<!-- our main JS file -->
<?= HTML::script('/theme/assets/js/main.js') ?>
<?= HTML::script('/chosen/chosen.jquery.min.js') ?>
<?= HTML::script('/assets/js/main.js') ?>


<!-- end scripts -->
</body>
</html>