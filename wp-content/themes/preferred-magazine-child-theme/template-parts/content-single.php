<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package preferred_magazine
 */
$class[] = 'block-contents mb-30';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $class ); ?>>
    <?php if ( has_post_thumbnail() && absint( get_theme_mod('single_featured_image', true ) ) ) : ?>
        <div class="post-thumb-items<?php echo ( has_post_thumbnail() ) ? ' has-items-thumb' : ''; ?> position-relative">
            <?php
            preferred_magazine_post_thumbnail();
            if ( absint( get_theme_mod('single_post_meta', true ) ) ) :
                ?>
                <div class="block-cats">
                    <?php preferred_magazine_cat_bg(); ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <div class="blog-content-wrap blog-content-single">

        <?php
        the_title( '<h1 class="entry-title">', '</h1>' );
        if ( ! has_post_thumbnail() && absint( get_theme_mod('single_post_meta', true ) ) ) : ?>
            <div class="block-cats">
                <?php preferred_magazine_cat_bg(); ?>
            </div>
        <?php
        endif;

        if ( 'post' === get_post_type() && absint( get_theme_mod('single_post_meta', true ) ) ) :
            ?>
            <div class="entry-header mb-20">
                <div class="entry-meta">
                    <?php

                    preferred_magazine_readingWP();

                    preferred_magazine_posted_on();
                    preferred_magazine_posted_by();

                    ?>
                    <ul class="social-share list-inline float-lg-right">
                        <li class="list-inline-item">Social Share : </li>
                       <li class="list-inline-item">
                           <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url( get_the_permalink() ); ?>"><i class="ion-social-facebook"></i></a>
                       </li>
                        <li class="list-inline-item">
                            <a href="https://twitter.com/home?status=<?php echo esc_url( get_the_permalink() ); ?>"><i class="ion-social-twitter"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url( get_the_permalink() ); ?>&title=&summary=&source="><i class="ion-social-linkedin"></i></a>
                        </li>
                    </ul>
                </div><!-- .entry-meta -->
            </div><!-- .entry-header -->
        <?php endif; ?>
        <div class="entry-content">
            <?php

            the_content( sprintf(
                wp_kses(
                /* translators: %s: Name of current post. Only visible to screen readers */
                    __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'preferred-magazine' ),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                get_the_title()
            ) );

            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'preferred-magazine' ),
                'after'  => '</div>',
            ) );
            ?>
        </div><!-- .entry-content -->
    </div><!-- .blog-content-wrap -->

</article><!-- #post-<?php the_ID(); ?> -->