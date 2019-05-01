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
<div class="modal fade bd-example-modal-lg product-card-model" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div id='popup_cart_info' class='col-sm-6'>

                <div class='cart_info'>
                     <h3>Product name: </h3>
                </div>

            </div>

        </div>
    </div>
</div>

<?php wp_footer(); ?>

</body>
</html>