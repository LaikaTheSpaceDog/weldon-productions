<?php

get_header();

$am_title = get_field('about_me_title');
$am_copy = get_field('about_me_copy');
$am_pic = get_field('about_me_picture');
$am_link_1 = get_field('about_me_link_1');
$am_link_2 = get_field('about_me_link_2');
$am_link_3 = get_field('about_me_link_3');
$cv = get_field('cv');

$curr_title = get_field('current_work_title');

$prev_title = get_field('previous_work_title');

$contact_title = get_field('contact_title');
$contact_copy = get_field('contact_copy');
$form = get_field('form');

if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		?>
		<main>
			<div class="section__constrained">
				<div class="main-content">
					<div class="about-me">
						<h2><?= $am_title; ?></h2>
						<div class="about-me__inner">
							<div class="about-me__left">
								<img class="b-lazy" src="<?= $am_pic['url']; ?>" data-src="<?= $am_pic['url']; ?>" alt="<?= $am_pic['alt']; ?>" />
							</div>
							<div class="about-me__right">
								<?= $am_copy; ?>
								<?php if($am_link_1 || $am_link_2 || $am_link_3 || $cv): ?>
									<div class="about-me__links">
										<?php if($am_link_1): ?>
											<a class="btn" href="<?= $am_link_1['url']; ?>"><?= $am_link_1['title']; ?></a>
										<?php endif; ?>
										<?php if($am_link_2): ?>
											<a class="btn" href="<?= $am_link_2['url']; ?>"><?= $am_link_2['title']; ?></a>
										<?php endif; ?>
										<?php if($am_link_3): ?>
											<a class="btn" href="<?= $am_link_3['url']; ?>"><?= $am_link_3['title']; ?></a>
										<?php endif; ?>
										<?php if($cv): ?>
											<a class="btn" href="<?= $cv['url']; ?>">My CV</a>
										<?php endif; ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<div class="current-work">
						<h2><?= $curr_title; ?></h2>
					</div>
					<div class="previous-work">
						<h2><?= $prev_title; ?></h2>
					</div>
					<div class="contact">
						<h2><?= $contact_title; ?></h2>
						<div class="contact__inner">
							<div class="contact__left">
								<?= do_shortcode('[ninja_form id=' . $form .']'); ?>
							</div>
							<div class="contact__right">
								<?= $contact_copy; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
		<?php
	}
}

get_footer(); ?>
