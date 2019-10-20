<?php
/**
 * Template Name: No Title
 *
 * @package preferred_magazine
 * @subpackage preferred_magazine
 */
get_header();
?>

    <main id="main" class="site-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <?php
                    while ( have_posts() ) :
                        the_post();

                        get_template_part( 'template-parts/no', 'title' );

                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;

                    endwhile; // End of the loop.
                    ?>
                </div>
            </div>
        </div>


    </main><!-- #main -->

<?php

get_footer();