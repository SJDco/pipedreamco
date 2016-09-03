<?php

/*
|--------------------------------------------------------------------------
| Enqueue scripts
|--------------------------------------------------------------------------
*/

function bedrock_scripts() {

    wp_deregister_script( 'jquery' );

    // Core scripts
    wp_enqueue_script( 'jquery', get_template_directory_uri() . '/bower_components/jquery/dist/jquery.min.js', null, '2.2.4', false );
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

// Customise footer text
function sjd_footer_text () {
    echo 'Made with <i style="color: #ef404a;" class="fa fa-heart"></i> by <a style="color: #ef404a;" href="http://sjd.co/" target="_blank">Sam Davis</a>';
}
add_filter('admin_footer_text', 'sjd_footer_text');

// Customise login page
function login_page_css() { ?>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/admin.css">
<?php }
add_action('login_head', 'login_page_css', 10);


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
    // register_nav_menu( 'main-menu', __('Main Menu') );
    register_nav_menus( array(
        'main-menu' => __('Main Menu'),
        'need-help-menu' => __('Need Help Menu'),
        'company-menu' => __('Company Menu')
    ) );
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
    if ( is_post_type_archive( 'product' )) {
        get_template_part('parts/page-hero');
    }
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

add_action( 'woocommerce_single_product_summary', 'show_size_chart', 20 );
function show_size_chart() {
    $link = get_field('sizing_chart', 4);
    echo "<div class='sizing-chart'>";
        echo "<a href='$link' target='_blank'>Sizing Chart</a>";
    echo "</div>";
}

// Change woocommerce button texts
// add_filter( 'woocommerce_product_add_to_cart_text' , 'custom_woocommerce_product_add_to_cart_text' );
// /**
//  * custom_woocommerce_template_loop_add_to_cart
// */
// function custom_woocommerce_product_add_to_cart_text() {
// 	global $product;
//
// 	$product_type = $product->product_type;
//
// 	switch ( $product_type ) {
// 		case 'external':
// 			return __( 'Buy product', 'woocommerce' );
// 		break;
// 		case 'grouped':
// 			return __( 'View products', 'woocommerce' );
// 		break;
// 		case 'simple':
// 			return __( 'Add to cart', 'woocommerce' );
// 		break;
// 		case 'variable':
// 			return __( 'Select options', 'woocommerce' );
// 		break;
// 		default:
// 			return __( 'Read more', 'woocommerce' );
// 	}
//
// }