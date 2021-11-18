<hr>
    <footer class="l-footer">
        <div class="section__constrained">
            <h2 class="h4">Zoe Weldon Productions</h2>
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

  wp_footer(); ?>

  </body>
</html>
