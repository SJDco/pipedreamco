<?php get_template_part('parts/seperator'); ?>

<?php get_template_part('parts/insta'); ?>

<?php get_template_part('parts/seperator'); ?>

<section class="sitemap">
    <div class="row">

        <div class="medium-4 large-3 large-offset-2 columns">
            <h5>Need Help</h5>

            <?php wp_nav_menu( array(
                'theme_location' => 'need-help-menu',
                'items_wrap' => '%3$s'
            ) ); ?>

        </div>

        <div class="medium-4 large-3 columns">
            <h5>Company</h5>

            <?php wp_nav_menu( array(
                'theme_location' => 'company-menu',
                'items_wrap' => '%3$s'
            ) ); ?>

        </div>

        <div class="medium-4 large-3 columns end">
            <img class="sitemap__logo" src="<?php echo get_template_directory_uri(); ?>/images/pipedream-logo.svg" alt="Pipedream Co Logo" />
            <li><a href="mailto:info@pipedreamco.com.au"></a></li>
            <li><a href="#">#pipedreamco</a></li>
            <ul class="social-links">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
            </ul>
        </div>

    </div>
</section>

<?php get_template_part('parts/seperator'); ?>

<footer class="footer">
    <div class="row">
        <div class="small-12 columns">
            <p class="text-center">Copyright Pipedream Co. <?php echo Date('Y'); ?></p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

</body>

</html>