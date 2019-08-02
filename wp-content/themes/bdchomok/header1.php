<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bdchomok
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.3"></script>

    <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                xfbml            : true,
                version          : 'v3.3'
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

    <!-- Your customer chat code -->
    <div class="fb-customerchat"
         attribution=setup_tool
         page_id="266866433725283"
         theme_color="#51b848">
    </div>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="text-center loading-wrap d-none">
    <div class="d-table">
        <div class="d-table-cell align-middle">
            <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>
</div>


<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'bdchomok' ); ?></a>

    <header id="masthead" class="site-header">

        <!-- .header-top start -->
        <div class="header-top overflow-hidden d-none d-lg-block">
            <div class="container">
                <div class="row d-flex align-items-center">
                    <!-- .information start -->
                    <div class="col-lg-8 col-sm-7 col-6 info-box">
                        <ul class="m-0 list-inline">
                            <li class="list-inline-item">
                                <i class="icofont-location-pin"></i> Dhaka 1200, BD
                            </li>
                            <li class="list-inline-item">
                                <i class="icofont-envelope-open"></i> contact@bdchomok.com
                            </li>
                            <li class="list-inline-item">
                                <i class="icofont-headphone-alt"></i> +019 111 44444
                            </li>
                        </ul>
                    </div>
                    <!-- .information end -->

                    <!-- .cart-account start -->
                    <div class="col-lg-4 col-sm-5 col-6 account">
                        <ul class="list-inline mb-0 text-right">
                            <li class="list-inline-item">
                                <div class="account-login-dropdown">
                                    <?php if ( is_user_logged_in() ) { ?>
                                        <a class="mr-2" href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id' ) ) ); ?>"><i class="ion-ios-person-outline"></i> <?php esc_html_e( 'অ্যাকাউন্ট','bdchomok'); ?></a>
                                        <a  href="<?php echo esc_url( wp_logout_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ) ); ?>"><i class="ion-log-out"></i> <?php esc_html_e( 'বাহির','bdchomok' ); ?></a>
                                    <?php }
                                    else { ?>
                                        <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>"><?php esc_html_e( 'প্রবেশ / নিবন্ধন','bdchomok' ); ?></a>
                                    <?php } ?>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- .cart-account end -->
                </div>
            </div>
        </div>
        <!-- .header-top end -->

        <!-- .header-bottom start -->
        <div class="header-bottom main-menu pt-lg-0 pb-lg-0 pt-4 pb-4">
            <div class="container">
                <nav class="navbar navbar-expand-lg p-0">

                    <!-- .logo start -->
                    <div class="site-branding logo">
                        <button class="navbar-toggler d-lg-none d-inline-block" type="button" data-toggle="collapse" data-target="#bdchomok-main-menu-id" aria-controls="bdchomok-main-menu-id" aria-expanded="false" aria-label="Toggle navigation">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span class="menu-btn">MENU</span>
                        </button>
                        <?php
                        the_custom_logo();
                        if ( is_front_page() && is_home() ) :
                            ?>
                            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                        <?php
                        else :
                            ?>
                            <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                        <?php
                        endif;
                        $bdchomok_description = get_bloginfo( 'description', 'display' );
                        if ( $bdchomok_description || is_customize_preview() ) :
                            ?>
                            <p class="site-description"><?php echo $bdchomok_description; /* WPCS: xss ok. */ ?></p>
                        <?php endif; ?>
                    </div><!-- .site-branding -->
                    <!-- .logo end -->
                    <?php
                    wp_nav_menu( array(
                            'theme_location'    => 'menu-1',
                            'container'			=> 'div',
                            'container_class'	=> 'collapse navbar-collapse',
                            'container_id'		=> 'bdchomok-main-menu-id',
                            'menu_class'		=> 'navbar-nav ml-auto',
                            'fallback_cb'		=> 'WP_Bootstrap_Navwalker::fallback',
                            'walker'			=> new WP_Bootstrap_Navwalker()
                        )
                    ); ?>
                    <!-- .cart-account start -->
                    <div class="cart-search">
                        <ul class="list-inline mb-0 text-right">
                            <li class="list-inline-item ml-2 ml-lg-4">
                                <a href="#" class="advance-search-tri" data-toggle="modal" data-target="#advance-search"><i class="icofont-search-2"></i></a>
                            </li>
                            <li class="list-inline-item ml-2 ml-lg-4 d-lg-none d-inline-block">
                                <!-- .cart-account start -->
                                <div class="account dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="icofont-ui-user"></i>
                                    </a>
                                    <ul class="list-unstyled mb-0 dropdown-menu dropdown-menu-right p-3">
                                        <li>

                                            <?php if ( is_user_logged_in() ) { ?>
                                                <a class="mr-2" href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id' ) ) ); ?>"><i class="ion-ios-person-outline"></i> <?php esc_html_e( 'অ্যাকাউন্ট','bdchomok'); ?></a>
                                                <a  href="<?php echo esc_url( wp_logout_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ) ); ?>"><i class="ion-log-out"></i> <?php esc_html_e( 'বাহির','bdchomok' ); ?></a>
                                            <?php }
                                            else { ?>
                                                <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>"><?php esc_html_e( 'প্রবেশ / নিবন্ধন','bdchomok' ); ?></a>
                                            <?php } ?>

                                        </li>
                                    </ul>
                                </div>
                                <!-- .cart-account end -->
                            </li>
                            <?php if( class_exists( 'WooCommerce' ) ): ?>
                                <li class="list-inline-item ml-lg-2">
                                    <div class="cart-wrap position-relative">
                                        <a class="cart-contents" href="<?php echo wc_get_cart_url(); ?>" >
                                            <i class="icofont-grocery"></i>
                                            <span>
										<?php echo sprintf ( _n( ' %d', ' %d', WC()->cart->get_cart_contents_count(), 'bdchomok' ), WC()->cart->get_cart_contents_count() ); ?>
									</span>
                                        </a>
                                        <div class="mini-cart-fix">
                                            <?php woocommerce_mini_cart(); ?>
                                        </div>
                                    </div>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <!-- .cart-account end -->
                </nav>

            </div>
        </div>
        <!-- .header-bottom end -->

    </header><!-- #masthead -->

    <!-- Advance Search Form -->
    <div class="modal fade advance-search" id="advance-search" tabindex="-1" role="dialog" aria-labelledby="advance-search" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <form role="search" method="get" class="woocommerce-product-search" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
                        <div class="input-group mb-3 mt-4">
                            <input type="search" class="form-control m-0" placeholder="<?php echo esc_attr_x( 'Search Products&hellip;', 'placeholder', 'woocommerce' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'woocommerce' ); ?>" />
                            <div class="input-group-append">
                                <button type="submit" id="button-addon2"><i class="icofont-search-2"></i></button>
                            </div>
                        </div>
                        <input type="hidden" name="post_type" value="product" />
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="breadcrumb-wrap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?php woocommerce_breadcrumb(); ?>
                </div>
            </div>
        </div>
    </div>


    <div id="content" class="site-content">