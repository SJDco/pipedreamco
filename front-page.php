<?php get_header(); ?>

<?php get_template_part('parts/hero-slider'); ?>

<?php get_template_part('parts/site-notification'); ?>

<section class="featured">
    <div class="row row--gutter-half">

        <?php for ($i=0; $i < 2; $i++) : ?>

        <div class="small-12 medium-6 columns">
            <div class="featured-category">
                <a href="#" class="button--primary">Tees</a>
                <div class="featured-category-bg" style="background-image: url(<?php echo get_template_directory_uri(); ?>/images/hero2.jpg)"></div>
                <div class="featured-category-bg-overlay"></div>
            </div>
        </div>

        <?php endfor; ?>

    </div>
</section>

<?php get_footer(); ?>