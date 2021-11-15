<div class="main-content">

	<?php

	// check if the flexible content field has rows of data
	if( have_rows('custom_content_blocks') ):

		while ( have_rows('custom_content_blocks') ) : the_row();

			if( get_row_layout() == 'first_block' ):

				get_template_part('partials/flexible-content/first', 'block');

			elseif( get_row_layout() == 'second_block' ):

				get_template_part('partials/flexible-content/second', 'block');

			endif;

		endwhile;

	else :

		// no layouts found

	endif;

	?>

</div>