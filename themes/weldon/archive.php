<?php get_header(); ?>
<!-- +++archive -->
<main>
  <?php get_template_part( 'partials/partial' ); ?>
  <?php // Use include if variables need to be passed on to partial ?>
  <?php include(locate_template('partials/partial')); ?>

</main>
<?php get_footer(); ?>
