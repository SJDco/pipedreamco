<section class="hero--home">

    <div class="owl-carousel owl-theme hero-slider">

        <?php while ( have_rows('slider', 4) ): the_row(); ?>

            <?php $img = get_sub_field('image'); ?>

            <div class="slide" style="background-image: url(<?php echo $img; ?>);">
                <div class="row">
                    <div class="large-12 columns">
                        <p>
                            <h1><?php the_sub_field('banner_message'); ?></h1>
                        </p>
                        <a href="<?php the_sub_field('button_link'); ?>" class="button--primary">Shop Now</a>
                    </div>
                </div>
            </div>

        <?php endwhile; ?>

    </div>

</section>