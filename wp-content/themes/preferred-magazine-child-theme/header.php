<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package preferred_magazine
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
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'preferred-magazine' ); ?></a>
<a href="#" id="back-to-top" title="<?php esc_attr_e( 'Back to top', 'preferred-magazine' ); ?>">&uarr;</a>
<div id="page" class="site">

    <header id="masthead" class="site-header">

        <?php if ( absint( get_theme_mod( 'hide_top_bar', true ) ) ) : ?>
            <section class="top-bar pt-2 pb-2">
                <div class="container-fluid">
                    <div class="row">
                        <?php do_action( 'preferred_magazine_news_feed' ); ?>
                        <div class="col-md-6 col-12 social-top-bar text-left text-md-right ">
                            <?php

                            if ( get_theme_mod( 'hide_top_bar_social', false ) === true ){
                                do_action( 'preferred_magazine_social' );
                            }

                            ?>
                        </div><!-- .social-top-bar -->
                    </div>
                </div>
            </section><!-- .top-bar -->
        <?php endif; ?>

        <section class="header-main pt-3 pb-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3 col-12">
                        <div class="site-branding">
                            <?php
                            the_custom_logo();
                            if ( is_front_page() && is_home() ) :
                                ?>
                                <h1 class="site-title mb-0"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                            <?php
                            else :
                                ?>
                                <h2 class="site-title mb-0"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
                            <?php
                            endif;
                            $preferred_magazine_description = get_bloginfo( 'description', 'display' );
                            if ( $preferred_magazine_description || is_customize_preview() ) :
                                ?>
                                <p class="site-description mb-0"><?php echo esc_html( $preferred_magazine_description ) /* WPCS: xss ok. */ ?></p>
                            <?php endif; ?>

                        </div><!-- .site-branding -->
                    </div>
                    <div class="col-md-4 col-12">
                        <form method="get" id="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <input type="text" name="s" id="search" placeholder="খুজুন ...." value="<?php the_search_query(); ?>" />
                            <button type="submit"><i class="ion-search"></i></button>
                        </form><!-- .search-form -->
                    </div>

                    <div class="col-md-5 col-12 text-right">
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="https://bdchomok.com/" target="_blank">বই কিনুন</a>
                            </li>
                            <li class="list-inline-item blog-write">
                                <a href="mailto:bdchomok5271@gmail.com" class="btn">ব্লগ লিখুন</a>
                            </li>
                            <li class="list-inline-item">
                                <a href="/subscribe" class="btn subscribe-btn">সাবস্ক্রাইব করুন</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </section><!-- .header-main -->

        <section class="bg-light pt-3 pb-3 main-menu">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-12">
                        <nav class="navbar navbar-expand-lg p-0">
                            <?php
                            wp_nav_menu( array(
                                    'theme_location'    => 'menu-1',
                                    'container'			=> 'div',
                                    'container_class'	=> 'collapse navbar-collapse',
                                    'container_id'		=> 'preferred-magazine-navbar-collapse',
                                    'menu_class'		=> 'navbar-nav',
                                    'fallback_cb'		=> 'WP_Bootstrap_Navwalker::fallback',
                                    'walker'			=> new WP_Bootstrap_Navwalker()
                                )
                            ); ?>

                        </nav><!-- #site-navigation -->
                    </div>
                </div>
            </div>

        </section><!-- .header-main -->

    </header><!-- #masthead -->

    <div class="search-dropdown">
        <?php get_search_form(); ?>
    </div>

    <?php



    if ( get_theme_mod( 'header_ads_show' ) ) : ?>

        <div class="ads-banner text-center">
            <?php if ( get_header_image() ) : ?>
                <a href="<?php echo esc_url( get_theme_mod( 'ads_url' ) );  ?>">
                    <img src="<?php header_image(); ?>"  alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" class="img-fluid">
                </a>
            <?php endif; ?>
        </div>

    <?php endif; ?>
    <?php if( is_front_page() ) : ?>
    <div class="trading-post mb-5">
        <div class="trading-post-wrap pt-3">
            <ul class="m-0 p-0">

                <?php
                // the query

                $the_query = new WP_Query( array( 'cat' => 33 ) ); ?>

                <?php if ( $the_query->have_posts() ) : ?>

                    <!-- pagination here -->

                    <!-- the loop -->
                    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

                        <li class="d-flex align-items-center">
                            <div class="trading-thumbs mr-3">
                                <?php
                                preferred_magazine_post_thumbnail();
                                ?>

                            </div>
                            <div class="trading-content pr-4">
                                <div class="entry-header">
                                    <?php

                                    the_title( '<h5 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h5>' );

                                    if ( 'post' === get_post_type() && absint( get_theme_mod('blog_post_meta', true ) ) ) :
                                        ?>
                                        <div class="entry-meta">
                                            <?php
                                            //preferred_magazine_posted_by();
                                            preferred_magazine_posted_on();
                                            ?>
                                        </div><!-- .entry-meta -->
                                    <?php endif; ?>
                                </div><!-- .entry-header -->
                            </div>

                        </li>


                    <?php endwhile; ?>
                    <!-- end of the loop -->

                    <!-- pagination here -->

                    <?php wp_reset_postdata(); ?>

                <?php else : ?>
                    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
                <?php endif; ?>


            </ul>
        </div>
    </div>
    <?php endif; ?>

    <div class="container p-0">
            <?php do_action( 'preferred_magazine_block_category' ); ?>
    </div>
