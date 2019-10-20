<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package preferred_magazine
 */

get_header();
?>

    <main id="content" class="site-main">
        <section class="single-post">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-8 col-12">
                        <?php
                        while ( have_posts() ) :
                            the_post();

                            get_template_part( 'template-parts/content-single', get_post_type() );

                            the_post_navigation();

                            // If comments are open or we have at least one comment, load up the comment template.
                            if ( comments_open() || get_comments_number() ) :
                                comments_template();
                            endif;

                        endwhile; // End of the loop.
                        ?>
                    </div>
                    <?php //get_sidebar(); ?>
                </div>
            </div>
        </section>

    </main><!-- #main -->

<?php
get_footer();
