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

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'bdchomok' ); ?></a>

    <header id="masthead" class="site-header">

        <!-- .header-top start -->
        <div class="header-top">
            <div class="container">
                <div class="row d-flex align-items-center">
                    <!-- .logo start -->
                    <div class="col-lg-3 col-sm-4 col-6 logo">
                        <button class="navbar-toggler d-none" type="button" data-toggle="collapse" data-target="#bdchomok-main-menu-id" aria-controls="bdchomok-main-menu-id" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="site-branding pr-5">
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
                    <div class="col-lg-6 col-sm-4 col-12 advance-search">
                        <form class="advance-search-form" action="">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ...">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="icofont-search-2"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- .advance-search end -->
                    <!-- .cart-account start -->
                    <div class="col-lg-3 col-sm-4 col-6 cart-account">
                        <ul class="list-inline mb-0 text-right">
                            <li class="list-inline-item">
                                <div class="cart">
                                    <a href="#"><i class="icofont-shopping-cart"></i></a>
                                </div>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="btn"><?php esc_html_e( 'Log In', 'bdchomok' ); ?></a>
                            </li>
                        </ul>
                    </div>
                    <!-- .cart-account end -->
                </div>
            </div>


        </div>
        <!-- .header-top end -->

        <!-- .header-bottom start -->
        <div class="header-bottom main-menu">
            <div class="container">
                <nav class="navbar navbar-expand-lg p-0">
                    <?php
                    wp_nav_menu( array(
                            'theme_location'    => 'menu-1',
                            'container'			=> 'div',
                            'container_class'	=> 'collapse navbar-collapse',
                            'container_id'		=> 'bdchomok-main-menu-id',
                            'menu_class'		=> 'navbar-nav',
                            'fallback_cb'		=> 'WP_Bootstrap_Navwalker::fallback',
                            'walker'			=> new WP_Bootstrap_Navwalker()
                        )
                    ); ?>
                </nav>
            </div>
        </div>
        <!-- .header-bottom end -->

    </header><!-- #masthead -->

    <div id="content" class="site-content">