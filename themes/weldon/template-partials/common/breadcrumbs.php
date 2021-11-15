<?php
	/* Yoast Breadcrumbs */
	/* Needs to be enabled to be displayed under SEO / Search Appearance / Bradcrumbs tab */
?>

<?php if (function_exists('yoast_breadcrumb')) { ?>

	<div class="breadcrumbs__wrapper">
		<?php
		if (function_exists('yoast_breadcrumb')) {
			yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
		}
		?>
	</div>

<?php } ?>