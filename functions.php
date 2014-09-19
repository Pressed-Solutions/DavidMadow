<?php

/** Start the engine */
require_once( TEMPLATEPATH . '/lib/init.php' );

/**
 * Functions
 *
 * @package      DavidMadow
 * @author       PressedSolutions/Andrew Minion <andrew@andrewrminion.com>
 * @copyright    Copyright (c) 2014, Pressed Solutions
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
 */

/** Create additional color style options */
add_theme_support( 'genesis-style-selector', array( 'lifestyle-blue' => 'Blue', 'lifestyle-charcoal' => 'Charcoal', 'lifestyle-gray' => 'Gray', 'lifestyle-green' => 'Green', 'lifestyle-pink' => 'Pink', 'lifestyle-purple' => 'Purple', 'lifestyle-tan' => 'Tan', 'lifestyle-teal' => 'Teal', 'lifestyle-yellow' => 'Yellow' ) );

$content_width = apply_filters( 'content_width', 600, 430, 920 );

/** Add new image sizes */
add_image_size( 'featured', 590, 250, TRUE );
add_image_size( 'homepage', 120, 120, TRUE );
add_image_size( 'mini', 80, 80, TRUE );
add_image_size( 'portfolio', 202, 140, TRUE );

/** Add suport for custom background */
add_custom_background();

/** Add support for custom header */
add_theme_support( 'custom-header', array(
    'width'         => 960,
    'height'        => 200,
    'flex-height'   => true
) );

/** Replace Genesis header with custom header */
remove_action('genesis_header', 'genesis_do_header');
remove_action('genesis_header', 'genesis_header_markup_open', 5);
remove_action('genesis_header', 'genesis_header_markup_close', 15);
remove_action( 'wp_head', 'genesis_custom_header_style' );
function custom_header() {
    ?>
    <div id="header">
        <div class="wrap">
            <a href="<?php get_bloginfo('home'); ?>" alt="<?php echo get_bloginfo('name') .' - '. get_bloginfo('description'); ?>">
            <img src="<?php get_header_image(); ?>" title="<?php echo get_bloginfo('name') .' - '. get_bloginfo('description'); ?>"></a>
        </div>
    </div>
<?php }

add_action('genesis_header', 'custom_header');


/** Remove full width content filter for bbPress */
add_filter( 'bbp_genesis_force_full_content_width', '__return_false' );

/** Add support for post formats */
//add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );
//add_theme_support( 'genesis-post-format-images' );

/** Remove elements for post formats */
add_action( 'genesis_before_post', 'lifestyle_remove_elements' );
function lifestyle_remove_elements() {

    if ( ! current_theme_supports( 'post-formats' ) )
        return;

    // Remove if post has format
    if ( get_post_format() ) {
        remove_action( 'genesis_post_title', 'genesis_do_post_title' );
        remove_action( 'genesis_before_post_content', 'genesis_post_info' );
        remove_action( 'genesis_after_post_content', 'genesis_post_meta' );
    }

    // Add back, as post has no format
    else {
        add_action( 'genesis_post_title', 'genesis_do_post_title' );
        add_action( 'genesis_before_post_content', 'genesis_post_info' );
        add_action( 'genesis_after_post_content', 'genesis_post_meta' );
    }

}

/** Add support for 3-column footer widgets */
add_theme_support( 'genesis-footer-widgets', 3 );

/** Reposition the primary navigation */
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_before_header', 'genesis_do_nav' );

/** Change breadcrumb location */
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
add_action( 'genesis_after_header', 'genesis_do_breadcrumbs' );

/** Add two sidebars underneath the primary sidebar */
add_action( 'genesis_after_sidebar_widget_area', 'lifestyle_bottom_sidebars' );
function lifestyle_bottom_sidebars() {
    foreach ( array( 'sidebar-bottom-left', 'sidebar-bottom-right' ) as $area ) {
        echo '<div class="' . $area . '">';
        dynamic_sidebar( $area );
        echo '</div><!-- end #' . $area . '-->';
    }
}

/** Register widget areas **/
genesis_register_sidebar( array(
    'id'            => 'sidebar-bottom-left',
    'name'            => __( 'Sidebar Bottom Left', 'lifestyle' ),
    'description'    => __( 'This is the bottom left sidebar.', 'lifestyle' ),
) );
genesis_register_sidebar( array(
    'id'            => 'sidebar-bottom-right',
    'name'            => __( 'Sidebar Bottom Right', 'lifestyle' ),
    'description'    => __( 'This is the bottom right sidebar.', 'lifestyle' ),
) );
genesis_register_sidebar( array(
    'id'            => 'home',
    'name'            => __( 'Home', 'lifestyle' ),
    'description'    => __( 'This is the homepage section.', 'lifestyle' ),
) );
genesis_register_sidebar( array(
    'id'            => 'home-left',
    'name'            => __( 'Home Left', 'lifestyle' ),
    'description'    => __( 'This is the homepage left section.', 'lifestyle' ),
) );
genesis_register_sidebar( array(
    'id'            => 'home-right',
    'name'            => __( 'Home Right', 'lifestyle' ),
    'description'    => __( 'This is the homepage right section.', 'lifestyle' ),
) );
genesis_register_sidebar( array(
    'id'            => 'portfolio',
    'name'            => __( 'Portfolio', 'lifestyle' ),
    'description'    => __( 'This is the portfolio page template', 'lifestyle' ),
) );
// Changing excerpt more
       function new_excerpt_more($more) {
       global $post;
       return '… <a href="'. get_permalink($post->ID) . '">' . 'Read More &raquo;' . '</a>';
       }
       add_filter('excerpt_more', 'new_excerpt_more');
       function exclude_category($query) {
if ( $query->is_home() ) {
$query->set('cat', '-37');
}
return $query;
}
add_filter('pre_get_posts', 'exclude_category');

