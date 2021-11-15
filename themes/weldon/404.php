<?php
get_header();

$nf_404_title = get_field('404_title', 'option');
$nf_404_body_copy = get_field('404_body_copy', 'option');
$nf_404_cta_title = get_field('404_cta_title', 'option');
$nf_404_cta_url = get_field('404_cta_url', 'option');

?>

<main>
	<div class="section__constrained center">
		<div class="wrapper__padding">
			<?php if ($nf_404_title) { ?>
				<h2><?php echo $nf_404_title; ?></h2>
			<?php }?>

			<?php
				if ($nf_404_body_copy) {
					echo $nf_404_body_copy;
				}
			?>
			<?php if ($nf_404_cta_title && $nf_404_cta_url) { ?>
				<a class="btn" href="<?php echo $nf_404_cta_url; ?>"><?php echo $nf_404_cta_title; ?></a>
			<?php }?>
		</div>
	</div>
</main>
<?php get_footer(); ?>
