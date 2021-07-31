<?php
/**
 * Header Template.
 *
 * <head> section until main.
 * @package starter
 */
use \starter\Starter as Theme;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<!-- UNCOMMENT WHEN YOU ADD FAVICON <link rel="icon" href="<?php echo \get_template_directory_uri() ?>/theme/assets/favicon.svg"> -->
	<meta name="description" content="" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open();
	$slug = get_post_field( 'post_name', get_post( get_the_ID() ) );
	$type = get_post_type( get_the_ID() );
	#for pages with no post name
	$slug = $slug ? $slug : 'four04';
	$type = $type ? $type : 'four04';
?>
<div id="page" class="container-fluid site <?php echo $type ?>">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', Theme::textdomain ); ?></a>

	<?php get_template_part( 'template-parts/header/site-header' ); 
	?>

	<div id="content" class="site-content px-0 mx-0 container-fluid">