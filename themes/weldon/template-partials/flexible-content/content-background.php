<?php

	$image = get_sub_field('image_url');
	$size = 'featured-venue';

	if( $image ) {

		$thumb = wp_get_attachment_image_src( $image['id'], $size );

	}

?>

<section class="content-background black-block">
	<div class="background-image" style="background-image: url('<?php echo $thumb['0']; ?>')"></div>
	<div class="l-constrained--main">
		<div class="inner-wrapper">
			<div class="pure-g">
				<div class="pure-u-1 pure-u-md-1-2 black-block on-top">
					<div class="general-content-block">
						<div class="content-wrapper">
							<h2><?php the_sub_field('image_title'); ?></h2>
							<?php the_sub_field('image_content'); ?>
						</div>
					</div>
				</div>
				<div class="pure-u-1 pure-u-md-1-2">

				</div>
			</div>
		</div>
	</div>
</section>