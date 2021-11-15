<hr>
    <footer class="wrapper__padding">
        <div class="section__constrained wrapper__padding bottom">

			  <h3>Footer Menu</h3>
			  <p>(Create a Wordpress Menu and assign it to "Footer" location)</p>
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

        <div class="section__constrained wrapper__padding bottom">
			<h3>Footer Policies Menu</h3>
			<p>(Create a Wordpress Menu and assign it to "Footer Policies" location)</p>
			<?php
			$args = array(
				'theme_location' => 'footer-policies',
				'container' => false,
				'menu_class' => 'l-footer__nav nav nav--footer',
				'menu_id' => '',
				'depth' => 0
			);
			wp_nav_menu( $args );
			?>
		</div>

		<div class="section__constrained">

			<h3>Company info</h3>
			<p>Move this content where required</p>
			<div>
				<?php
				// Get Company details from Theme Settings
				$companyName = get_field('company_name', 'option');
				$companyAddress = get_field('address', 'option');
				$companyTelephone = get_field('telephone', 'option');
				$companyMobilePhone = get_field('mobile_phone', 'option');
				$companyEmail = get_field('email', 'option');
				$companyFax = get_field('fax', 'option');
				$companyExtraContent = get_field('extra_content', 'option');
				?>
				<p>Company name: <?php echo $companyName; ?></p>
				<p>Address: <?php echo $companyAddress; ?></p>
				<p>Telephone: <?php echo $companyTelephone; ?></p>
				<p>Mobile Phone: <?php echo $companyMobilePhone; ?></p>
				<p>Email: <?php echo $companyEmail; ?></p>
				<p>Fax: <?php echo $companyFax; ?></p>
				<p>Extra Content: <?php echo $companyExtraContent; ?></p>
			</div>

			<h3>Social Media links</h3>
			<p>Must be added to the custom icon font</p>
			<div class="channel__social">
				<ul class="wow slideInLeft">
					<?php get_template_part('template-partials/common/social-icons'); ?>
				</ul>
			</div>

        </div>

	</footer>

  <?php
  // Tracking scripts for footer block
  renderTrackingCodes('footer');

  wp_footer(); ?>

  </body>
</html>
