<?php

/**
 * Dashboard widget to display all pages revisions
 */
function pagelog_dashboard_widget() { ?>
	<div class="logo__wrapper" style="max-height: 600px;overflow-y: scroll;">
		<ul>
			<?php
			$url = site_url();

			$args = array(
				'post_type' => 'page',
				'posts_per_page' => -1
			);

			$post_query = new WP_Query($args);
			if ($post_query->have_posts()) {
				while ($post_query->have_posts()) {
					$post_query->the_post();

					$revisionPost = wp_get_post_revisions(get_the_ID());

					foreach ($revisionPost as $revision) {

						$authorID = $revision->post_author;
						$title = $revision->post_title;
						$authorName = get_the_author_meta('display_name', $authorID);
						$link = $url . '/wp-admin/revision.php?revision=' . $revision->ID;

						$newDate = date("d/m/Y h:i:s", strtotime($revision->post_modified));

						if (strtotime($revision->post_modified) > strtotime('-7 day')) {
							?>
							<li>
								<a href="<?php echo $link; ?>"><?php echo $title; ?></a> by <?php echo $authorName; ?>
								on <?php echo $newDate; ?>
							</li>
							<?php
						}
					}
				}
			}
			?>
		</ul>
	</div>
<?php }

function add_pagelog_dashboard_widget()
{
	wp_add_dashboard_widget('pagelog_dashboard_widget', __('Revisions Page log (Last 7 days)'), 'pagelog_dashboard_widget');
}

add_action('wp_dashboard_setup', 'add_pagelog_dashboard_widget');


/**
 * Dashboard widget to display all revisions of a custom post-type (News in this case)
 */
function newslog_dashboard_widget() { ?>
	<div class="logo__wrapper" style="max-height: 600px;overflow-y: scroll;">
		<ul>
			<?php
			$url = site_url();

			$args = array(
				'post_type' => 'news',
				'posts_per_page' => -1
			);

			$post_query = new WP_Query($args);
			if ($post_query->have_posts()) {
				while ($post_query->have_posts()) {
					$post_query->the_post();

					$revisionPost = wp_get_post_revisions(get_the_ID());

					foreach ($revisionPost as $revision) {

						$authorID = $revision->post_author;
						$title = $revision->post_title;
						$authorName = get_the_author_meta('display_name', $authorID);
						$link = $url . '/wp-admin/revision.php?revision=' . $revision->ID;

						$newDate = date("d/m/Y h:i:s", strtotime($revision->post_modified));

						if (strtotime($revision->post_modified) > strtotime('-7 day')) {
							?>
							<li>
								<a href="<?php echo $link; ?>"><?php echo $title; ?></a> by <?php echo $authorName; ?>
								on <?php echo $newDate; ?>
							</li>
							<?php
						}
					}
				}
			}
			?>
		</ul>
	</div>
<?php }

function add_newslog_dashboard_widget()
{
	wp_add_dashboard_widget('newslog_dashboard_widget', __('Revisions News log (Last 7 days)'), 'newslog_dashboard_widget');
}

//add_action('wp_dashboard_setup', 'add_newslog_dashboard_widget');


/**
 * Dashboard widget to display all menus shortcut
 */
function menus_dashboard_widget() { ?>

	<ul>
	<?php
	$menus = get_terms('nav_menu');
	$menuURL = site_url().'/wp-admin/nav-menus.php?action=edit&menu=';

	foreach($menus as $menu){

	?><li><a href="<?php echo $menuURL.$menu->term_id; ?>"><?php echo $menu->name; ?></a> (<?php echo $menu->count; ?> items)</li><?php
	}

	?>
	</ul>
	<?php

}

function add_menus_dashboard_widget()
{
	wp_add_dashboard_widget('menus_dashboard_widget', __('Current menus'), 'menus_dashboard_widget');
}

add_action('wp_dashboard_setup', 'add_menus_dashboard_widget');
