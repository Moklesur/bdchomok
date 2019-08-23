<?php


add_action( 'wp_enqueue_scripts', 'preferred_magazine_child_theme_enqueue_styles' );
function preferred_magazine_child_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

    wp_enqueue_script( 'theme_js', get_stylesheet_directory_uri() . '/js/custom.js', array( 'jquery' ), '1.0', true );
}

/**
 * Related Post
 */
function wpb_after_post_content(){
    if (is_single()) {

        $orig_post = $post;
        global $post;
        $categories = get_the_category($post->ID);
        if ($categories) {
            $category_ids = array();
            foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;

            $args=array(
                'category__in' => $category_ids,
                'post__not_in' => array($post->ID),
                'posts_per_page'=> 3, // Number of related posts that will be shown.
                'caller_get_posts'=>1
            );

            $my_query = new wp_query( $args );
            if( $my_query->have_posts() ) {
                echo '<hr><div id="related-posts" class="pb-4 pt-2"><h3 class="mb-4">Related Posts</h3><div class="row">';
                while( $my_query->have_posts() ) {
                    $my_query->the_post();?>
                    <div class="col-12 col-md-4 d-flex align-items-lg-center">
                        <div class="related-thumb mr-3">
                            <a href="<? the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_post_thumbnail(); ?></a>
                        </div>
                        <div class="related-content">
                            <p class="mb-0"><a href="<? the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></p>
                            <span class="small"><?php the_time('M j, Y') ?></span>
                        </div>
                    </div>
                    <?
                }
                echo '</div></div><hr>';
            }
        }
        $post = $orig_post;
        wp_reset_query();
    }

}
add_filter( "comment_form_before", "wpb_after_post_content" );