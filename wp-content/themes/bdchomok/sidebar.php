<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bdchomok
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
    return;
}
?>

<aside id="secondary" class="widget-area col-lg-3 col-md-4 col-12">

    <?php
    if( class_exists( 'WooCommerce' ) && is_product() ):
        dynamic_sidebar( 'shop-page' );
    else:
        dynamic_sidebar( 'sidebar-1' );
    endif;

    ?>
</aside><!-- #secondary -->

