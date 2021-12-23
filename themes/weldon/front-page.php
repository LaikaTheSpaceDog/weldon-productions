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

$hero = get_field('hero_image');
$logo_color = get_field('hero_logo_color');

$current_args = array(
	'numberposts' => -1,
	'post_type' => 'jobs',
	'meta_key' => 'current',
	'meta_value' => 1
);

$current = get_posts($current_args);

$previous_args = array(
	'numberposts' => -1,
	'post_type' => 'jobs',
	'meta_key' => 'current',
	'meta_value' => 0
);

$previous = get_posts($previous_args);

if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		?>
		<main>
			<div class="hero" style="background-image:url(<?= $hero['url']; ?>)">
				<img src="/wp-content/themes/weldon/assets/img/logos/logo-<?= $logo_color ?>.png" alt="Zoe Weldon Productions logo" draggable="false" />
			</div>
			<div class="section__constrained">
				<div class="main-content">
					<div class="about-me" id="about-me">
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
											<a class="link" href="<?= $am_link_1['url']; ?>"><?= $am_link_1['title']; ?></a>
										<?php endif; ?>
										<?php if($am_link_2): ?>
											<a class="link" href="<?= $am_link_2['url']; ?>"><?= $am_link_2['title']; ?></a>
										<?php endif; ?>
										<?php if($am_link_3): ?>
											<a class="link" href="<?= $am_link_3['url']; ?>"><?= $am_link_3['title']; ?></a>
										<?php endif; ?>
										<?php if($cv): ?>
											<a class="link" href="<?= $cv['url']; ?>" download>My CV</a>
										<?php endif; ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<div class="work" id="current-work">
						<h2><?= $curr_title; ?></h2>
						<div class="work__inner">
							<?php if(count($current) == 1):
								foreach($current as $job): ?>
									<div class="work__job single-job">
										<div class="single-job__image">
											<img class="b-lazy" src="<?= get_field('feature_image', $job)['url']; ?>" data-src="<?= get_field('feature_image', $job)['url']; ?>" alt="<?= get_field('feature_image', $job)['alt']; ?>" />
										</div>
										<div class="single-job__copy">
											<h3><?= get_field('title', $job); ?></h3>
											<p><?= get_field('description', $job); ?></p>
											<?php if(get_field('link_1', $job) || get_field('link_2', $job) || get_field('link_3', $job)): ?>
												<div class="single-job__links">
													<?php if(get_field('link_1', $job)): ?>
														<a class="link" href="<?= get_field('link_1', $job)['url']; ?>"><?= get_field('link_1', $job)['title']; ?></a>
													<?php endif; ?>
													<?php if(get_field('link_2', $job)): ?>
														<a class="link" href="<?= get_field('link_2', $job)['url']; ?>"><?= get_field('link_2', $job)['title']; ?></a>
													<?php endif; ?>
													<?php if(get_field('link_3', $job)): ?>
														<a class="link" href="<?= get_field('link_3', $job)['url']; ?>"><?= get_field('link_3', $job)['title']; ?></a>
													<?php endif; ?>
												</div>
											<?php endif; ?>
										</div>
									</div>
								<?php endforeach;
							else:
								foreach($current as $job): ?>
									<div class="work__job has_modal <?= count($current) == 2 ? 'pair' : ''; ?>">
										<div class="work__job-image">
											<img class="b-lazy" src="<?= get_field('feature_image', $job)['url']; ?>" data-src="<?= get_field('feature_image', $job)['url']; ?>" alt="<?= get_field('feature_image', $job)['alt']; ?>" />
										</div>
										<div class="work__job-copy">
											<h3><?= get_field('title', $job); ?></h3>
										</div>
										<div class="work__job-mask"></div>
										<div class="work__job-modal">
											<div class="single-job">
												<span class="work__job-modal-close"></span>
												<div class="single-job__image">
													<img src="<?= get_field('feature_image', $job)['url']; ?>" data-src="<?= get_field('feature_image', $job)['url']; ?>" alt="<?= get_field('feature_image', $job)['alt']; ?>" />
												</div>
												<div class="single-job__copy">
													<h3><?= get_field('title', $job); ?></h3>
													<p><?= get_field('description', $job); ?></p>
													<?php if(get_field('link_1', $job) || get_field('link_2', $job) || get_field('link_3', $job)): ?>
														<div class="single-job__links">
															<?php if(get_field('link_1', $job)): ?>
																<a class="link" href="<?= get_field('link_1', $job)['url']; ?>"><?= get_field('link_1', $job)['title']; ?></a>
															<?php endif; ?>
															<?php if(get_field('link_2', $job)): ?>
																<a class="link" href="<?= get_field('link_2', $job)['url']; ?>"><?= get_field('link_2', $job)['title']; ?></a>
															<?php endif; ?>
															<?php if(get_field('link_3', $job)): ?>
																<a class="link" href="<?= get_field('link_3', $job)['url']; ?>"><?= get_field('link_3', $job)['title']; ?></a>
															<?php endif; ?>
														</div>
													<?php endif; ?>
												</div>
											</div>
										</div>
									</div>
								<?php endforeach;
							endif; ?>
						</div>
					</div>
					<div class="work" id="previous-work">
						<h2><?= $prev_title; ?></h2>
						<div class="work__inner">
							<?php if(count($previous) == 1):
								foreach($previous as $job): ?>
									<div class="work__job single-job">
										<div class="single-job__image">
											<img class="b-lazy" src="<?= get_field('feature_image', $job)['url']; ?>" data-src="<?= get_field('feature_image', $job)['url']; ?>" alt="<?= get_field('feature_image', $job)['alt']; ?>" />
										</div>
										<div class="single-job__copy">
											<h3><?= get_field('title', $job); ?></h3>
											<p><?= get_field('description', $job); ?></p>
											<?php if(get_field('link_1', $job) || get_field('link_2', $job) || get_field('link_3', $job)): ?>
												<div class="single-job__links">
													<?php if(get_field('link_1', $job)): ?>
														<a class="link" href="<?= get_field('link_1', $job)['url']; ?>"><?= get_field('link_1', $job)['title']; ?></a>
													<?php endif; ?>
													<?php if(get_field('link_2', $job)): ?>
														<a class="link" href="<?= get_field('link_2', $job)['url']; ?>"><?= get_field('link_2', $job)['title']; ?></a>
													<?php endif; ?>
													<?php if(get_field('link_3', $job)): ?>
														<a class="link" href="<?= get_field('link_3', $job)['url']; ?>"><?= get_field('link_3', $job)['title']; ?></a>
													<?php endif; ?>
												</div>
											<?php endif; ?>
										</div>
									</div>
								<?php endforeach;
							else:
								foreach($previous as $job): ?>
									<div class="work__job has_modal <?= count($previous) == 2 ? 'pair' : ''; ?>">
										<div class="work__job-image">
											<img class="b-lazy" src="<?= get_field('feature_image', $job)['url']; ?>" data-src="<?= get_field('feature_image', $job)['url']; ?>" alt="<?= get_field('feature_image', $job)['alt']; ?>" />
										</div>
										<div class="work__job-copy">
											<h3><?= get_field('title', $job); ?></h3>
										</div>
										<div class="work__job-mask"></div>
										<div class="work__job-modal">
											<div class="work__job single-job">
												<div class="single-job__image">
													<img src="<?= get_field('feature_image', $job)['url']; ?>" data-src="<?= get_field('feature_image', $job)['url']; ?>" alt="<?= get_field('feature_image', $job)['alt']; ?>" />
												</div>
												<div class="single-job__copy">
													<h3><?= get_field('title', $job); ?></h3>
													<p><?= get_field('description', $job); ?></p>
													<?php if(get_field('link_1', $job) || get_field('link_2', $job) || get_field('link_3', $job)): ?>
														<div class="single-job__links">
															<?php if(get_field('link_1', $job)): ?>
																<a class="link" href="<?= get_field('link_1', $job)['url']; ?>"><?= get_field('link_1', $job)['title']; ?></a>
															<?php endif; ?>
															<?php if(get_field('link_2', $job)): ?>
																<a class="link" href="<?= get_field('link_2', $job)['url']; ?>"><?= get_field('link_2', $job)['title']; ?></a>
															<?php endif; ?>
															<?php if(get_field('link_3', $job)): ?>
																<a class="link" href="<?= get_field('link_3', $job)['url']; ?>"><?= get_field('link_3', $job)['title']; ?></a>
															<?php endif; ?>
														</div>
													<?php endif; ?>
												</div>
											</div>
										</div>
									</div>
								<?php endforeach;
							endif; ?>
						</div>
					</div>
					<div class="contact" id="contact-me">
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
