<?php

function deadend_setup() {
	/*
	 * Make theme available for translation.
	 */
	load_theme_textdomain( 'deadend', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary Menu', 'deadend' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'sz16_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Woocommerce Support
	add_theme_support( 'woocommerce' );

	add_theme_support( 'wc-product-gallery-slider' );

	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
}
add_action( 'after_setup_theme', 'deadend_setup' );


function deadend_scripts() {

	/**
	 * Enqueue styles.
	 */
	wp_enqueue_style('Google-fonts', 'https://fonts.googleapis.com/css?family=Oswald:400,700', array(), false, 'all');
	wp_enqueue_style('main-css', get_template_directory_uri() . '/css/main.css', array(), false, 'all');
	wp_enqueue_style('animate-css', get_template_directory_uri() . '/css/animate.css', array(), false, 'all');
	wp_enqueue_style('icon-font', get_template_directory_uri() . '/css/font-awesome.min.css', array(), false, 'all');
	wp_enqueue_style( 'deadend-style', get_stylesheet_uri() );


	/**
	 * Enqueue scripts.
	 */
	wp_enqueue_script('jquery');

	wp_enqueue_script('plugins-1', get_template_directory_uri() . '/js/plugins.js', array(), false, false);
	wp_enqueue_script('plugins-2', get_template_directory_uri() . '/js/2849f73b14a9e47129312eac65470c2c.js', array(), false, false);
	wp_enqueue_script('plugins-3', get_template_directory_uri() . '/js/988611ffe6a67caa3ee9f2c66ca89c66.js', array(), false, false);
	wp_enqueue_script('settings', get_template_directory_uri() . '/js/settings.js', array(), false, false);

if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'deadend_scripts' );


add_action( 'init', 'deadend_post_types' );

function deadend_post_types() {
	$labels = array(
		'name'               => _x( 'Dealers', 'post type general name', 'deadend' ),
		'singular_name'      => _x( 'Dealer', 'post type singular name', 'deadend' ),
		'menu_name'          => _x( 'Dealers', 'admin menu', 'deadend' ),
		'name_admin_bar'     => _x( 'Dealer', 'add new on admin bar', 'deadend' ),
		'add_new'            => _x( 'Add New Dealer', 'dealer', 'deadend' ),
		'add_new_item'       => __( 'Add New Dealer', 'deadend' ),
		'new_item'           => __( 'New Dealer', 'deadend' ),
		'edit_item'          => __( 'Edit Dealer', 'deadend' ),
		'view_item'          => __( 'View Dealer', 'deadend' ),
		'all_items'          => __( 'All Dealers', 'deadend' ),
		'search_items'       => __( 'Search Dealers', 'deadend' ),
		'parent_item_colon'  => __( 'Parent Dealers:', 'deadend' ),
		'not_found'          => __( 'No dealers found.', 'deadend' ),
		'not_found_in_trash' => __( 'No dealers found in Trash.', 'deadend' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Description.', 'deadend' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'dealer' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'menu_icon'			 => 'dashicons-editor-kitchensink',
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title')
	);
	register_post_type( 'dealer', $args );



	//register video post type
	$labels = array(
		'name'               => _x( 'Videos', 'post type general name', 'deadend' ),
		'singular_name'      => _x( 'Video', 'post type singular name', 'deadend' ),
		'menu_name'          => _x( 'Videos', 'admin menu', 'deadend' ),
		'name_admin_bar'     => _x( 'Video', 'add new on admin bar', 'deadend' ),
		'add_new'            => _x( 'Add New Video', 'dealer', 'deadend' ),
		'add_new_item'       => __( 'Add New Video', 'deadend' ),
		'new_item'           => __( 'New Video', 'deadend' ),
		'edit_item'          => __( 'Edit Video', 'deadend' ),
		'view_item'          => __( 'View Video', 'deadend' ),
		'all_items'          => __( 'All Videos', 'deadend' ),
		'search_items'       => __( 'Search Videos', 'deadend' ),
		'parent_item_colon'  => __( 'Parent Videos:', 'deadend' ),
		'not_found'          => __( 'No videos found.', 'deadend' ),
		'not_found_in_trash' => __( 'No videos found in Trash.', 'deadend' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Add all media center video.', 'deadend' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'video' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'menu_icon'			 => 'dashicons-format-video',
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title'),
	);
	register_post_type( 'video', $args );


	//register video type taxonomy
	$labels = array(
		'name'              => _x( 'Video Type', 'taxonomy general name', 'deadend' ),
		'singular_name'     => _x( 'Video Types', 'taxonomy singular name', 'deadend' ),
		'search_items'      => __( 'Search Video Types', 'deadend' ),
		'all_items'         => __( 'All Video Types', 'deadend' ),
		'parent_item'       => __( 'Parent Video Type', 'deadend' ),
		'parent_item_colon' => __( 'Parent Video Type:', 'deadend' ),
		'edit_item'         => __( 'Edit Video Type', 'deadend' ),
		'update_item'       => __( 'Update Video Type', 'deadend' ),
		'add_new_item'      => __( 'Add New Video Type', 'deadend' ),
		'new_item_name'     => __( 'New Video Type Name', 'deadend' ),
		'menu_name'         => __( 'Video Type', 'deadend' ),
	);
	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'video_type' ),
	);
	register_taxonomy( 'video_type', array( 'video' ), $args );

}


function deadend_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Footer-widget', 'deadend' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'deadend' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'deadend_widgets_init' );



add_image_size( 'silder-bg', 1800, 730, true );
add_image_size( 'feature-img', 330, 220, true );





require get_template_directory() . '/inc/options.php';
require get_template_directory() . '/inc/wp-bootstrap-navwalker.php';


/**
 * Header right mini cart hover load cart item ajaxify
 * Js Part settings.js File
 */
function mode_theme_update_mini_cart() {
  echo wc_get_template( 'cart/mini-cart.php' );
  die();
}
add_filter( 'wp_ajax_nopriv_mode_theme_update_mini_cart', 'mode_theme_update_mini_cart' );
add_filter( 'wp_ajax_mode_theme_update_mini_cart', 'mode_theme_update_mini_cart' );



add_filter( 'woocommerce_product_add_to_cart_text', 'woo_archive_custom_cart_button_text' );    // 2.1 +
 
function woo_archive_custom_cart_button_text() {
 
        return __( 'Buy Now', 'woocommerce' );
 
}