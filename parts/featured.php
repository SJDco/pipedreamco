<section class="featured">
    <div class="row row--gutter-half">

        <?php $featured_cats = get_field('featured_categories'); ?>

        <?php $index = 1; foreach ($featured_cats as $category): ?>

            <?php $thumbnail_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true); ?>
            <?php $image = wp_get_attachment_url( $thumbnail_id ); ?>

            <div class="small-12 medium-6 columns <?php if ($index == count($featured_cats)) echo "end"; ?>">
                <div class="featured-category">
                    <a href="<?php echo get_term_link($category); ?>" class="button--primary"><?php echo $category->name; ?></a>
                    <div class="featured-category-bg" style="background-image: url(<?php echo $image; ?>)"></div>
                    <div class="featured-category-bg-overlay"></div>
                </div>
            </div>

        <?php $index++; endforeach; ?>

    </div>
</section>