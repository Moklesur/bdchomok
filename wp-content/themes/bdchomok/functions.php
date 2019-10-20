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
            'menu-1' => esc_html__('Primary', 'bdchomok')
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
        'id' => 'shop-page',
        'description' => esc_html__('Add widgets here.', 'bdchomok'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Product', 'bdchomok'),
        'id' => 'product-page',
        'description' => esc_html__('Add widgets here.', 'bdchomok'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Top', 'bdchomok'),
        'id' => 'footer-top',
        'description' => esc_html__('Add widgets here.', 'bdchomok'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
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
    register_sidebars( 4, $args_footer_widgets );

    register_widget( 'BDchomok_Widget_Services' );
    register_widget( 'BDchomok_Widget_Address_Info' );
    register_widget( 'BDchomok_Widget_Social_links' );
}

add_action('widgets_init', 'bdchomok_widgets_init');

/**
 * Widgets
 */
require get_template_directory() . '/plugins/address-info.php';
require get_template_directory() . '/plugins/services.php';
require get_template_directory() . '/plugins/social-links.php';

/**
 * Enqueue scripts and styles.
 */
function bdchomok_scripts()
{

    wp_enqueue_style('bdchomok-body-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400,600');

    wp_enqueue_style('icofont', get_template_directory_uri() . '/css/icofont.min.css', array(), '4.7.0');
    wp_enqueue_style('ionicons', 'https://unpkg.com/ionicons@4.2.2/dist/css/ionicons.min.css', array(), '4.7.0');
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '4.1.3');
    wp_enqueue_style('slick', get_template_directory_uri() . '/css/slick.css', array(), '4.1.3');

    wp_enqueue_style('bdchomok-style', get_stylesheet_uri());

    $loaded_jsvars = array('ajaxurl' => admin_url('admin-ajax.php'));
    wp_localize_script('jquery', 'js_vars', $loaded_jsvars);

    // JS
    wp_enqueue_script( 'jquery-nicescroll', get_template_directory_uri() . '/js/jquery.nicescroll.js', array('jquery'), '3.7.6', true );
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

    if ( defined('ELEMENTOR_PATH') && class_exists('Elementor\Widget_Base') ) {
        require get_template_directory() . '/plugins/category-post.php';
        require get_template_directory() . '/plugins/recent-products-woo.php';
        require get_template_directory() . '/plugins/author-list.php';
        require get_template_directory() . '/plugins/list-category-woo.php';
        require get_template_directory() . '/plugins/list-category-woo-count.php';
        require get_template_directory() . '/plugins/brand-logo.php';
        require get_template_directory() . '/plugins/slideshow.php';
        require get_template_directory() . '/plugins/best-selling.php';
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

/*
 * Sidebar widgets for books
 *
 */
require get_template_directory() . '/inc/bdchmok-book-sidebar.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load Custom acf setting compatibility file.
 */
require get_template_directory() . '/inc/acf-custom.php';

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

// Product page Image,Title, Cart Button Sticky
add_action( 'woocommerce_after_single_product_summary', 'product_sticky', 10 );
function product_sticky(){
    global $post;
    $product = wc_get_product( $post->ID );
    ?>
    <div class="product-sticky d-none">
        <div class="container">
            <div class="row align-items-center d-flex">
                <div class="col-lg-4 d-lg-inline d-none">
                    <div class="sticky-pro-img" style="max-width: 38px; display: inline-block; margin-right: 10px">
                        <?php
                        echo $product->get_image();
                        ?>
                    </div>
                    <?php
                    echo '<span class="pl-60">'.$product->get_name().'</span><span class="author-pro pl-60"></span>';
                    ?>
                </div>
                <div class="col-lg-4 d-lg-inline d-none text-center">
                    <p class="price">
                        <?php echo $product->get_price_html(); ?>
                    </p>
                </div>
                <div class="col-lg-4 col-12 d-lg-inline d-none text-lg-right">
                    <a class="button add-to-cart" href="<?php echo $product->add_to_cart_url(); ?>"><?php _e( 'ক্রয় করুন', 'bdchomok' ); ?></a>
                </div>
            </div>
        </div>
    </div>
    <?php
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
add_action('woocommerce_after_shop_loop_item', 'bdchomok_woocommerce_template_loop_add_to_cart', 10);

function bdchomok_woocommerce_template_loop_add_to_cart()
{
    global $product; ?>
    <div class="overlay">
        <button type="button" data-pid="<?php echo $product->id; ?>" class="quick-view"><?php echo __('এক নজরে', 'woocommerce') ?></button>
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

    $output .= '<div class="woocommerce "><div id="product-' . $product->get_id() . '" class="product row type-product post-' . $product->get_id() . ' status-publish instock product_cat-desktop has-post-thumbnail shipping-taxable purchasable product-type-' . $product->get_type() . '">';

    //echo wc_get_gallery_image_html( $attachment_id );die();
    $output .= '<div class="images text-center col-lg-5 col-12"><img src=" '.wp_get_attachment_url( $product->get_image_id() ).'" />';

    $output .= '</div><div class="summary entry-summary col-lg-7 col-12"><h2 class="product_title entry-title">'.$product->get_name().'</h2><p class="price">'.$product->get_price_html().'</p><div class="woocommerce-product-details__short-description mb-3">';
    $output .= '.'.$product->get_short_description() .'</div>';

    $output .= '<a href="'.$product->add_to_cart_url().'" data-quantity="1" class="text-center alt custom-btn btn product_type_'.$product->get_type().' add_to_cart_button ajax_add_to_cart  wc-variation-selection-needed mb-3" data-product_id="'.$product->get_id().'" data-product_sku="" aria-label="Add “Product” to your cart" rel="nofollow">ক্রয় করুন</a>';

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
    $output .= ' <span class="posted_in">Category: <a href='.site_url().'/product-category/'.$category_slug.' rel="tag">'. implode(', ', $category_name).'</a></span></div></div></div></div>';

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

	<div class="d-flex aligns-center justify-content-center">';

    $output .= '<div class="images text-center"> <img src=" '.wp_get_attachment_url( $product->get_image_id() ).'" />';

    $output .= '</div>
	<div class="summary entry-summary">
	 <h2 class="product_title entry-title">'.$product->get_name().'</h2>
    <p class="price discount-hide">'.$product->get_price_html().'</p>
<p class="btn-close-checkout"><a href="/checkout" class="btn btn-checkout">অর্ডার সম্পন্ন করুন</a><a href="#" class="close btn btn-close" data-dismiss="modal" aria-label="Close">আরও কিনুন</a></p>';

    $output .= ' </div></div> </div>';

    $args = array(
        'post_type'             => 'product',
        'post_status'           => 'publish',
        'posts_per_page'        => 10,
        'orderby'          => 'rand',
        'post__not_in'   => array( $product->get_id() )
    );
    $products = new WP_Query($args);

    if ( $products->have_posts() ) :
        $single = '';
        $output .='<h3 class="other-title">আমাদের অন্যান্য পণ্য:</h3>';
        $output .= '<div class="clearfix woocommerce columns-4 category-filter overflow-inherit"><ul class="products columns-4  list-inline random-product rand-slider">';

        while ( $products->have_posts() ) : $products->the_post();
            global $product;
            $title = mb_strimwidth($product->get_name(), 0, 18, '...');


            $single .= '<li class="product list-inline-item type-product post-'.$product->get_id().' product-type-simple">

                     <a href='.$product->get_permalink().' class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
                            '.$product->get_image('woocommerce_thumbnail').'</a>
                                   <p class="m-0"><a href='.$product->get_permalink().'>'.$title.'</a></p>          
                                   <p class="price">'.$product->get_price_html().'</p>   
                                   <p class="m-0"><a href="'.wc_get_cart_url().'" data-quantity="1"
                               class="text-center alt  button add_to_cart_button ajax_add_to_cart  wc-variation-selection-needed"
                               data-product_id="'.$product->get_id().'" data-product_sku=""
                               aria-label="Add “Product” to your cart" rel="nofollow">ক্রয় করুন</a></p></li>';

        endwhile;
        wp_reset_query();
        $output .= $single;
        $output .= ' </ul></div>';
    endif;


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

// Remove Breadcrumb'
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

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

add_action('init', 'function_to_add_author_woocommerce', 999 );
function function_to_add_author_woocommerce() {
    add_post_type_support( 'product', 'author' );
}

// Remove Category Product Page
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

// Offer Content in product page
function offer_content() {

    global $product;

    $offer_content =  get_field('offer_content', $product->get_id());

    if ($offer_content){?>
        <div class="offer">
            <div class="d-flex green-text">
                <span class="icofont-volume-off  icofont-1x mr-2"></span>
                <span><?php  echo $offer_content;?></span>
            </div>
        </div>
    <?php }

};
add_action( 'woocommerce_single_product_summary', 'offer_content', 15 );

// Product Page ( Parent & Child Category )
add_action( 'woocommerce_single_product_summary', 'bdchomok_product_page_category', 10 );
function bdchomok_product_page_category(){

    $post_id = get_the_ID();
    $assigned_terms = wp_get_post_terms($post_id, 'product_cat', array("fields" => "all"));
    foreach($assigned_terms as $term){

        echo '<p class="mb-1">';
        // display parent term name
        if($term->parent != 0){
            $parent = get_term_by( 'id', $term->parent , 'product_cat' );
            echo '<span class="mr-1">'.$parent->name.' : </span>';
        }
        $term_link = get_term_link( $term, array( 'product_cat') );
        // display child term name
        echo '<a class="'.$parent->slug.'" style="color: #ff0000;" href="'.esc_url( $term_link ).'">'.$term->name.'</a></p>';
    }

}

// Ajax Search
require get_template_directory() . '/ajax-search/functions.php';


add_filter( 'woocommerce_get_related_product_tag_terms','related_product_page_title', 10, 2 );
function related_product_page_title($title, $id) {
    if(is_product_category() || is_page() ) {
        $title = mb_strimwidth($title, 0, 18, '...');
        return $title;
    }

    return $title;
}


//
//add_filter( 'woocommerce_product_tabs', 'woo_custom_product_tabs' );
//function woo_custom_product_tabs( $tabs ) {
//
//    global $product;
//
//    $product_specifications = get_field('product_specifications',$product->id);
//
//    // Remove the description tab
//    // unset( $tabs['reviews'] );               // Remove the reviews tab
//    unset( $tabs['additional_information'] );   // Remove the additional information tab
//
//
//    // 2 Adding new tabs and set the right order
//
//
//    if (!empty($product_specifications)){
//        // Adds the qty pricing  tab
//        $tabs['qty_pricing_tab'] = array(
//            'title'     => __( 'Specifications', 'woocommerce' ),
//            'priority'  => 110,
//            'callback'  => 'product_specifications_tab_content'
//        );
//    }
//
//    return $tabs;
//
//}

function product_specifications_tab_content() {
    global $product;
    $product_specifications = get_field('product_specifications',$product->id);
    ?>

    <table class="table table-bordered table-striped">
        <tbody>

        <?php

        if (!empty($product_specifications)){
            foreach ($product_specifications as $key => $specification){

                ?>
                <tr>
                    <td><?php
                        if ($key === 'title'){
                            echo   $title = "Title";
                        }
                        if ($key === 'author'){
                            echo   $title = "Author";
                        }
                        if ($key === 'publisher'){
                            echo   $title = "Publisher";
                        }
                        if ($key === 'edition'){
                            echo   $title = "Edition";
                        }
                        if ($key === 'number_of_pages'){
                            echo   $title = "Number Of Pages";
                        }
                        if ($key === 'country'){
                            echo   $title = "Country";
                        }
                        if ($key === 'language'){
                            echo   $title = "Language";
                        }?></td>
                    <td><?php echo $specification; ?></td>
                </tr>

            <?php   }
        }
        ?>


        </tbody></table>
    <?php

}
function woo_other_products_tab_content() {
    global $product;
    $authors = get_field('authors',$product->id);

    ?>

    <div class="book-author__content-author">
        <div class="row no-gutters">
            <?php

            if (!empty($authors)){
                $author_name = $authors['author_name'];
                $image = $authors['author_image'];
                $author_description = $authors['author_description'];
                $author_url = $authors['author_url'];

                if (!empty($image)) {
                    ?>
                    <div class="col-2">
                        <img style="height: 200px; width: 200px" class="img-fluid rounded-circle" src="<?php echo $image; ?>" alt="<?php echo $author_name; ?>">

                    </div>
                    <div class="col author_des">
                        <p><a href="<?php echo $author_url; ?>"><?php echo $author_name; ?></a></p>
                        <div class="author-description-wrapper">
                            <div class="author-description" id="js--author-description">

                                <?php echo $author_description; ?>
                            </div>

                        </div>

                    </div>

                <?php }  }
            ?>
        </div>
    </div>

    <?php
}
// Product sale price
function bdchomok_product_sale_flash( $output, $post, $product ) {
    global $product;
    if($product->is_on_sale()) {
        if($product->is_type( 'variable' ) )
        {
            $regular_price = $product->get_variation_regular_price();
            $sale_price = $product->get_variation_price();
        } else {
            $regular_price = $product->get_regular_price();
            $sale_price = $product->get_sale_price();
        }
        $percent_off = (($regular_price - $sale_price) / $regular_price) * 100;
        return '<span class="onsale">' . round($percent_off) . '% <br/>ছাড়</span>';
    }
}
add_filter( 'woocommerce_sale_flash', 'bdchomok_product_sale_flash', 11, 3 );

add_filter( 'woocommerce_format_sale_price', 'woocommerce_custom_sales_price', 10, 3 );

function woocommerce_custom_sales_price( $price, $regular_price, $sale_price ) {

    // Getting the clean numeric prices (without html and currency)
    $regular_price = floatval( strip_tags($regular_price) );
    $sale_price = floatval( strip_tags($sale_price) );

    // Percentage calculation and text
    $percentage = round( ( $regular_price - $sale_price ) / $regular_price * 100 ).'%';
    $percentage_txt = $percentage.__(' ছাড়ে', 'woocommerce' );

    return '<ins>' . wc_price( $sale_price ) . '</ins><del class="ml-2">' . wc_price( $regular_price ) . '</del><span class="discount-skl">( '.$percentage_txt . ' )</span>';

}

/**
 * Opening div for our content wrapper
 */
add_action('woocommerce_before_main_content', 'bdchomok_open_div', 5);

function bdchomok_open_div() {
    $order = ' order-lg-1';
    if( is_product() ){
        $order = '';
    }
    echo '<div class="col-lg-9 col-md-12 col-12 archive-woo'.$order.'">';
}

/**
 * Closing div for our content wrapper
 */
add_action('woocommerce_after_main_content', 'ushop_close_div', 50);

function ushop_close_div() {
    echo '</div>';
}

/**
 * Added Row
 */
add_action( 'woocommerce_before_single_product_summary', 'ushop_product_wrapper_start', 1 );
function ushop_product_wrapper_start() {
    echo '<div class="row product-thumb-content">';
}
add_action( 'woocommerce_after_single_product_summary', 'ushop_product_wrapper_end', 1 );
function ushop_product_wrapper_end() {
    echo '</div>';
}

/**
 * Single Product
 * Added classes in product images
 */
add_action( 'woocommerce_before_single_product_summary', 'ushop_product_images_start', 1 );
function ushop_product_images_start() {
    echo '<div class="col-lg-5 col-sm-5 col-12 margin-top single-product-images">';
}

/**
 * Single Product
 * Added classes in product description
 */
add_action( 'woocommerce_before_single_product_summary', 'ushop_product_summary_start', 999 );
function ushop_product_summary_start() {
    echo '</div>';
    echo '<div class="col-lg-7 col-sm-7 col-12 single-product-summary margin-top">';
}
add_action( 'woocommerce_after_single_product_summary', 'ushop_product_summary_end', 0 );
function ushop_product_summary_end() {
    echo '</div>';
}

/**
 * Product Thumbs
 * add div
 */
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

if ( ! function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {
    function woocommerce_template_loop_product_thumbnail() {
        echo woocommerce_get_product_thumbnail();
    }
}

if ( ! function_exists( 'woocommerce_get_product_thumbnail' ) ) {
    function woocommerce_get_product_thumbnail( $size = 'shop_catalog' ) {
        global $post, $woocommerce;
        $output = '<div class="product-thumbs">';

        if ( has_post_thumbnail() ) {
            $output .= get_the_post_thumbnail( $post->ID, $size );
        } else {
            $output .= wc_placeholder_img( $size );
            // Or alternatively setting yours width and height shop_catalog dimensions.
            // $output .= '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" width="300px" height="300px" />';
        }
        $output .= '</div>';
        return $output;
    }
}


/**
 * Checkout Page
 */

// Unset woo fields
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
function custom_override_checkout_fields( $fields ) {

    // remove fields
    $billing_order = array(
        "billing_last_name",
        "billing_company",
        "billing_address_2",
        "billing_country",
        "billing_city",
        "billing_postcode"
    );
    $shipping_order = array(
        "shipping_last_name",
        "shipping_company",
        "shipping_address_2",
        "shipping_country",
        "shipping_city",
        "shipping_postcode"
    );
    foreach($billing_order as $billing_field) {
        unset($fields['billing'][$billing_field]);
    }

    foreach($shipping_order as $shipping_field) {
        unset($fields['shipping'][$shipping_field]);
    }

    // Change placeholder
    $fields['billing']['billing_first_name']['label'] = 'নাম';
    $fields['billing']['billing_address_1']['label'] = 'ঠিকানা';
    $fields['billing']['billing_state']['label'] = 'জেলা';
    $fields['billing']['billing_email']['label'] = 'ইমেইল';
    $fields['billing']['billing_phone']['label'] = 'ফোন নাম্বার';
    $fields['billing']['billing_phone']['label'] = 'ফোন নাম্বার';

    $fields['order']['order_comments']['placeholder'] = 'অর্ডার বা পণ্য ডেলিভারি সংক্রান্ত আরো কোনো তথ্য থাকলে দিন';
    $fields['order']['order_comments']['label'] = 'অন্যান্য তথ্য';

    return $fields;
}

function checkout_create_account( $translated_text, $text, $domain ) {
    switch ( $translated_text ) {
        case 'Create an account?' :
            $translated_text = 'নতুন অ্যাকাউন্ট তৈরি করতে টিক দিন। অ্যাকাউন্ট তৈরি করে আপনি পরবর্তীতে দ্রুত কেনাকাটা করতে পারবেন এবং সবগুলি অর্ডারের সম্পর্কে বিস্তারিত দেখতে পারবেন অথবা ইতিমধ্যে অ্যাকাউন্ট তৈরি করে থাকলে';
            break;
    }
    return $translated_text;
}

add_filter( 'gettext', 'checkout_create_account', 20, 3 );


add_filter( 'jetpack_lazy_images_blacklisted_classes', 'bbloomer_exclude_custom_logo_class_from_lazy_load', 999, 1 );

function bbloomer_exclude_custom_logo_class_from_lazy_load( $classes ) {
    $classes[] = 'custom-logo';
    return $classes;
}


function ewos_send_sms( $order_id, $old_status, $new_status ) {

    $order = new WC_Order( $order_id );

    $user      = $order->get_user;

    $ewos_domain = 'http://www.bangladeshsms.com/';
    $ewos_api_key = 'C20000635d6bf0e1601273.18949602';
    $ewos_sender_id = '8809612446000';
    //$ewos_message = 'Thank you for ordering from XXXXXXXXXX! Your order number is #' . $order_id . '. For any help call us at 01xxxxxxxxx.';


    $ewos_message = 'Hi '. $order->get_billing_first_name(). ' Your Order ('. $order->get_id() .') Placed Properly. We will contact with you soon. bdchomok.com';

    $ewos_send_to = get_post_meta( $order->ID, '_billing_phone', true );

    $api_url = $ewos_domain . 'smsapi?api_key=' . $ewos_api_key . '&type=text&contacts=' . $ewos_send_to . '&senderid=' . rawurlencode($ewos_sender_id) . '&msg=' . rawurlencode($ewos_message);

    if ( !($old_status == 'pending' && $new_status == 'on-hold')) {
        file_get_contents($api_url);
    }

// 	$to = '';
// 	$subject = 'Order Notification';
// 	$headers = array('Content-Type: text/html; charset=UTF-8');
// 	wp_mail( $to, $subject, $ewos_message, $headers );

}
//add_action( 'woocommerce_order_status_changed', 'ewos_send_sms', 99, 3 );


//add_filter( 'woocommerce_product_categories_widget_args', 'widget_arguments' );

function widget_arguments( $args ) {

    //bdchomok_get_terms_by_handler();

    //return $args;
}