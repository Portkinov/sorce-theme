<?php
require_once \get_template_directory().'/classes/wp-bootstrap-navwalker.php'; 

use friendlyrobot\Theme as Theme;

?>
<div class="container-fluid siteheader">

	
	
<?php
if( \carbon_get_theme_option('use_hamburger_menu') !== 'yes'){

		$items_wrap = '<ul id="%1$s" class="%2$s">%3$s</ul>';
		$logo = \get_theme_mod( 'custom_logo');
		
		if( $logo ) {			

			$image = wp_get_attachment_image_src( $logo , 'full' );
			$image_url = $image[0];
			$markup='<a class="navbar-brand" href="'.get_home_url().'"><img src="'.$image_url.'" ';
			$markup.= 'class="logo-img" /><span class="sr-only">Home</span></a>';
			$items_wrap = $markup  . $items_wrap;
		} 


	wp_nav_menu( array(
		'items_wrap' => $items_wrap,
		'theme_location'  => Theme::textdomain . '_main_nav',
		'depth'           => 2, // 1 = no dropdowns, 2 = with dropdowns.
		'container'       => 'div',
		'container_class' => 'navbar navbar-expand-lg nomobile',
		'container_id'    => 'topmenu',
		'menu_class'      => 'navbar-nav nomobile',
		'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
		'walker'          => new WP_Bootstrap_Navwalker(),
	) );
} else {

		$items_wrap = '<ul id="%1$s" class="%2$s">%3$s</ul>';
		$mobile_toggle = '<button id="mobilenav_button" class="navbar-toggler" type="button" data-toggle="collapse"';
		$mobile_toggle.= 'data-target="#'.Theme::textdomain.'_mobile_menu" aria-controls="navbarSupportedContent" ';
		$mobile_toggle.= 'aria-expanded="false" aria-label="Toggle navigation">';
		$mobile_toggle.= '<div class="burger burger-squeeze"><div class="burger-lines"></div></div>';
		$mobile_toggle.=  '</button>';
		$logo = \get_theme_mod( 'custom_logo');
		
		if( $logo ) {			

			$image = wp_get_attachment_image_src( $logo , 'full' );
			$image_url = $image[0];
			$markup='<a class="navbar-brand" href="'.get_home_url().'"><img src="'.$image_url.'" ';
			$markup.= 'class="logo-img" /><span class="sr-only">Home</span></a>';
			$items_wrap = $markup . $mobile_toggle . $items_wrap;
		} else {
			$items_wrap = $mobile_toggle . $items_wrap;
		}

	wp_nav_menu( array(
		'items_wrap' => $items_wrap,
		'theme_location'  => Theme::textdomain . '_main_nav',
		'depth'           => 2, // 1 = no dropdowns, 2 = with dropdowns.
		'container'       => 'div',
		'container_class' => 'navbar navbar-expand-lg',
		'container_id'    => 'topmenu',
		'menu_class'      => 'navbar-nav',
		'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
		'walker'          => new WP_Bootstrap_Navwalker(),
	) );

?>
<div id="<?php echo Theme::textdomain ?>_mobile_menu">
<?php
	wp_nav_menu( array(
		'theme_location'  => Theme::textdomain . '_main_nav',
		'depth'           => 2, // 1 = no dropdowns, 2 = with dropdowns.
		'container'       => 'nav',
		'container_class' => 'navbar ',
		'container_id'    => 'mobilenav',
		'menu_class'      => 'navbar-nav',
		'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
		'walker'          => new WP_Bootstrap_Navwalker(),
	) );
?>
</div>
<?php } ?>

<div class="topdonate">
	<?php

		if( \carbon_get_theme_option('payment_button')){
			
			if( do_shortcode( \carbon_get_theme_option('payment_button') ) !== \carbon_get_theme_option('payment_button') ){
				echo do_shortcode( \carbon_get_theme_option('payment_button') );
			}
		}
	  ?>
</div>
</div>


