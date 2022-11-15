<?php

if (!function_exists('itineris_theme_support')):
    /**
     *
     * @return void
     */
    function itineris_theme_support(){
        add_theme_support('wp-block-styles');
        add_editor_style('style.css');
    }
    endif;

add_action('after_setup', 'itineris_theme_support');

function itineris_theme_scripts() {
    wp_enqueue_style( 'style', get_stylesheet_uri() );
    wp_enqueue_style( 'assets-style', get_template_directory_uri() . '/assets/css/style.css', '', time() );
}
add_action( 'wp_enqueue_scripts', 'itineris_theme_scripts' );

add_theme_support( 'post-thumbnails' );

/*Custom Post type start*/
function itineris_post_type_course() {
    $supports = array(
        'title',
        'editor',
        'thumbnail',
        'custom-fields',
        'revisions',
    );
    $labels = array(
        'name' => _x('Courses', 'plural'),
        'singular_name' => _x('Course', 'singular'),
        'menu_name' => _x('Course', 'admin menu'),
        'name_admin_bar' => _x('Course', 'add new from admin bar'),
        'add_new' => _x('Add New', 'add new'),
        'add_new_item' => __('Add New Course'),
        'new_item' => __('New Course'),
        'edit_item' => __('Edit Course'),
        'view_item' => __('View Course'),
        'all_items' => __('All Course'),
        'search_items' => __('Search Course'),
        'not_found' => __('No course found.')
    );
    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'menu_icon'             => 'dashicons-welcome-learn-more',
        'query_var' => true,
        'rewrite' => array('slug' => 'course'),
        'has_archive' => true,
        'taxonomies' => array('Course type'),
        'hierarchical' => false,
        'show_in_rest' => true
    );
    register_post_type('course', $args);


    //Course type taxonomy
    $labels = array(
        'name'              => _x( 'Course type', 'taxonomy general name' ),
        'singular_name'     => _x( 'Course type', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Course type' ),
        'all_items'         => __( 'All Course type' ),
        'parent_item'       => __( 'Parent Course type' ),
        'edit_item'         => __( 'Edit Course type' ),
        'update_item'       => __( 'Update Course type' ),
        'add_new_item'      => __( 'Add New Course type' ),
        'new_item_name'     => __( 'New Course type Name' ),
        'menu_name'         => __( 'Course type' )
    );
    $args   = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'public' => true,
        'show_ui'           => true,
        'query_var'         => true,
        'rewrite'           => [ 'slug' => 'course-type'],
        'show_in_rest' => true,
        'rest_base'             => 'course-types',
    );
    register_taxonomy( 'Course-type',  ['course'], $args );

    //Campus taxonomy
    $labels = array(
        'name'              => _x( 'Campus', 'taxonomy general name' ),
        'singular_name'     => _x( 'Campus', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Campus' ),
        'all_items'         => __( 'All Campus' ),
        'parent_item'       => __( 'Parent Campus' ),
        'edit_item'         => __( 'Edit Campus' ),
        'update_item'       => __( 'Update Campus' ),
        'add_new_item'      => __( 'Add New Campus' ),
        'new_item_name'     => __( 'New Campus Name' ),
        'menu_name'         => __( 'Campus' )
    );
    $args   = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'public' => true,
        'show_ui'           => true,
        'query_var'         => true,
        'rewrite'           => [ 'slug' => 'campus'],
        'show_in_rest' => true,
        'rest_base'             => 'campus',
    );
    register_taxonomy( 'Campus',  ['course'], $args );
}
add_action('init', 'itineris_post_type_course');
/*Custom Post type end*/


add_shortcode('itineris_show_all_course', 'show_all_course');

function show_all_course(){
    $args = [
        'post_type' => 'course',
        'post_status' => array('publish'),
        'posts_per_page' => -1,
        'order' => 'DESC',
    ];

    $itineris_posts = new WP_Query($args);
    ob_start();
    get_template_part('template-parts/course', 'grid', [
        'itineris_query' => $itineris_posts
    ]);
    return ob_get_clean();

}

add_shortcode('itineris_filter', 'show_filter');

function show_filter(){
    $itineris_type = get_terms( ['taxonomy' => 'Course-type']);
    $itineris_campus = get_terms( ['taxonomy' => 'Campus']);

    ob_start();
    get_template_part('template-parts/terms', 'grid', [
        'itineris_query' => [
            'type' => $itineris_type,
            'campus' => $itineris_campus
        ]
    ]);
    return ob_get_clean();
}