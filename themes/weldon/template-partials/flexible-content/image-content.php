<section class="about-us-block block-spacing <?php the_sub_field('background_color'); ?>-block <?php the_sub_field('spacing'); ?>">
	<div class="container">
		<?php
		if ( is_user_logged_in() ) {
			?>
			<a class="iframe green-dot tooltip-top" data-tooltip="Edit block" href="/wp-admin/post.php?post=<?php echo get_the_ID(); ?>&action=edit&mode=modal&type=<?php echo get_row_layout(); ?>">Edit content</a>
			<?php
		}
		?>
		<div class="inner-wrapper">
			<div class="pure-g">
				<div class="pure-u-1-1 pure-u-md-1-2">
					<div class="content-block no-left animate-right">
						<div class="image-wrapper">
							<?php

								$image = get_sub_field('image_url');
								$size = 'image-content-block';

								if( $image ) {

									echo wp_get_attachment_image( $image['id'], $size );

								}

							?>
						</div>
					</div>
				</div>
				<div class="pure-u-1-1 pure-u-md-1-2 vertical-align">
					<div class="content-block general-content-block">
						<div class="content-wrapper no-right just-sides">
							<h2 class="half-spacing"><?php the_sub_field('image_title'); ?></h2>
							<?php the_sub_field('image_content'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>