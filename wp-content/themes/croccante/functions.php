<?php
/**
 * croccante functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package croccante
 */

if ( ! function_exists( 'croccante_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function croccante_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on croccante, use a find and replace
	 * to change 'croccante' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'croccante', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	
	add_theme_support( 'customize-selective-refresh-widgets' );
	
	add_theme_support( 'custom-logo', array(
		'height'      => 55,
		'width'       => 250,
		'flex-width' => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'croccante-hover-post' , 860, 400, true);
	add_image_size( 'croccante-the-post' , 860, 99999);

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'croccante' ),
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

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
	
	/*
	 * Starter Content Support
	 */
	add_theme_support( 'starter-content', array(
		'posts' => array(
			'home' => array(
				'template' => 'template-onepage.php',
			),
			'blog',
		),
		'options' => array(
			'show_on_front'  => 'page',
			'page_on_front'  => '{{home}}',
			'page_for_posts' => '{{blog}}',
			'croccante_theme_options[_onepage_section_slider]' => '1',
			'croccante_theme_options[_onepage_image_1_slider]' => get_template_directory_uri().'/images/example/croccante_slider_example_1.jpg',
			'croccante_theme_options[_onepage_image_2_slider]' => get_template_directory_uri().'/images/example/croccante_slider_example_2.jpg',
			'croccante_theme_options[_onepage_text_1_slider]' => 'Welcome to Croccante Theme',
			'croccante_theme_options[_onepage_subtext_1_slider]' => 'Use the customizer to customize the onepage sections',
			'croccante_theme_options[_onepage_text_2_slider]' => 'Read the documentation',
			'croccante_theme_options[_onepage_subtext_2_slider]' => 'You can find the documentation in "Appearance-> About Croccante-> Documentation"',
			'croccante_theme_options[_onepage_section_skills]' => '1',
			'croccante_theme_options[_onepage_titleanimation_skills]' => 'crocanim',
			'croccante_theme_options[_onepage_skillname_1_skills]' => 'Design',
			'croccante_theme_options[_onepage_skillvalue_1_skills]' => '84',
			'croccante_theme_options[_onepage_skillname_2_skills]' => 'WordPress',
			'croccante_theme_options[_onepage_skillvalue_2_skills]' => '93',
			'croccante_theme_options[_onepage_skillname_3_skills]' => 'SEO',
			'croccante_theme_options[_onepage_skillvalue_3_skills]' => '76',
			'croccante_theme_options[_onepage_skillname_4_skills]' => 'Support',
			'croccante_theme_options[_onepage_skillvalue_4_skills]' => '90',
			'croccante_theme_options[_onepage_skillname_5_skills]' => 'Customization',
			'croccante_theme_options[_onepage_skillvalue_5_skills]' => '89',
			'croccante_theme_options[_onepage_skillname_6_skills]' => 'Updates',
			'croccante_theme_options[_onepage_skillvalue_6_skills]' => '87',
			'croccante_theme_options[_onepage_section_cta]' => '1',
			'croccante_theme_options[_onepage_phrase_cta]' => 'Do you want more?',
			'croccante_theme_options[_onepage_desc_cta]' => 'Take a look at Croccante PRO version...',
			'croccante_theme_options[_onepage_textbutton_cta]' => 'PRO Version',
			'croccante_theme_options[_onepage_urlbutton_cta]' => 'https://crestaproject.com/demo/croccante-pro/',
		),
		'nav_menus' => array(
			'menu-1' => array(
				'name' => __( 'Primary', 'croccante' ),
				'items' => array(
					'link_home',
					'page_blog',
				),
			),
		),
	) );
}
endif;
add_action( 'after_setup_theme', 'croccante_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function croccante_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'croccante_content_width', 800 );
}
add_action( 'after_setup_theme', 'croccante_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function croccante_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Classic Sidebar', 'croccante' ),
		'id'            => 'sidebar-classic',
		'description'   => esc_html__( 'Add widgets here.', 'croccante' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title"><h3>',
		'after_title'   => '</h3></div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Push Sidebar', 'croccante' ),
		'id'            => 'sidebar-push',
		'description'   => esc_html__( 'Add widgets here.', 'croccante' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title"><h3>',
		'after_title'   => '</h3></div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'croccante' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here.', 'croccante' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title"><h3>',
		'after_title'   => '</h3></div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'croccante' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Add widgets here.', 'croccante' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title"><h3>',
		'after_title'   => '</h3></div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'croccante' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Add widgets here.', 'croccante' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title"><h3>',
		'after_title'   => '</h3></div>',
	) );
}
add_action( 'widgets_init', 'croccante_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function croccante_scripts() {
	wp_enqueue_style( 'croccante-style', get_stylesheet_uri() );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() .'/css/font-awesome.min.css');
	$query_args = array(
		'family' => 'Playfair+Display:400,700%7CNoto+Sans:400,700'
	);
	wp_enqueue_style( 'croccante-googlefonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), array(), null );

	wp_enqueue_script( 'croccante-custom', get_template_directory_uri() . '/js/jquery.croccante.js', array('jquery'), '1.0', true );
	if ( is_active_sidebar( 'sidebar-push' ) ) {
		wp_enqueue_script( 'croccante-nanoScroll', get_template_directory_uri() . '/js/jquery.nanoscroller.min.js', array('jquery'), '1.0', true );
	}
	wp_enqueue_script( 'croccante-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'croccante-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	if ( croccante_options('_smooth_scroll', '1') == 1) {
		wp_enqueue_script( 'croccante-smooth-scroll', get_template_directory_uri() . '/js/SmoothScroll.min.js', array('jquery'), '1.0', true );
	}
	if (is_page_template('template-onepage.php')) {
		wp_enqueue_script( 'croccante-waypoints', get_template_directory_uri() . '/js/jquery.waypoints.min.js', array('jquery'), '1.0', true );
	}
	if (is_page_template('template-onepage.php') && croccante_options('_onepage_section_slider', '') == 1) {
		wp_enqueue_script( 'croccante-flex-slider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array(), '1.0', true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	/* Dequeue default WooCommerce Layout */
	wp_dequeue_style ( 'woocommerce-layout' );
	wp_dequeue_style ( 'woocommerce-smallscreen' );
	wp_dequeue_style ( 'woocommerce-general' );
}
add_action( 'wp_enqueue_scripts', 'croccante_scripts' );

/**
 * WooCommerce Support
 */
if ( ! function_exists( 'croccante_woocommerce_support' ) ) :
	function croccante_woocommerce_support() {
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-lightbox' );
	}
	add_action( 'after_setup_theme', 'croccante_woocommerce_support' );
endif; // croccante_woocommerce_support

/**
 * WooCommerce: Chenge default max number of related products to 3
 */
if ( function_exists( 'is_woocommerce' ) ) :
	if ( ! function_exists( 'croccante_related_products_args' ) ) :
		add_filter( 'woocommerce_output_related_products_args', 'croccante_related_products_args' );
		function croccante_related_products_args( $args ) {
			$args['posts_per_page'] = 3;
			return $args;
		}
	endif;
	if ( ! function_exists( 'croccante_wc_get_product_cat_class' ) ) :
		function croccante_wc_get_product_cat_class($classes, $class, $category) {
			$classes[] = 'three-columns';
			return array_unique( array_filter( $classes ) );
		}
		add_filter( 'product_cat_class' , 'croccante_wc_get_product_cat_class', 10, 3 );
	endif;
endif;

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

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

/**
 * Load PRO Button in the customizer
 */
require_once( trailingslashit( get_template_directory() ) . 'inc/pro-button/class-customize.php' );

/* Calling in the admin area for the Welcome Page */
if ( is_admin() ) {
	require get_template_directory() . '/inc/admin/croccante-admin-page.php';
}