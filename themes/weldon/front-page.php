<?php

get_header();

// Place variables from Theme Settings here

if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		?>
		<main>

			<div class="section__constrained">
				<h3>Page content (front-page.php)</h3>
				<?php the_content(); ?>

				<?php get_template_part('page-templates/flexible-content'); ?>
			</div>

		</main>
		<?php
	}
}

get_footer(); ?>
