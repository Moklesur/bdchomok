<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bdchomok
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <div class="row mb-5">
      <div class="col-lg-6 col-6">
          post
          <?php bdchomok_post_thumbnail(); ?>
      </div>
      <div class="col-6 col-6">
          <header class="entry-header">
              <?php
              if ( is_singular() ) :
                  the_title( '<h1 class="entry-title">', '</h1>' );
              else :
                  the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
              endif;

              if ( 'post' === get_post_type() ) :
                  ?>
                  <div class="entry-meta">
                      <?php
                      bdchomok_posted_on();
                      bdchomok_posted_by();
                      ?>
                  </div><!-- .entry-meta -->
              <?php endif; ?>
          </header><!-- .entry-header -->
          <div class="entry-content">
              <?php
              if( ! is_singular() ){
                  the_excerpt();
              }else {
                  the_content( sprintf(
                      wp_kses(
                      /* translators: %s: Name of current post. Only visible to screen readers */
                          __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'bdchomok' ),
                          array(
                              'span' => array(
                                  'class' => array(),
                              ),
                          )
                      ),
                      get_the_title()
                  ) );
              }


              wp_link_pages( array(
                  'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bdchomok' ),
                  'after'  => '</div>',
              ) );
              ?>

              <a href="<?php the_permalink(); ?>" class="btn text-uppercase"> Read More</a>
          </div><!-- .entry-content -->
      </div>
  </div>

</article><!-- #post-<?php the_ID(); ?> -->
