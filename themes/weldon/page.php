<?php

get_header();

if ( have_posts() ) {
  while ( have_posts() ) {
    the_post();
    ?>
    <main>

		<div class="section__constrained">
			<?php get_template_part('page-templates/flexible-content'); ?>
		</div>

    </main>
  <?php
  }
}

get_footer(); ?>
