<?php
/**
 * Template part for displaying page content in page.php
 * @package sorce
 */
use sorce\Theme as Theme;
use sorce\core\mvc\Model as Model;
use sorce\core\mvc\View as View;

get_header(); 

if ( have_posts() ) {

	// Load posts loop.
	while ( have_posts() ) {

        the_post();
        $slug = get_post_field( 'post_name', get_the_ID() );
        ?>

        <div class="<?php echo Theme::textdomain ?>-page container-fluid clearfix px-0 mx-0" id="page-<?php echo $slug ?>">
            <div <?php post_class(); ?> >

                <div class="row clearfix page-header" style="background-image:url(<?php echo get_the_post_thumbnail_url() ?>);">
                    <div class="col-12 p-0 header-center">
                        <h1 class="page-title"><?php echo get_the_title() ?></h1>
                        <div class="entry-content" id="entry-<?php echo $slug ?>">
                            <?php
                            the_content();
                            ?>
                        </div><!-- .entry-content -->
                    </div><!-- col12 -->
                </div><!--row-->
                <div class="row mx-0 px-0 clearfix <?php echo Theme::textdomain ?>-modules">
                    <div class="col-12 m-0 p-0">
                    <?php 

                        /* CARBON FIELDS MODEL VIEW CONTROL FOR ALL PAGES */
                        /* GET THE FIELDS */
                        $template_sections = \maybe_unserialize( \get_option( $slug . '_template_fields' ) );
                        /* DATA */
                        $template_data = new Model( $template_sections, \get_the_ID() );
                        $template_name = $slug . '.php';
                        /* TEMPLATE MARKUP */
                        $markup = new View( $template_data->data_array, $template_name );

                        echo $markup->render();

                    ?>
                    </div>
                </div>
            </div>
        </div><!-- #post-<?php the_ID(); ?> -->
   

        <?php

	}



} 
get_footer();