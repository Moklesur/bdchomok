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

        if(class_exists( 'WooCommerce' ) && is_product_category()) {


            $terms = new BD_Chomok_Sidebar;
            $terms = $terms->get_all_terms();

            if(isset($terms['publishers']) && ! empty($terms['publishers'])) {
                echo '<section class="widget"><h3 class="category-parent widget-title">'.__( 'প্রকাশক', '' ).'</h3>';
                foreach($terms['publishers'] as $publisher) {
                    echo '<a class="product-filter-js full-width d-block overflow pt-1 pb-1" data-cat-id="'.$publisher->term_id.'" href=' . esc_url( get_term_link($publisher->slug, 'product_cat') ) . '><span>' . $publisher->name . '</span><span class="badge badge-danger float-right">'.$publisher->count.'</span></a>';
                }
                echo '</section>';
            }

            if( isset($terms['subjects']) && ! empty($terms['subjects']) ) {
                echo '<section class="widget"><h3 class="category-parent widget-title">'.__( 'বিষয় সমূহ', '' ).'</h3>';

                foreach($terms['subjects'] as $subject) {
                    echo '<a class="product-filter-js full-width d-block overflow pt-1 pb-1" data-cat-id="'.$subject->term_id.'" href=' . esc_url( get_term_link($subject->slug, 'product_cat') ) . '><span>' . $subject->name . '</span><span class="badge badge-danger float-right">'.$subject->count.'</span></a>';
                }

                echo '</section>';

            }

            if( isset($terms['authors']) && ! empty($terms['authors']) ) {
                echo '<section class="widget"><h3 class="category-parent widget-title">'.__( 'লেখক', '' ).'</h3>';

                foreach($terms['authors'] as $author) {
                    echo '<a class="product-filter-js full-width d-block overflow pt-1 pb-1" data-cat-id="'.$author->term_id.'" href=' . esc_url( get_term_link($author->slug, 'product_cat') ) . '><span>' . $author->name . '</span><span class="badge badge-danger float-right">'.$author->count.'</span></a>';

                }

                echo '</section>';
            }

            if(isset($terms['brands']) && ! empty($terms['brands'])) {
                echo '<section class="widget"><h3 class="category-parent widget-title">'.__( 'Brands', '' ).'</h3>';

                foreach($terms['brands'] as $brand) {
                    echo '<a class="product-filter-js full-width d-block overflow pt-1 pb-1" data-cat-id="'.$brand->term_id.'" href=' . esc_url( get_term_link($brand->slug, 'product_cat') ) . '><span>' . $brand->name . '</span><span class="badge badge-danger float-right">'.$brand->count.'</span></a>';
                }
                echo '</section>';
            }

            if(isset($terms['accessories']) && ! empty($terms['accessories'])) {
                echo '<section class="widget"><h3 class="category-parent widget-title">'.__( 'Accessories', '' ).'</h3>';

                foreach( $terms['accessories'] as $ac ) {
                    echo '<a class="product-filter-js full-width d-block overflow pt-1 pb-1" data-cat-id="'.$ac->term_id.'" href=' . esc_url( get_term_link($ac->slug, 'product_cat') ) . '><span>' . $ac->name . '</span><span class="badge badge-danger float-right">'.$ac->count.'</span></a>';
                }

                echo '</section>';
            }


            dynamic_sidebar( 'sidebar-1' );
        }

    endif;

    ?>
</aside><!-- #secondary -->

