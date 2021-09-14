<?php

use \sorce\Theme as Theme;

?>
<div class="container-fluid p-0 siteheader">

	
	<?php 

		$items_wrap = '<ul id="%1$s" class="%2$s">%3$s</ul>';
		$logo = \get_theme_mod( 'custom_logo');
		
		if( $logo ) {			

			$image = wp_get_attachment_image_src( $logo , 'full' );
			$image_url = $image[0];
			echo '<a class="navbar-brand" href="'.get_home_url().'"><img src="'.$image_url.'" ';
			echo 'class="logo-img" /><span class="sr-only">Home</span></a>';

		}
	?>
	
<?php

/* DONT NEED TOP MENU 

	wp_nav_menu( array(
		'items_wrap' => $items_wrap,
		'theme_location'  => Theme::textdomain . '_main_nav',
		'depth'           => 2, // 1 = no dropdowns, 2 = with dropdowns.
		'container'       => 'div',
		'container_class' => 'navbar navbar-expand-lg navbar-light',
		'container_id'    => 'topmenu',
		'menu_class'      => 'navbar-nav',
		#'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
		'walker'          => new \WP_Bootstrap_Navwalker(),
	) );
	*/
?>

<a class="logout-link" href="<?php echo get_site_url() ?>/wp-login.php?action=logout"><span class="logout-button">Sign out</span></a>
</div>