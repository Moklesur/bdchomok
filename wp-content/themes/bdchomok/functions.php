<?php
/**
 * bdchomok functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package bdchomok
 */

if (!function_exists('bdchomok_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function bdchomok_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on bdchomok, use a find and replace
         * to change 'bdchomok' to the name of your theme in all the template files.
         */
        load_theme_textdomain('bdchomok', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'menu-1' => esc_html__('Primary', 'bdchomok'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('bdchomok_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support('custom-logo', array(
            'height' => 250,
            'width' => 250,
            'flex-width' => true,
            'flex-height' => true,
        ));
    }
endif;
add_action('after_setup_theme', 'bdchomok_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bdchomok_content_width()
{
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters('bdchomok_content_width', 640);
}

add_action('after_setup_theme', 'bdchomok_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bdchomok_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'bdchomok'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'bdchomok'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Shop', 'bdchomok'),
        'id' => 'shop',
        'description' => esc_html__('Add widgets here.', 'bdchomok'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Product', 'bdchomok'),
        'id' => 'product',
        'description' => esc_html__('Add widgets here.', 'bdchomok'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    $args_footer_widgets = array(
        'name'          => __( 'Footer %d', 'preferred-magazine' ),
        'id'            => 'footer-widget',
        'description'   => '',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5>',
    );
    register_sidebars( 5, $args_footer_widgets );
}

add_action('widgets_init', 'bdchomok_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function bdchomok_scripts()
{

    wp_enqueue_style('bdchomok-body-fonts', 'https://fonts.googleapis.com/css?family=Lato:400,700');

    wp_enqueue_style('icofont', get_template_directory_uri() . '/css/icofont.min.css', array(), '4.7.0');
    wp_enqueue_style('ionicons', 'https://unpkg.com/ionicons@4.2.2/dist/css/ionicons.min.css', array(), '4.7.0');
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '4.1.3');
    wp_enqueue_style('slick', get_template_directory_uri() . '/css/slick.css', array(), '4.1.3');

    wp_enqueue_style('bdchomok-style', get_stylesheet_uri());


        $loaded_jsvars = array(
        'ajaxurl' => admin_url('admin-ajax.php'));


    wp_localize_script('jquery', 'js_vars',
        $loaded_jsvars
    );


    // JS
    //wp_enqueue_script( 'jquery-popper', get_template_directory_uri() . '/js/popper.min.js', array('jquery'), '1.12.5', true );
    //wp_enqueue_script( 'jquery-isotope', get_template_directory_uri() . '/js/isotope.pkgd.js', array('jquery'), '3.0.4', true );
    wp_enqueue_script('jquery-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '4.1.3', true);
    wp_enqueue_script('slick-js', get_template_directory_uri() . '/js/slick.min.js', array('jquery'), '4.1.3', true);
    wp_enqueue_script('bdchomok-script', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.0', true);

    wp_enqueue_script('bdchomok-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true);

    wp_enqueue_script('bdchomok-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'bdchomok_scripts');


/**
 * Custom Elementor widgets
 */
function bdchomok_register_elementor_widgets()
{

    if (defined('ELEMENTOR_PATH') && class_exists('Elementor\Widget_Base')) {
        require get_template_directory() . '/plugins/category-post.php';
    }
}

add_action('elementor/widgets/widgets_registered', 'bdchomok_register_elementor_widgets');

/**
 * @param $elements_manager
 * elementor Category Name
 */
function bdchomok_elementor_widget_categories($elements_manager)
{

    $elements_manager->add_category(
        'bdchomok',
        array(
            'title' => __('BD Chomok Widgets', 'bdchomok'),
            'icon' => 'fa fa-plug',
        )
    );

}

add_action('elementor/elements/categories_registered', 'bdchomok_elementor_widget_categories');

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
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}


/**
 * Load WP Bootstrap Nav Walker file.
 */
if (!class_exists('WP_Bootstrap_Navwalker')) {
    require get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
}

/**
 * Load TGM Plugin
 */
require get_template_directory() . '/inc/class-tgm-plugin-activation.php';
add_action('tgmpa_register', 'bdchomok_active_plugins');
function bdchomok_active_plugins()
{
    $plugins = array(
        array(
            'name' => __('Elementor Page Builder by Elementor', 'bdchomok'),
            'slug' => 'elementor',
            'required' => false,
        ),
        array(
            'name' => __('Contact Form 7', 'bdchomok'),
            'slug' => 'contact-form-7',
            'required' => false,
        ),
        array(
            'name' => __('WooCommerce', 'bdchomok'),
            'slug' => 'woocommerce',
            'required' => false,
        )
    );
    tgmpa($plugins);
}


function woocommerce_ajax_add_to_cart_js()
{
//    if (function_exists('is_product') && is_product()) {
    wp_enqueue_script('woocommerce-ajax-add-to-cart', get_template_directory_uri() . '/js/ajax-add-to-cart.js', array('jquery'), '', true);
//    }
}

add_action('wp_enqueue_scripts', 'woocommerce_ajax_add_to_cart_js', 99);

add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');

function woocommerce_ajax_add_to_cart()
{

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

        WC_AJAX:: get_refreshed_fragments();
    } else {

        $data = array(
            'error' => true,
            'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));

        echo wp_send_json($data);
    }

    wp_die();
}


//remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
add_action('woocommerce_after_shop_loop_item', 'custom_woocommerce_template_loop_add_to_cart', 10);

function custom_woocommerce_template_loop_add_to_cart()
{
    global $product; ?>
    <div class="overlay">
        <button type="button" data-pid="<?php echo $product->id; ?>"
                class="quick-view"><?php echo __('এক নজরে', 'woocommerce') ?></button>
    </div>

    <?php
}


function load_single_product()
{
    $pid = $_POST['pid'];
    $response = array(
        'status' => 'success'
    );
    $product = wc_get_product($pid);


    $output = '<div class="woocommerce-notices-wrapper"></div>';


    $output .= '<div id="product-' . $product->get_id() . '" class="product type-product post-' . $product->get_id() . ' status-publish instock product_cat-desktop has-post-thumbnail shipping-taxable purchasable product-type-' . $product->get_type() . '">

	<div>';

    $columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
    $post_thumbnail_id = $product->get_image_id();
    $wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
        'woocommerce-product-gallery',
        'woocommerce-product-gallery--' . ( $product->get_image_id() ? 'with-images' : 'without-images' ),
        'woocommerce-product-gallery--columns-' . absint( $columns ),
        'images',
    ) );

    $output .= '<div class="'.esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ).'" data-columns="'.esc_attr( $columns ).'" style="opacity: 1; transition: opacity .25s ease-in-out;">
                                        <figure class="woocommerce-product-gallery__wrapper">';

    if ( $product->get_image_id() ) {
        $html = wc_get_gallery_image_html( $post_thumbnail_id, true );
    } else {
        $html  = '<div class="woocommerce-product-gallery__image--placeholder">';
        $html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
        $html .= '</div>';
    }

    $output .=  apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id );

    //$output .= do_action( 'woocommerce_product_thumbnails' );

    $output .= '</figure>
                                    </div>';

    $attachment_ids = $product->get_gallery_image_ids();

    if ( $attachment_ids && $product->get_image_id() ) {
        foreach ( $attachment_ids as $attachment_id ) {
            //echo wc_get_gallery_image_html( $attachment_id );die();
            $output .= apply_filters( 'woocommerce_single_product_image_thumbnail_html', wc_get_gallery_image_html( $attachment_id ), $attachment_id );
        }
    }
    $output .= '</div>
	<div class="summary entry-summary">
	 <h2 class="product_title entry-title">'.$product->get_name().'</h2>
     <p class="price">'.$product->get_price_html().'</p>
<div class="woocommerce-product-details__short-description">';




    $output .= '.'.$product->get_short_description() .'</div>';


    $output .= '<a href="'.$product->add_to_cart_url().'" data-quantity="1"
                               class="text-center alt custom-btn btn product_type_'.$product->get_type().' add_to_cart_button ajax_add_to_cart  wc-variation-selection-needed mb-3"
                               data-product_id="'.$product->get_id().'" data-product_sku=""
                               aria-label="Add “Product” to your cart" rel="nofollow"><img class="mr-2" src="'.URL.'/images/shop_cart.png" alt="">Add to
                    cart</a>';


    $output .= '.<div class="product_meta">';
    $catIds = $product->get_category_ids();
    $category_name = [];
    $category_slug = '';

    if (!empty($catIds)) {
        foreach ($catIds as $cat_id) {
            $trm = get_term_by('id', $cat_id, 'product_cat');

            $category_name[] = $trm->name;
            $category_slug = $trm->slug;
            break;
            break;

        }
    }


    $output .= ' <span class="posted_in">Category: <a href='.site_url().'/product-category/'.$category_slug.' rel="tag">'. implode(', ', $category_name).'</a></span>
	
	
</div>
	</div>

	
	<div class="woocommerce-tabs wc-tabs-wrapper">
		<ul class="tabs wc-tabs" role="tablist">
				<li class="description_tab active" id="tab-title-description" role="tab" aria-controls="tab-description">
					<a href="#tab-description">Description</a>
				</li>
					</ul>
					<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--description panel entry-content wc-tab" id="tab-description" role="tabpanel" aria-labelledby="tab-title-description" style="display: block;">
				
  <h2>Description</h2>'
        .$product->get_description().'

			</div>
			</div>

</div>';

    $output .= '</div>';
    $response['html'] = $output;
    wp_send_json($response);
}

add_action('wp_ajax_nopriv_load_single_product', 'load_single_product');
add_action('wp_ajax_load_single_product', 'load_single_product');


function load_add_cart_info_product()
{
    $pid = $_POST['pid'];
    $response = array(
        'status' => 'success'
    );
    $product = wc_get_product($pid);


    $output = '<div class="woocommerce-notices-wrapper"></div>';


    $output .= '<div id="product-' . $product->get_id() . '" class="product type-product post-' . $product->get_id() . ' status-publish instock product_cat-desktop has-post-thumbnail shipping-taxable purchasable product-type-' . $product->get_type() . '">

	<div>';

    $columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
    $post_thumbnail_id = $product->get_image_id();
    $wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
        'woocommerce-product-gallery',
        'woocommerce-product-gallery--' . ( $product->get_image_id() ? 'with-images' : 'without-images' ),
        'woocommerce-product-gallery--columns-' . absint( $columns ),
        'images',
    ) );

    $output .= '<div class="'.esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ).'" data-columns="'.esc_attr( $columns ).'" style="opacity: 1; transition: opacity .25s ease-in-out;">
                                        <figure class="woocommerce-product-gallery__wrapper">';

    if ( $product->get_image_id() ) {
        $html = wc_get_gallery_image_html( $post_thumbnail_id, true );
    } else {
        $html  = '<div class="woocommerce-product-gallery__image--placeholder">';
        $html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
        $html .= '</div>';
    }

    $output .=  apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id );

    //$output .= do_action( 'woocommerce_product_thumbnails' );

    $output .= '</figure>
                                    </div>';

    $attachment_ids = $product->get_gallery_image_ids();

    if ( $attachment_ids && $product->get_image_id() ) {
        foreach ( $attachment_ids as $attachment_id ) {
            //echo wc_get_gallery_image_html( $attachment_id );die();
            $output .= apply_filters( 'woocommerce_single_product_image_thumbnail_html', wc_get_gallery_image_html( $attachment_id ), $attachment_id );
        }
    }
    $output .= '</div>
	<div class="summary entry-summary">
	 <h2 class="product_title entry-title">'.$product->get_name().'</h2>
     <p class="price">'.$product->get_price_html().'</p>
<div class="woocommerce-product-details__short-description">';

    $output .= '<a href="'.site_url().'/cart" 
                               class="text-center alt custom-btn btn product_type_'.$product->get_type().' add_to_cart_button added_to_cart wc-forward mb-3"
                             >View Cart</a>';





    $output .= '</div> </div></div> </div>';


    $args = array(
        'posts_per_page'   => 5,
        'orderby'          => 'rand',
        'post_type'        => 'product' );

    $random_products = get_posts( $args );
    $single = '';
    $output .='<h3 class="other-title">Other\'s Product </h3>';
    $output .= '<div class="clearfix"><ul class="list-inline random-product rand-slider">';
    foreach ( $random_products as $post ) : setup_postdata( $post );
        $permalink =  get_post_permalink($post->ID);
        $product_meta = get_post_meta($post->ID);
        $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID));
        $single .= '<li class="list-inline-item">
             <img src='.$featured_image[0].' alt="" />
     <h5> Price : '.$product_meta['_regular_price'][0].'</h5>
            <p><a href='.$permalink.'>'.$post->post_title .'</a></p>
            <p><a href="'.wc_get_cart_url().'" data-quantity="1"
                               class="text-center alt custom-btn btn add_to_cart_button ajax_add_to_cart  wc-variation-selection-needed mb-3"
                               data-product_id="'.$post->ID.'" data-product_sku=""
                               aria-label="Add “Product” to your cart" rel="nofollow">Add to
                    cart</a></p>
        </li>';
    endforeach;
    wp_reset_postdata();

    $output .= $single;
    $output .= '</ul></div>';

    $output .= '</div>';
    $response['html'] = $output;
    wp_send_json($response);
}

