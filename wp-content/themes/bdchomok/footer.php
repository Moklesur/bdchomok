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
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="site-info text-center">
                    <p>© 2019 bdchomok</p>
                </div><!-- .site-info -->
            </div>
        </div>
    </div>

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
        <div class="modal-content p-5">
            <div class="row">
                <div id='popup_cart_info' class='col-8 text-center m-auto'>

                    <div class='cart_info'>

                    </div>

                </div>
            </div>
            <div class="row mb-2">
                    <div class="col-6 text-left">
                        <a href="<?php echo site_url().'/shop' ?>">More Product Add</a>
                    </div>

                    <div class="col-6 text-right">
                        <?php
                        global $woocommerce;
                        $checkout_page_url = function_exists( 'wc_get_cart_url' ) ? wc_get_checkout_url() : $woocommerce->cart->get_checkout_url();
                        ?>
                        <a href="<?php echo $checkout_page_url; ?>">Please Order here</a>
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

<?php wp_footer(); ?>

</body>
</html>