<?php

require_once \get_template_directory().'/template-parts/components/featured-cards.php';  



use sorce\components\HomeFeaturedCards as HomeFeaturedCards;


/**
 * The home page
 * trying with code
 *         
 */

get_header();

global $post;


#Section
?>


<div class="modspacer container-fluid" style="padding-top:50px;"></div>

<?php

#$cards = new TwoTiles();
#$cards->render();

?>
<div class="modspacer container-fluid" style="padding-top:50px;"></div>
<?php

#$cards = new HomeFeaturedCards();
#$cards->render();

?>

<div class="modspacer container-fluid" style="padding-top:50px;"></div>
<?php


?>

<div class="modspacer container-fluid" style="padding-top:50px;"></div>

<?php
get_footer();