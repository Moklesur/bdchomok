<?php
//Add Ajax Actions
function advance_search(){
    $search_term = esc_attr( $_POST['keyword'] );

    if(!empty($search_term)):
        $productArgs = array(
            'posts_per_page' => -1,
            'post_type' => array( 'product' ),
            's' => $search_term,
            'slug' =>$search_term
        );
        $productLoop = new WP_Query( $productArgs );

        if ( $productLoop->have_posts() ) {

            $output = $productImage = '';

            $output .= '<h6 class="text-uppercase">shop</h6>';

            $product_count = 1;
            $output .= '   <div class="table-responsive">
                     <table class="table table-hover">
                           
                            <tbody>';

            while ($productLoop->have_posts()) : $productLoop->the_post();

                global $post;
                $post_slug=$post->post_name;

                // Product Data
                if ($product_count <= 10 ) {
                    $product_count++;
                    if (has_post_thumbnail($productLoop->post->ID)) {
                        $productImage = get_the_post_thumbnail($productLoop->post->ID, array(60, 60), array('class' => 'img-fluid'));
                    }

                    $terms = get_the_terms($productLoop->post->ID, 'product_cat');

                    $product = wc_get_product( $productLoop->post->ID );
                    $category_name = [];
                    $termLink = [];
                    foreach ($terms as $term) {
                        if ($term->parent == 0):
                            $category_name[] = $term->name;
                            $termLink = $term->slug;
                        endif;
                        break;
                    }




                    $output .= '<div class="search-product-items  align-items-center">
                 
                              <tr class="aligncenter">
                                <td width="10%">
                                    <a href="'.get_post_permalink($productLoop->post->id).'" class="load_popup" data-pid="'.$productLoop->post->ID.'">' . $productImage . '</a>
                  
                                  </td>
                                <td width="70%">
                                  <a href="'.get_post_permalink($productLoop->post->id).'" class="product-title d-block " data-pid="'.$productLoop->post->ID.'">' . get_the_title() .'('.strtolower(trim( $post_slug)).')'.'</a>
                     
                                <a href="'.site_url().'/product-category/'.$termLink.'" class="product-cat d-block ">' . implode(', ', $category_name) . '</a>
                              
                                   </td>';
                    if ($product->get_regular_price()){
                        $output .='  <td width="30%"> <p class="float-right ">  <span class="woocommerce-Price-amount amount"> '.$product->get_price().'</span> <span class="woocommerce-Price-currencySymbol">৳&nbsp;</span></p>
                   </td>';
                    }

                    $output .='   </tr>
                           
                 
                
                   </div>';
                }


            endwhile;
            wp_reset_postdata();

            if ($productLoop->post_count > 10) {
                $output .= '  </tbody>
                          </table>
                    </div>
                      <div class="show-more-search"><span><span></span></span><a href="'.get_bloginfo('url').'?s='.$search_term.'&p_type=product">Show all ' . $productLoop->post_count . ' results</a></div>';
            }
        }

    endif;
    echo json_encode(array('output' => $output));
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