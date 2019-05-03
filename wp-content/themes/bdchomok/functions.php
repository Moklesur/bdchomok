<?php
/**
 * bdchomok functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package bdchomok
 */

if ( ! function_exists( 'bdchomok_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function bdchomok_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on bdchomok, use a find and replace
		 * to change 'bdchomok' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'bdchomok', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'bdchomok' ),
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
		add_theme_support( 'custom-background', apply_filters( 'bdchomok_custom_background_args', array(
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
add_action( 'after_setup_theme', 'bdchomok_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bdchomok_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'bdchomok_content_width', 640 );
}
add_action( 'after_setup_theme', 'bdchomok_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bdchomok_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'bdchomok' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'bdchomok' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'bdchomok_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function bdchomok_scripts() {

    wp_enqueue_style('bdchomok-body-fonts', 'https://fonts.googleapis.com/css?family=Lato:400,700');

    wp_enqueue_style( 'icofont', get_template_directory_uri() . '/css/icofont.min.css', array(), '4.7.0' );
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '4.1.3' );

	wp_enqueue_style( 'bdchomok-style', get_stylesheet_uri() );

	// JS
    //wp_enqueue_script( 'jquery-popper', get_template_directory_uri() . '/js/popper.min.js', array('jquery'), '1.12.5', true );
    //wp_enqueue_script( 'jquery-isotope', get_template_directory_uri() . '/js/isotope.pkgd.js', array('jquery'), '3.0.4', true );
    wp_enqueue_script( 'jquery-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '4.1.3', true );
    wp_enqueue_script( 'bdchomok-script', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.0', true );

	wp_enqueue_script( 'bdchomok-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'bdchomok-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bdchomok_scripts' );


/**
 * Custom Elementor widgets
 */
function bdchomok_register_elementor_widgets() {

    if ( defined('ELEMENTOR_PATH') && class_exists('Elementor\Widget_Base') ) {
        require get_template_directory() . '/plugins/category-post.php';
    }
}
add_action( 'elementor/widgets/widgets_registered', 'bdchomok_register_elementor_widgets' );

/**
 * @param $elements_manager
 * elementor Category Name
 */
function bdchomok_elementor_widget_categories( $elements_manager ) {

    $elements_manager->add_category(
        'bdchomok',
        array(
            'title' => __( 'BD Chomok Widgets', 'bdchomok' ),
            'icon' => 'fa fa-plug',
        )
    );

}
add_action( 'elementor/elements/categories_registered', 'bdchomok_elementor_widget_categories' );

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


/**
 * Load WP Bootstrap Nav Walker file.
 */
if ( ! class_exists( 'WP_Bootstrap_Navwalker' )) {
    require get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
}

/**
 * Load TGM Plugin
 */
require get_template_directory() . '/inc/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'bdchomok_active_plugins' );
function bdchomok_active_plugins() {
    $plugins = array(
        array(
            'name'      => __( 'Elementor Page Builder by Elementor', 'bdchomok' ),
            'slug'      => 'elementor',
            'required'  => false,
        ),
        array(
            'name'      => __( 'Contact Form 7', 'bdchomok' ),
            'slug'      => 'contact-form-7',
            'required'  => false,
        ),
        array(
            'name'      => __( 'WooCommerce', 'bdchomok' ),
            'slug'      => 'woocommerce',
            'required'  => false,
        )
    );
    tgmpa( $plugins );
}

function woocommerce_ajax_add_to_cart_js() {
//    if (function_exists('is_product') && is_product()) {
        wp_enqueue_script('woocommerce-ajax-add-to-cart', get_template_directory_uri() . '/js/ajax-add-to-cart.js', array('jquery'), '', true);
//    }
}
add_action('wp_enqueue_scripts', 'woocommerce_ajax_add_to_cart_js', 99);


add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');

function woocommerce_ajax_add_to_cart() {

    $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
    $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
    $variation_id = absint($_POST['variation_id']);
    $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $product_status = get_post_status($product_id);

    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) {

        do_action('woocommerce_ajax_added_to_cart', $product_id);

        if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
            wc_add_to_cart_message(array($product_id => $quantity), true);
        }

        WC_AJAX :: get_refreshed_fragments();
    } else {

        $data = array(
            'error' => true,
            'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));

        echo wp_send_json($data);
    }

    wp_die();
}