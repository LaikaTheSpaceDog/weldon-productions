<!DOCTYPE html>
<!-- +++header -->
<html lang="en">

<?php get_template_part('head'); ?>

<body <?php body_class(); ?>>

<?php
// Tracking scripts for body block
renderTrackingCodes('body');
?>

<header class="l-header">

	<div class="section__constrained">
		<a href="<?php echo get_home_url(); ?>" class="l-header__logo">
			Your logo here
			<!-- Place here your SVG logo -->
		</a>
		<nav class="l-header__nav nav__container">
			<h3>Header Menu</h3>
			<p>(Create a Wordpress Menu and assign it to "Header" location)</p>
			<?php
			$args = array(
				'theme_location' => 'header',
				'container' => false,
				'menu_class' => 'nav nav--header hvr--nav',
				'menu_id' => '',
				'depth' => 0
			);
			wp_nav_menu($args);
			?>
		</nav>
		<div id="js-brg" class="l-header__brg btn--brg" role="button">
			<span></span>
			<span></span>
			<span></span>
		</div>

	</div>

</header>
