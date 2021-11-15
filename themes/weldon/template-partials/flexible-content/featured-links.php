<section class="featured-block <?php the_sub_field('background_color'); ?>-block">
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

				<?php

				if( have_rows('link_repeater') ):

					while ( have_rows('link_repeater') ) : the_row();

							$image = get_sub_field('image');
							$size = 'featured-block';

							if( $image ) {

								$thumb = wp_get_attachment_image_src( $image['id'], $size );

							}

						?>
							<div class="pure-u-1-1 pure-u-sm-1-2 pure-u-md-1-3 pure-u-lg-1-4">
								<div class="featured-wrapper animate-right link" style="background-image: url('<?php echo $thumb[0]; ?>');">
									<h3><a class="link-reset" href="<?php the_sub_field('link_url'); ?>"><?php the_sub_field('title'); ?></a></h3>
								</div>
							</div>
						<?php

					endwhile;

				endif;

				?>

			</div>
		</div>
	</div>
</section>