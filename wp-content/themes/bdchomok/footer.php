<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bdchomok
 */

?>


</div><!-- #content -->

<footer id="colophon" class="site-footer">
    <?php
    if ( is_active_sidebar( 'footer-top' ) ) :
        ?>
    <div class="footer-top delivery-info">
        <div class="container">
            <?php
                dynamic_sidebar( 'footer-top' );
            ?>
        </div>
    </div><!-- .footer-top -->
    <?php
    endif;
    ?>


    <div class="footer-middle">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 footer-top-padding">
                    <?php
                    if ( is_active_sidebar( 'footer-widget' ) ) :
                        dynamic_sidebar( 'footer-widget' );
                    endif;
                    ?>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 footer-top-padding">

                    <ul class="footer-nav text-capitalize">
                        <li>
                            <a href="#">home</a>
                        </li>
                        <li>
                            <a href="#">about</a>
                        </li>
                        <li>
                            <a href="#">contact</a>
                        </li>
                        <li>
                            <a href="#">product</a>
                        </li>
                        <li>
                            <a href="#">Service</a>
                        </li>
                        <li>
                            <a href="#">Terms and condition</a>
                        </li>
                    </ul>
                    <?php
                    if ( is_active_sidebar( 'footer-widget-2' ) ) :
                        dynamic_sidebar( 'footer-widget-2' );
                    endif;
                    ?>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 col-12 footer-top-padding">
                    <?php
                    if ( is_active_sidebar( 'footer-widget-3' ) ) :
                        dynamic_sidebar( 'footer-widget-3' );
                    endif;
                    ?>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-6 col-12 footer-top-padding">
                    <?php
                    if ( is_active_sidebar( 'footer-widget-4' ) ) :
                        dynamic_sidebar( 'footer-widget-4' );
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div><!-- .footer-top -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="site-info text-center">
                        <p><?php esc_html_e( '© 2019 bdchomok', 'bdchomok' ); ?></p>
                    </div><!-- .site-info -->
                </div>
            </div>
        </div>
    </div><!-- .footer-bottom -->

</footer><!-- #colophon -->
</div><!-- #page -->

<div class="modal fade bd-example-modal-lg quick-view-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header ml-auto">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg product-card-model" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header ml-auto">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="row">
                <div  class='col-12 popup_cart_info'>


                </div>
            </div>
            <div class="row mb-2">
                    <div class="col-6 text-left">
                        <a class="btn" href="<?php echo site_url().'/shop' ?>">More Product Add</a>
                    </div>

                    <div class="col-6 text-right">
                        <?php
                        global $woocommerce;
                        $checkout_page_url = function_exists( 'wc_get_cart_url' ) ? wc_get_checkout_url() : $woocommerce->cart->get_checkout_url();
                        ?>
                        <a class="btn" href="<?php echo $checkout_page_url; ?>">Please Order here</a>
                    </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <h2>Our Other Products</h2>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

<?php wp_footer(); ?>

</body>
</html>