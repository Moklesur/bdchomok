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
            <div class="header-top overflow-hidden  d-lg-block d-md-block d-sm-none">
                <div class="container-fluid">
                    <div class="row d-flex align-items-center">
                        <!-- .information start -->

                        <?php
                        if (get_field('delivery_offer','option')){?>
                            <div class="col-lg-6 col-sm-6 col-6 text-left">
                            <p><i class="fa fa-mobile mr-2"></i>  <?php echo get_field('delivery_offer','option');?></p>
                    </div>
                    <!-- .information end -->
                   <?php     }
                        ?>


                        <!-- .cart-account start -->
                        <div class="col-lg-6 col-sm-6 col-6 text-right">
                            <ul class="list-inline m-0 pr-2 text-right d-inline-block ">
                                <li class="list-inline-item">
                                    <div class="account-login-dropdown ">
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


                                <?php if(get_field('social_links','option')): ?>
                                    <ul class="list-inline social-links d-inline-block m-0 p-0 text-right">
                                    <?php while(has_sub_field('social_links','option')): ?>
                                            <li class="list-inline-item">
                                                <a href=" <?php the_sub_field('social_url'); ?>"><i class=" <?php the_sub_field('social_icon_name'); ?>"></i></a>
                                            </li>
                                        <?php endwhile; ?>
                                    </ul>
                                <?php endif; ?>

                        </div>
                        <!-- .cart-account end -->
                    </div>
                </div>
            </div>
            <!-- .header-top end -->

            <!-- .header-top start -->
            <div class="header-middle ">
                <div class="container">
                    <div class="row d-flex align-items-center">
                        <!-- .logo start -->
                        <div class="col-lg-3 col-sm-4 col-6 logo order-lg-0 order-0">
                            <div class="site-branding pr-0 pr-lg-5">

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
                        </div>
                        <!-- .logo end -->
                        <!-- .advance-search start -->
                        <div class="col-lg-6 col-sm-4 col-12 advance-search order-lg-1 order-2">
                            <form class="advance-search-form" action="">
                                <div class="input-group">
                                    <input type="text"   class="form-control advance-search-tri" placeholder="অনুসন্ধান করুন ..">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-success" type="submit"><i class="icofont-search-2"></i></button>
                                    </div>
                                    <div class="search-target text-center">
                                        <p class="wait h-100  pt-2 pb-2 text-center" id="wait2"></p>
                                    </div>
                                    <div class="search-content">


                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- .advance-search end -->
                        <!-- .cart-account start -->
                        <div class="col-lg-3 col-sm-4 col-6 cart-account order-lg-2 order-1">
                            <ul class="list-inline mb-0 ">

                                <?php
                                if (get_field('mobile_order_number','option')){?>
                                <li class="list-inline-item ml-2">
                                    <div class="d-inline-block">
                                        <p class="m-1"><?php echo get_field('mobile_order_text','option');?></p>
                                        <p class="m-0"><?php echo get_field('mobile_order_number','option');?></p>

                                    </div>
                                    <i class="icofont-support icofont-3x" ></i>

                                </li>
                               <?php } ?>
                                <?php if( class_exists( 'WooCommerce' ) ): ?>
                                    <li class="list-inline-item ml-2">
                                        <div class="cart-wrap position-relative">
                                            <a class="cart-contents" href="<?php echo wc_get_cart_url(); ?>" >
                                                <i class="icofont-shopping-cart"></i>
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
                    </div>
                </div>
            </div>
            <!-- .header-top end -->


        <!-- .header-bottom start -->
        <div class="header-bottom main-menu " data-toggle="affix">
            <div class="container">
                <nav class="navbar navbar-expand-lg p-0 " >

                    <button class="navbar-toggler d-lg-none d-inline-block" type="button" data-toggle="collapse" data-target="#bdchomok-main-menu-id" aria-controls="bdchomok-main-menu-id" aria-expanded="false" aria-label="Toggle navigation">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>

                    <?php
                    wp_nav_menu( array(
                            'theme_location'    => 'menu-1',
                            'container'			=> 'div',
                            'depth' => 2,
                            'container_class'	=> 'collapse navbar-collapse',
                            'container_id'		=> 'bdchomok-main-menu-id',
                            'menu_class'		=> 'navbar-nav ',
                            'fallback_cb'		=> 'WP_Bootstrap_Navwalker::fallback',
                            'walker'			=> new WP_Bootstrap_Navwalker()
                        )
                    ); ?>

                </nav>

            </div>
        </div>
        <!-- .header-bottom end -->

    </header><!-- #masthead -->

    <!-- Advance Search Form -->

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