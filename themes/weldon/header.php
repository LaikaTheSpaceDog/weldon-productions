<!DOCTYPE html>
<!-- +++header -->
<html lang="en">

<?php get_template_part('head'); ?>

<body <?php body_class(); ?>>

<header class="l-header">

	<div class="section__constrained">
		<h1>Zoe Weldon Productions</h1>
		<nav class="l-header__nav nav__container">
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
