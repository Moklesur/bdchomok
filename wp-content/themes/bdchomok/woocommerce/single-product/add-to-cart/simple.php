<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;


if ( ! $product->is_purchasable() ) {
	return;
}

echo wc_get_stock_html( $product ); // WPCS: XSS ok.

if ( $product->is_in_stock() ) : ?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

		<?php
		do_action( 'woocommerce_before_add_to_cart_quantity' );

		woocommerce_quantity_input( array(
			'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
			'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
			'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
		) );

		do_action( 'woocommerce_after_add_to_cart_quantity' );
		?>

		<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	</form>




    <?php

   $offer_content =  get_field('offer_content', $product->get_id());

   if ($offer_content){?>
       <div class="offer">
        <div class="d-flex green-text">
            <span class="icofont-volume-off  icofont-1x mr-2"></span>
            <span><?php  echo $offer_content;?></span>
            </div>
    </div>
  <?php }
    ?>

    <div class="wd-social-share mt-5">
        <span class="mb-3 ">শেয়ার করুন </span>
        <div class="addthis_sharing_toolbox mt-3">
            <ul class="social list-inline">
                <li class="list-inline-item"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo site_url().'/product/'.$product->slug;?>"><i class="icofont-facebook icofont-1x"></i></a></li>
                <li class="list-inline-item"><a href="https://twitter.com/home?status=<?php echo site_url().'/product/'.$product->slug;?>"><i class="icofont-twitter icofont-1x"></i></a></li>
                <li class="list-inline-item"><a href="https://pinterest.com/pin/create/button/?url=<?php echo site_url().'/product/'.$product->slug;?>"><i class="icofont-pinterest icofont-1x"></i></a></li>
                <li class="list-inline-item"><a href="https://plus.google.com/share?url=<?php echo site_url().'/product/'.$product->slug;?>"><i class="icofont-google-plus icofont-1x"></i></a></li>
                <li class="list-inline-item"><a href="http://www.linkedin.com/shareArticle?url=<?php echo site_url().'/product/'.$product->slug;?>"><i class="icofont-linkedin icofont-1x"></i></a></li>
            </ul>
        </div>
    </div>
	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>
