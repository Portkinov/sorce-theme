<?php

use \sorce\Theme as Theme;

?>




<header class="container-fluid p-0 siteheader">

	
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
	$user = \wp_get_current_user();
	if($user){
		$loginout = '<a class="logout-link" href="'. get_site_url() .'/wp-login.php?action=logout">';
		$loginout.= '<span class="logout-button">Sign out</span></a></div>';
	} else {
		$loginout = '<a class="login-link" href="'. get_site_url() .'/wp-login.php">';
		$loginout.= '<span class="login-button">Log In</span></a></div>';
	}

?>

	<div class="buttongroup signin">

		<div class="button solid">Get a Demo</div>
		<div class="button two"><?php echo $loginout ?></div>
	</div>
</header>