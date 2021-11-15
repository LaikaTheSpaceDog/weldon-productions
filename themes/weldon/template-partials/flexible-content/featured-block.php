<section class="testimonials-block block-spacing <?php the_sub_field('background_color'); ?>-block <?php the_sub_field('spacing'); ?>">
	<div class="l-constrained--main">
		<div class="inner-wrapper">
			<div class="pure-g">
				<div class="pure-u-1-1">
					<div class="testimonial">
						<div class="block-spacing">
							<a href="<?php the_sub_field('link_url'); ?>"><i><?php the_sub_field('block_title'); ?></i></a>
						</div>
						<div class="block-spacing lined">
							<?php the_sub_field('block_content'); ?>
						</div>
						<div class="block-spacing">
							<a href="<?php the_sub_field('link_url'); ?>" class="button"><?php the_sub_field('link_text'); ?></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
