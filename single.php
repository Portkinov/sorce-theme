<?php
/**
 * Template part for displaying page content in page.php
 * @package NakeyTheme
 */

get_header();

if ( have_posts() ) {

	// Load posts loop.
	while ( have_posts() ) {
        the_post();
                ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <?php if ( has_post_thumbnail() ) : ?>
                <header class="entry-header alignwide">
                    <?php the_post_thumbnail(); ?>
                </header>
            <?php endif; ?>

            <div class="entry-content">
                <?php
                the_content();
                ?>
            </div><!-- .entry-content -->

                <footer class="entry-footer default-max-width">

                </footer><!-- .entry-footer -->
        </article><!-- #post-<?php the_ID(); ?> -->
        <?php
	}



} else {

	// If no content, include the "No posts found" template.
	get_template_part( 'template-parts/content/content-none' );

}

get_footer();