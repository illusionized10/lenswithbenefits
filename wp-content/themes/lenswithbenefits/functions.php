<?php
/**
 * lenswithbenefits functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package lenswithbenefits
 */

if ( ! function_exists( 'lenswithbenefits_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function lenswithbenefits_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on lenswithbenefits, use a find and replace
		 * to change 'lenswithbenefits' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'lenswithbenefits', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'lenswithbenefits' ),
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
		add_theme_support( 'custom-background', apply_filters( 'lenswithbenefits_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'lenswithbenefits_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function lenswithbenefits_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'lenswithbenefits_content_width', 640 );
}
add_action( 'after_setup_theme', 'lenswithbenefits_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function lenswithbenefits_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'lenswithbenefits' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'lenswithbenefits' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'lenswithbenefits_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function lenswithbenefits_scripts() {
	wp_enqueue_style( 'lenswithbenefits-style', get_stylesheet_uri() );

	wp_enqueue_style( 'custom-styles', get_template_directory_uri()."/assets/css/bootstrap.css");

	wp_enqueue_style( 'custom-styles', get_template_directory_uri()."/assets/css/custom.css");

	wp_enqueue_script( 'lenswithbenefits-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script('jquery', get_template_directory_uri(). '/assets/js/jquery-3.2.1.slim.min.js' );

	wp_enqueue_script('jquery', get_template_directory_uri(). '/assets/js/popper.min.js' );

	wp_enqueue_script('jquery', get_template_directory_uri(). '/assets/js/bootstrap.min.js' );
}
add_action( 'wp_enqueue_scripts', 'lenswithbenefits_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

// Register Custom Post Type
function cc_create_slider() {

	$labels = array(
		'name'                  => _x( 'Custom Sliders', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Custom Slider', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Custom Slider', 'text_domain' ),
		'name_admin_bar'        => __( 'Custom Slider', 'text_domain' ),
		'archives'              => __( 'Custom Slider Archives', 'text_domain' ),
		'attributes'            => __( 'Custom Slider Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Custom Slider:', 'text_domain' ),
		'all_items'             => __( 'All Custom Sliders', 'text_domain' ),
		'add_new_item'          => __( 'Add New Custom Slider', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Custom Slider', 'text_domain' ),
		'edit_item'             => __( 'Edit Custom Slider', 'text_domain' ),
		'update_item'           => __( 'Update Custom Slider', 'text_domain' ),
		'view_item'             => __( 'View Custom Slider', 'text_domain' ),
		'view_items'            => __( 'View Custom Slider', 'text_domain' ),
		'search_items'          => __( 'Search Custom Slider', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into Custom Slider', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Custom Sliders list', 'text_domain' ),
		'items_list_navigation' => __( 'Custom Sliders list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Custom Slider', 'text_domain' ),
		'description'           => __( 'Custom Slider', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-format-gallery',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => false,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'cc_custom_slider', $args );

}
add_action( 'init', 'cc_create_slider', 0 );