add_action('wp_ajax_nopriv_load_add_cart_info_product', 'load_add_cart_info_product');
add_action('wp_ajax_load_add_cart_info_product', 'load_add_cart_info_product');




/**
 * Update contents count via AJAX
 */
add_filter('woocommerce_add_to_cart_fragments', 'bdchomok_header_add_to_cart_fragment');
function bdchomok_header_add_to_cart_fragment( $fragments ) {
    global $woocommerce;
    ob_start();
    ?>
    <a class="cart-contents" href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>"><i class="icofont-grocery"></i><span><?php echo sprintf(_n(' %d', ' %d', $woocommerce->cart->cart_contents_count, 'bdchomok'), $woocommerce->cart->cart_contents_count ); ?></span></a>
    <?php
    $fragments['a.cart-contents'] = ob_get_clean();
    return $fragments;
}

/**
 * Update mini-cart when products are added to the cart via AJAX
 */
add_filter( 'woocommerce_add_to_cart_fragments', function( $fragments ) {
    ob_start();
    ?>
    <div class="mini-cart-fix">
        <?php woocommerce_mini_cart(); ?>
    </div>
    <?php $fragments['div.mini-cart-fix'] = ob_get_clean();
    return $fragments;
} );

/**
 * woocommerce support
 */
function bdchomok_woocommerce_support() {
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-zoom' );
}
add_action( 'after_setup_theme', 'bdchomok_woocommerce_support' );

/**
 * Gallery WC Support
 */
function ushop_gallery_thumns_wc_support() {

    add_theme_support( 'woocommerce', array(
        'gallery_thumbnail_image_width' => 600,
    ) );
    add_theme_support( 'wc-product-gallery-lightbox' );
}
add_action( 'after_setup_theme', 'ushop_gallery_thumns_wc_support' );


// Add To Cart
add_filter('woocommerce_product_single_add_to_cart_text', 'bdchomok_cart_button_text');
add_filter( 'woocommerce_product_add_to_cart_text', 'bdchomok_cart_button_text' );

function bdchomok_cart_button_text() {
    return __( 'ক্রয় করুন', 'bdchomok' );
}