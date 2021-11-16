<hr>
    <footer class="wrapper__padding">
        <div class="section__constrained wrapper__padding bottom">
            <?php
              $args = array(
                'theme_location' => 'footer',
                'container' => false,
                'menu_class' => 'l-footer__nav nav nav--footer',
                'menu_id' => '',
                'depth' => 0
              );
              wp_nav_menu( $args );
            ?>
        </div>
	</footer>

  <?php
  // Tracking scripts for footer block
  renderTrackingCodes('footer');

  wp_footer(); ?>

  </body>
</html>
