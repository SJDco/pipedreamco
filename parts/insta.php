<section class="insta">
    <div class="row text-center">
        <div class="small-12 columns">
            <p style="margin-bottom: 0;">
                <span class="highlight uppercase">Follow us on Instagram</span>
                <a style="color: black;" href="<?php echo get_option('instagram_url'); ?>">@pipedreamco</a>
            </p>
            <p style="color: #aaa; margin-top: 0;">
                #pipedreamco
            </p>
        </div>
    </div>
    <div class="row">
        <div class="small-12 columns">
            <?php echo wdi_feed(array('id'=>'1')); ?>
        </div>
    </div>
</section>