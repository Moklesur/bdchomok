<?php
//Add Ajax Actions
function advance_search(){
    $search_term = $_POST['keyword'];
    $search_term_slug = implode("-", explode(" ",$search_term));

    global $wpdb;
    $query = "select ID from a2f_posts where post_type='product' and post_status='publish' and (post_name like '%" . $search_term_slug . "%' or post_title like '%" . $search_term . "%') limit 10";

    $results = $wpdb->get_results($query);

    $product_ids = [987567888];
    foreach( $results as $product ){
        $product_ids[] = $product->ID;
    }

    $args = array(
        'post_type' => array('product'),
        'post_status'           => 'publish',
        'orderby' => 'ASC',
        'post__in' => $product_ids
    );

    $output = $productImage = $price ='';
    $output .= '<ul class="list-group list-group-flush">';

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


    $all_cats = get_categories(['taxonomy' => 'product_cat']);
    $search_result_cats = [];
    $cat_name = '';
    foreach ($all_cats as $single_cat) {
        if (strpos($single_cat->name, $search_term) !== false || strpos($single_cat->slug, $search_term_slug) !== false) {
            $search_result_cats[] = $single_cat->cat_ID;
            $cat_name = $single_cat->name;
        }
    }

    $args2 = array(
        'post_type'             => 'product',
        'post_status'           => 'publish',
        'ignore_sticky_posts'   => 1,
        'orderby'               => 'ASC',
        'tax_query'             => array(
            array(
                'taxonomy'      => 'product_cat',
                'field' => 'term_id', //This is optional, as it defaults to 'term_id'
                'terms'         => $search_result_cats,
                'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
            )
        )
    );

    $loop2 = new WP_Query( $args2 );

    if ( $loop2->have_posts() ) : while( $loop2->have_posts() ) : $loop2->the_post();



        if (has_post_thumbnail($loop2->post->ID)) {
            $productImage = get_the_post_thumbnail($loop2->post->ID, array(60, 60), array('class' => 'img-fluid'));
        }

        $product_cat = wc_get_product_category_list($loop2->post->ID);

        $product = wc_get_product( $loop2->post->ID );

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

    if ($output != '<ul class="list-group list-group-flush"></ul>') {
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