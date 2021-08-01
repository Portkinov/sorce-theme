<?php
require_once \get_template_directory().'/template-parts/components/carousel.php';  
require_once \get_template_directory().'/template-parts/components/featured-cards.php';  
require_once \get_template_directory().'/template-parts/components/two-tiles.php';  
require_once \get_template_directory().'/template-parts/components/contactus.php';  

use friendlyrobot\components\Carousel as Carousel;
use friendlyrobot\components\HomeFeaturedCards as HomeFeaturedCards;
use friendlyrobot\components\TwoTiles as TwoTiles;
use friendlyrobot\components\ContactUs as ContactUs;


/**
 * The home page
 *         
 */

get_header();

global $post;

#Carousel
$slide_args = array('first_slide', 'second_slide', 'third_slide');
$section_carousel =  new Carousel('theme_mod', $slide_args);
$section_carousel->render();
#Section
?>
<div class="modspacer container-fluid" style="padding-top:20px;"></div>
<?php

#mission statement
?>
<div class="containerwrap missionstatement">
    <div class="container component">
        <div class="row">
            <div class="col-12 col-md-6">
                <img class="missionleft" src="<?php echo \get_the_post_thumbnail_url( $post->ID ) ?>" />
            </div>
    
            <div class="col-12 col-md-6">
                <h2 class="missionright"><?php echo \get_the_title( $post->ID ); ?></h2>
                <div class="missionright"><?php \the_content(); ?></div>
            </div>
        </div>
    </div>
</div>

<div class="modspacer container-fluid" style="padding-top:50px;"></div>

<?php

$cards = new TwoTiles();
$cards->render();

?>
<div class="modspacer container-fluid" style="padding-top:50px;"></div>
<?php

$cards = new HomeFeaturedCards();
$cards->render();

?>

<div class="modspacer container-fluid" style="padding-top:50px;"></div>
<?php

$starthere = new ContactUs();
$starthere->render();

?>

<div class="modspacer container-fluid" style="padding-top:50px;"></div>

<?php
get_footer();