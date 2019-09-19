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
    $tex_id = 1252;
    $get_cat = array (
    'post_per_page' => -1,
    'post_type' => 'product',
    'tax_query' => array(
    array(
    'taxonomy'  => 'product_cat',
    'field'     => 'term_id',
    'terms'     => array( $tex_id ),
    )
    ),
    );

    $loop = new WP_Query( $get_cat );


    if ( $loop->have_posts() ) {
    while ($loop->have_posts()) : $loop->the_post();


    $post_id = $loop->post->ID;

    $cats =  wp_get_post_terms( $post_id, 'product_cat' );
    //            var_dump($cats);
    $term_id = '';

    foreach ($cats as $cat){
    $term_id = $cat->term_id;
    }



    $subcats = wp_get_post_terms( $term_id, 'product_cat' );;




    echo '<div class="product-cat-filter-list">';
        foreach ($subcats as $sc) {
        $link = get_term_link($sc->slug, $sc->taxonomy);
        echo '<section class="widget"><h3 class="category-parent widget-title">'.esc_html( $sc->name ).'</h3>';
            $args2 = wp_get_post_terms( $sc->term_id, 'product_cat' );;



            foreach ($args2 as $subsubCats) {

            echo '<a class="product-filter-js full-width d-block overflow pt-1 pb-1" data-cat-id="'.$subsubCats->term_id.'" href=' . $subsubCats->slug . '><span>' . $subsubCats->name . '</span><span class="badge badge-danger float-right">'.$subsubCats->count.'</span></a>';
            }
            echo '</section>';
        }

        echo '</div>';



    //           wc_get_template_part( 'content', 'product' );
    endwhile;
    wp_reset_postdata();
    }
    ?>
</aside><!-- #secondary -->

