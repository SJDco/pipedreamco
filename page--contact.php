<?php
 /**
 * Template Name: Contact Page
 */
get_header(); ?>

<?php get_template_part('parts/site-notification'); ?>

<div class="row">

    <small-12 class="columns">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

            <div class="content-area">
                <h1 class="page-title"><?php the_title(); ?></h1>
            </div>

        <?php endwhile; endif; ?>
    </small-12>

    <div class="small-4 columns">

        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

            <div class="content-area">
                <?php the_content(); ?>
            </div>

        <?php endwhile; endif; ?>

    </div>

    <div class="small-7 columns">
        <p>
            
        </p>
        <?php echo do_shortcode( '[formidable id="2" minimize="1"]' ); ?>

    </div>

</div>

<?php get_footer(); ?>