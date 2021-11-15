<?php
$open_links_in_a_new_tab = get_field('open_links_in_a_new_tab', 'option');

// check if the repeater field has rows of data
if (have_rows('social_media_links', 'option')):

	// loop through the rows of data
	while (have_rows('social_media_links', 'option')) : the_row();

		if (get_sub_field('social_media_type')) { ?>
			<div class="social-icon">
				<a href="<?php echo get_sub_field('social_media_url'); ?>" <?php if ($open_links_in_a_new_tab) { ?> target="_blank" rel="noreferrer"<?php }?>>
					<i class="icon-<?php echo get_sub_field('social_media_type'); ?>"></i><?php echo get_sub_field('social_media_type'); ?>
				</a>
			</div>
			<?php
		}

	endwhile;

endif;

?>
