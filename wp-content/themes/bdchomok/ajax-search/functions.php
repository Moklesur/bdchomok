<?php
//Add Ajax Actions
function advance_search(){
    $search_term = $_POST['keyword'];
    $search_term_slug = implode("-", explode(" ",$search_term));

    global $wpdb;
    $query = "select ID from a2f_posts where post_type='product' and post_status='publish' and (post_name like '%" . $search_term_slug . "%' or post_title like '%" . $search_term . "%') limit 10";

    $results = $wpdb->get_results($query);

    $product_ids = [];
    foreach( $results as $product ){
        $product_ids[] = $product->ID;
    }

    $args = array(
        'post_type' => 'product',
        'orderby' => 'ASC',
        'post__in' => $product_ids
    );

    $output = $productImage = $price ='';
    $output .= '<ul  class="list-group list-group-flush ">';

    $loop = new WP_Query( $args );

    if ( $loop->have_posts() ) : while( $loop->have_posts() ) : $loop->the_post();

        if (has_post_thumbnail($loop->post->ID)) {
            $productImage = get_the_post_thumbnail($loop->post->ID, array(60, 60), array('class' => 'img-fluid'));
        }

        $product_cat = wc_get_product_category_list($loop->post->ID);

        $product = wc_get_product( $loop->post->ID );

        if ($product->get_regular_price()){
            $price ='<div class="search-product-price ml-auto"><span class="woocommerce-Price-amount amount"> '.$product->get_price().'</span><span class="woocommerce-Price-currencySymbol">৳&nbsp;</span></div>';
        }

        $output .= '<li class="list-group-item position-relative"><a class="position-absolute d-block search-link" href="' . esc_url( get_the_permalink() ) . '"></a>';
        $output .= '<div class="d-flex align-content-center">';
        $output .= $productImage;
        $output .= '<div class="pl-3 pr-4"><h5 class="m-0">' . esc_html( get_the_title() ) . '</h5>';
        $output .= '<p class="search-product-cat">'.$product_cat.'</p></div>';
        $output .= $price;
        $output .= '</div>';
        $output .= '</li>';

    endwhile;
    endif;
    wp_reset_query();

    $output .= '</ul>';

    if (!empty($results)) {
        echo json_encode(array('output' => $output ));
    } else {
        echo json_encode(array('output' => 'no result found.'));
    }

    exit();

}

add_action( 'wp_ajax_advance_search', 'advance_search' );
add_action( 'wp_ajax_nopriv_advance_search', 'advance_search');

//Cat Filer
function cat_filter(){
    
    $tex_id = $_POST['cat_ID'];
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
           wc_get_template_part( 'content', 'product' );
        endwhile;
        wp_reset_postdata();
    }
}

add_action( 'wp_ajax_cat_filter', 'cat_filter' );
add_action( 'wp_ajax_nopriv_cat_filter', 'cat_filter' );