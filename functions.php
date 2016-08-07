<?php

/*
|--------------------------------------------------------------------------
| Enqueue scripts
|--------------------------------------------------------------------------
*/

function bedrock_scripts() {

    wp_deregister_script( 'jquery' );

    // Core scripts
    wp_enqueue_script( 'jquery', get_template_directory_uri() . '/bower_components/jquery/dist/jquery.min.js', null, '2.1.4', false );
    wp_enqueue_script( 'what-input', get_template_directory_uri() . '/bower_components/what-input/what-input.min.js', null, '1.1.3', true );
    wp_enqueue_script( 'foundation', get_template_directory_uri() . '/bower_components/foundation-sites/dist/foundation.min.js', null, '6.0.4', true );

    // Custom scripts
    wp_enqueue_script( 'fontawesome', 'https://use.fontawesome.com/92d1da124e.js', null, null, true );
    wp_enqueue_script( 'matchHeight', get_template_directory_uri() . '/bower_components/matchHeight/dist/jquery.matchHeight-min.js', null, null, true );
    wp_enqueue_script( 'owl', get_template_directory_uri() . '/bower_components/owl.carousel/dist/owl.carousel.min.js', null, null, true );

    // User scripts
    wp_enqueue_script( 'app', get_template_directory_uri() . '/js/min/app-min.js', null, null, true );

}

add_action( 'wp_enqueue_scripts', 'bedrock_scripts' );


/*
|--------------------------------------------------------------------------
| Basic setup
|--------------------------------------------------------------------------
*/

// Hide admin bar
show_admin_bar(false);

// Clean up header
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );

// Theme support
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );


/*
|--------------------------------------------------------------------------
| Post thumbnails
|--------------------------------------------------------------------------
*/

// New image sizes
add_image_size( 'bedrock-200', 200, 200, true );

// Remove default thumbnail sizes
function bedrock_drop_default_image_sizes( $sizes ) {
	unset( $sizes['medium'] );
	unset( $sizes['large'] );
	return $sizes;
}

add_filter( 'intermediate_image_sizes_advanced', 'bedrock_drop_default_image_sizes' );


/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
*/

// Grab highest ancestor page ID
function frg_ancestor_id()
{
    global $post;

    if ( $post->post_parent ) {
        $ancestors = array_reverse( get_post_ancestors( $post->ID ) );
        return $ancestors[0];
    }

    return $post->ID;
}

// Custom list pages with root page included
function frg_list_pages_with_intro( $args ) {

    global $post;

    if ( $post->post_parent ) {
        $grandfather = array_reverse( get_post_ancestors( $post->ID ) )[0];
        $is_current_page_item = false;
    } else {
        $grandfather = $post->ID;
        $is_current_page_item = true;
    }

    ?><li class="page_item page-item-<?php echo $grandfather; ?><?php if ($is_current_page_item) echo " current_page_item"; ?>">
        <a href="<?php echo the_permalink($grandfather); ?>"><?php echo get_the_title($grandfather) ?> Intro</a>
    </li><?php

    wp_list_pages( $args );
}

/*
|--------------------------------------------------------------------------
| Add WordPress menu functionality
|--------------------------------------------------------------------------
*/
function register_main_menu() {
    register_nav_menu( 'main-menu', __('Main Menu') );
}
add_action( 'init', 'register_main_menu' );

/*
|--------------------------------------------------------------------------
| WooCommerce Support
|--------------------------------------------------------------------------
*/

// Unhook default woocommerce wrappers
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

// Remove breadcrumbs
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

// Unhook sidebar from woocommerce
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

// Hook my own custom content wrappers
add_action('woocommerce_before_main_content', 'pipedream_content_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'pipedream_content_wrapper_end', 10);

function pipedream_content_wrapper_start() {
    get_template_part('parts/page-hero');
    get_template_part('parts/site-notification');
    echo '<div class="row">';
    echo '<div class="small-12 columns">';
    echo '<div class="content-area">';
}

function pipedream_content_wrapper_end() {
    echo '</div>';
    echo '</div>';
    echo '</div>';
}


// Declare WooCommerce Support
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}