<?php get_header(); ?>

<?php if ( have_posts() ) : ?>

    <h2>Search Results: <?php echo get_search_query(); ?></h2>

    <?php while ( have_posts() ) : the_post(); ?>

    <article <?php post_class(); ?>>

    	<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>

    	<?php the_excerpt(); ?>

    </article>

    <?php endwhile; ?>

<?php else: ?>

    <p>No results found.</p>

<?php endif; ?>

<?php get_footer(); ?>