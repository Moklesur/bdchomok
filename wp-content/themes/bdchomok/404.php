<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package bdchomok
 */

get_header();
?>

    <main id="main" class="site-main">

        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="error-404 not-found">
                        <div class="page-header">
                            <h1 class="page-title"><?php esc_html_e( 'Oops Error! Page Not Found', 'bdchomok' ); ?></h1>
                        </div><!-- .page-header -->

                        <div class="page-content">
                            <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'bdchomok' ); ?></p>

                            <?php
                            get_search_form();
                            ?>

                        </div><!-- .page-content -->
                    </div><!-- .error-404 -->
                </div>
            </div>
        </div>
    </main><!-- #main -->

<?php
get_footer();
