<?php get_header(); ?>

<?php get_template_part('parts/site-notification'); ?>

<div class="row">
    <div class="small-12 columns">

        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

            <div class="content-area">
                <div class="page-title-container">
                    <h1 class="page-title"><?php the_title(); ?></h1>
                    <div class="page-title-line"></div>
                </div>
                <?php the_content(); ?>
            </div>

        <?php endwhile; endif; ?>

    </div>
</div>

<?php get_footer(); ?>