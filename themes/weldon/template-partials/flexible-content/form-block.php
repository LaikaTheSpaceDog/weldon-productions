<?php
$blockTitle = get_sub_field('block_title');
$blockContent = get_sub_field('block_content');
$form = get_sub_field('ninja_form_shortcode');
?>

<section class="contact-form-block block-spacing by-four <?php the_sub_field('spacing'); ?>">
	<div class="l-constrained--main">
		<div class="inner-wrapper">
			<div class="pure-g">
				<div class="pure-u-1">
					<?php if (isset($blockTitle)) { ?>
					<div class="general-content-block">
						<h2 class="h1"><?php echo $blockTitle; ?></h2>
					</div>
					<?php } ?>
					<?php if (isset($blockContent)) { ?>
					<div class="block-spacing by-two no-bottom-spacing general-content-block">
						<?php echo $blockContent; ?>
					</div>
					<?php } ?>
					<?php if (isset($form)) { ?>
					<div class="block-spacing by-four no-bottom-spacing">
						<div class="form-wrapper <?php the_sub_field('background_color'); ?>-block">
							<?php echo do_shortcode($form); ?>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</section>
