<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package bdchomok
 */

get_header();
?>

    <main id="main" class="site-main">
        <div class="container">
            <div class="row">
                <aside id="secondary" class="widget-area col-lg-3 col-md-4 col-12">
                    <section class="widget pr-3">
                        <h3 class="category-parent widget-title">
                            <?php echo esc_html( 'প্রকাশক' ); ?>
                        </h3>
                        <div class="cat-list-items">
                            <?php
                            $prod_cat_args = array(
                                'taxonomy'     => 'product_cat',
                                'orderby'      => 'name',
                                'include' => 32,
                                'empty'        => 0
                            );
                            $woo_categories = get_categories( $prod_cat_args );
                            $taxonomy_name = 'product_cat';
                            foreach ( $woo_categories as $woo_cat ) {
                                $term_id = $woo_cat->term_id;
                                $term_children = get_term_children($term_id, $taxonomy_name);

                                foreach ($term_children as $child) {
                                    $term = get_term_by('id', $child, $taxonomy_name);
                                    ?>
                                    <a class="d-block pt-1 pb-1 pr-0" href="<?php echo esc_url( get_term_link( $child, $taxonomy_name ) ); ?>"><?php echo esc_html( $term->name ); ?></a>
                                    <?php
                                }

                            }
                            ?>
                        </div>
                    </section>
                    <section class="widget pr-3">
                        <h3 class="category-parent widget-title">
                            <?php echo esc_html( 'বিষয়' ); ?>
                        </h3>
                        <div class="cat-list-items">
                            <?php
                            $prod_cat_args = array(
                                'taxonomy'     => 'product_cat',
                                'orderby'      => 'name',
                                'include' => 34,
                                'empty'        => 0
                            );
                            $woo_categories = get_categories( $prod_cat_args );
                            $taxonomy_name = 'product_cat';
                            foreach ( $woo_categories as $woo_cat ) {
                                $term_id = $woo_cat->term_id;
                                $term_children = get_term_children($term_id, $taxonomy_name);

                                foreach ($term_children as $child) {
                                    $term = get_term_by('id', $child, $taxonomy_name);
                                    ?>
                                    <a class="d-block pt-1 pb-1 pr-0" href="<?php echo esc_url( get_term_link( $child, $taxonomy_name ) ); ?>"><?php echo esc_html( $term->name ); ?></a>
                                    <?php
                                }

                            }
                            ?>
                        </div>
                    </section>
                    <section class="widget pr-3">
                        <h3 class="category-parent widget-title">
                            <?php echo esc_html( 'লেখক' ); ?>
                        </h3>
                        <div class="cat-list-items">
                            <?php
                            $prod_cat_args = array(
                                'taxonomy'     => 'product_cat',
                                'orderby'      => 'name',
                                'include' => 33 ,
                                'empty'        => 0
                            );
                            $woo_categories = get_categories( $prod_cat_args );
                            $taxonomy_name = 'product_cat';
                            foreach ( $woo_categories as $woo_cat ) {
                                $term_id = $woo_cat->term_id;
                                $term_children = get_term_children($term_id, $taxonomy_name);

                                foreach ($term_children as $child) {
                                    $term = get_term_by('id', $child, $taxonomy_name);
                                    ?>
                                    <a class="d-block pt-1 pb-1 pr-0" href="<?php echo esc_url( get_term_link( $child, $taxonomy_name ) ); ?>"><?php echo esc_html( $term->name ); ?></a>
                                    <?php
                                }

                            }
                            ?>
                        </div>
                    </section>
                </aside>

                <div class="col-lg-9 col-md-8 col-12 mt-30">
                    <div class="woocommerce columns-4">
                        <ul class="products columns-4">
                            <?php

                            $get = $_GET['s'];

                            $search_term = $get;
                            $search_term_slug = implode("-", explode(" ",$get));

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
                                    'posts_per_page'      => 24,
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
                                wc_get_template_part( 'content', 'product' );
                            endwhile;
                            endif;
                            //wp_reset_query();

                            ?>
                        </ul>
                    </div>
                </div>
                <?php
                get_sidebar();
                ?>
            </div>
        </div>
    </main><!-- #main -->

<?php
get_footer();