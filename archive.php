<?php get_header(); ?>

<?php if ( have_posts() ) : ?>

    <?php if ( is_day() ) : ?>
        <h2>Archive: <?php echo get_the_date( 'D M Y' ); ?></h2>
    <?php elseif ( is_month() ) : ?>
        <h2>Archive: <?php echo get_the_date( 'M Y' ); ?></h2>
    <?php elseif ( is_year() ) : ?>
        <h2>Archive: <?php echo get_the_date( 'Y' ); ?></h2>
    <?php else : ?>
        <h2>Archive</h2>
    <?php endif; ?>

    <?php while ( have_posts() ) : the_post(); ?>

        <article <?php post_class(); ?>>

        	<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>

        	<?php the_excerpt(); ?>

        </article>

    <?php endwhile; ?>

<?php else: ?>

    <p>No posts to display.</p>

<?php endif; ?>

<?php get_footer(); ?>