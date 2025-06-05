<?php
/**
 * Template Name: Home Template
 * The statict page template.
 *
 *
 * @package WordPress
 * @subpackage CK
 * @since CK 1.0
 */

get_header();
the_post(); ?>

<?php
$actual = date('G:i A');
$chosenStart = get_field('call_us_show_hour', 'options');
$chosenEnd = get_field('call_us_hide_hour', 'options');
$open = false;

if ((strtotime($actual) >= strtotime($chosenStart)) && (strtotime($actual) <= strtotime($chosenEnd))) : $open = true;
else: $open = false;
endif; ?>

<div class="home-header">

	<a href="<?php echo home_url() ?>" class="home-header__main-logo">
		<?php echo file_get_contents(get_field('main_logo_full', 'options')['url']); ?>
	</a>
<p> <?php get_field('main_logo_full', 'options'); ?> </p>
	<?php if ($open) : ?>

		<span class="call-us">

			<span class="call-us__content"><?php the_field('call_us_content', 'options') ?></span>

			<a href="tel:<?php the_field('call_us_phone_number', 'options') ?>"
				class="call-us__phone"><?php the_field('call_us_phone_number', 'options') ?></a>

			</span>
		<?php endif; ?>

		<div class="ctas">

			<a href="<?php the_field('apply_link', 'options') ?>" class="ctas-apply">
				<?php echo file_get_contents(get_field('apply_hover_logo', 'options')['url'] ); ?>
				<?php the_field('apply_label', 'options') ?>
			</a>

			<a href="#" class="ctas-next-steps">
				<?php echo file_get_contents(get_field('next_steps_logo', 'options')['url'] ); ?>
				<?php echo file_get_contents(get_field('next_steps_close_logo', 'options')['url'] ); ?>
				<?php the_field('next_steps_label', 'options') ?>
			</a>


		</div>

		<a href="#" class="mobile-menu-trigger">
			<?php echo file_get_contents(get_field('mobile_menu_trigger_icon', 'options')['url']); ?>
		</a>
	</div>

	<main class="content full-width">

		<div class="container">

			<?php if (have_rows('home_hero_images')): $counter = 0;
			$rows = get_field('home_hero_images'); ?>
			<section class="hero hero--home fadeInBlock">

				<div class="under-pattern">
					<?php echo file_get_contents(get_field('under_pattern')['url'] ); ?>
				</div>
						<div class="hero-content hero-content__left">

							<a class="hero-content__images" href="<?php echo $rows[0]['link'] ?>">
								<div class="hero-content__images-overlay">
									<div class="hero-content__images-wrapper">
										<?php retina_styles(
											array(
												array(
													'count' => null,
													'element' => '.hero-content__left .image-wrapper--1',
													'imageID' => $rows[0]['image']['id']
													)
												),
											'home-hero-big',
											null); ?>
											<div class="image-wrapper image-wrapper--1">
											</div>

											<?php retina_styles(
												array(
													array(
														'count' => null,
														'element' => '.hero-content__left .image-wrapper--2',
														'imageID' => $rows[0]['image']['id']
														)
													),
												'home-hero-big',
												null); ?>
												<div class="image-wrapper image-wrapper--2">
												</div>

												<span class="image-caption">
													<?php echo $rows[0]['caption'] ?>
												</span>

											</div>
										</div>
									</a>

								</div>

								<div class="hero-content hero-content__right">

									<a class="mid-image-wrapper hero-content__images" href="<?php echo $rows[1]['link'] ?>">
										<div class="hero-content__images-overlay">
											<div class="hero-content__images-wrapper">

										<?php retina_styles(
											array(
												array(
													'count' => null,
													'element' => '.mid-image-wrapper .image-wrapper--1',
													'imageID' => $rows[1]['image']['id']
													)
												),
											'home-hero-middle',
											null); ?>
											<div class="image-wrapper image-wrapper--1">
											</div>

										<?php retina_styles(
											array(
												array(
													'count' => null,
													'element' => '.mid-image-wrapper .image-wrapper--2',
													'imageID' => $rows[1]['image']['id']
													)
												),
											'home-hero-middle',
											null); ?>
											<div class="image-wrapper image-wrapper--2">
										</div>

										<span class="image-caption">
											<?php echo $rows[1]['caption'] ?>
										</span>

									</div>
								</div>
							</a>


							<?php for ($i = 2; $i < count($rows); $i++) : ?>

								<a class="small-image-wrapper hero-content__images"  href="<?php echo $rows[$i]['link'] ?>">
									<div class="hero-content__images-overlay">
										<div class="hero-content__images-wrapper">

											<?php retina_styles(
											array(
												array(
													'count' => null,
													'element' => '.small-image-wrapper .image-wrapper--1',
													'imageID' => $rows[$i]['image']['id']
													)
												),
											'home-hero-small',
											null); ?>
											<div class="image-wrapper image-wrapper--1"
											style="background-image: url(<?php echo $rows[$i]['image']['url'] ?>); ?>);"></div>

											<?php retina_styles(
											array(
												array(
													'count' => null,
													'element' => '.small-image-wrapper .image-wrapper--2',
													'imageID' => $rows[$i]['image']['id']
													)
												),
											'home-hero-small',
											null); ?>
											<div class="image-wrapper image-wrapper--2"
											style="background-image: url(<?php echo $rows[$i]['image']['url'] ?>);"></div>

											<span class="image-caption">
										<?php echo $rows[$i]['caption'] ?>
									</span>

								</div>
							</div>
						</a>

					<?php endfor; ?>

				</div>

				<?php if (get_field('alert_msg_show') == 'yes'): ?>

					<div class="hero-alert-msg">

						<div class="hero-alert-msg__icon">
							<?php echo file_get_contents(get_field('alert_msg_icon')['url'] ); ?>
						</div>

						<span class="hero-alert-msg__content">
							<?php the_field('alert_msg_content'); ?>
						</span>

						<a href="<?php the_field('alert_msg_link_url'); ?>"
							class="hero-alert-msg__link"><?php the_field('alert_msg_link_label'); ?></a>

						</div>

					<?php endif ?>


		</section>

	<?php endif; ?>

	<section class="two-columns">

		<div class="row">

			<div class="col-lg-5 col-md-6 col-md-offset-0 col-sm-10 col-sm-offset-1 col-xs-12 col-left fadeInBlock">

				<h2 class="two-columns-heading-h2"><?php the_field('htc_title'); ?></h2>
				<p><?php the_field('htc_content'); ?></p>
				<a href="<?php the_field('htc_button_link'); ?>" class="ctas-watch-our-video cbutton cbutton-2"><?php the_field('htc_button_label'); ?></a>
				<?php $imgBg = get_field('htc_background_image'); ?>
				<?php echo file_get_contents($imgBg['url']); ?>

			</div>

			<div class="col-lg-6 col-lg-offset-1 col-md-offset-0 col-md-6 col-sm-10 col-sm-offset-1 col-xs-12 col-right fadeInBlock">

				<?php $slides = get_field('htc_image_slider'); ?>
				<?php if ($slides): ?>
					<div class="two-columns-slider image-reveal">
						<?php foreach ($slides as $value): ?>
							<div class="two-columns-slider__slide"><?php echo wp_get_attachment_image( $value['image']['id'], 'home-slider-image', false, array("class" => "slider-img") ); ?></div>
						<?php endforeach ?>
					</div>
				<?php endif ?>

			</div>

		</div>

	</section>

	<section class="quotations">


		<div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-xs-12 col-sm-offset-1 fadeInBlock">


			<?php $imgBg1 = get_field('quotes_background_image'); ?>
			<?php echo file_get_contents($imgBg1['url']); ?>
			<?php $quotes = get_field('random_quotes'); ?>

			<?php if ($quotes): ?>
				<?php $quotesCount = count($quotes) ?>
				<?php $i = rand(0, $quotesCount-1) ?>
				<span class="heading-style-2 quotation-text">"<?php echo $quotes[$i]['quotation_text']; ?>"</span>
				<span class="heading-style-5 quotation-author"><?php echo $quotes[$i]['author']; ?><span class="slash-space"></span><?php echo $quotes[$i]['position']; ?></span>
			<?php endif ?>


		</div>

	</section>

	<section class="countdownandsocial">
		<div class="countdownandsocial-wrapper fadeInBlock">
			<div class="countdown">
				<div class="countdown-content">
					<?php $i = 1; ?>
					<?php while (have_rows('countdown_countdowns')) : the_row(); ?>
						<div class="<?php if ($i == 1) echo 'active'; ?>" id="countdown-<?php echo $i; ?>">
							<h4 class="countdown-title"><?php the_sub_field('title'); ?></h4>
							<?php $site_datetime = new DateTime("now", new DateTimeZone(wp_timezone_string())); ?>
							<div class="countdown-timer" data-time="<?php the_sub_field('start_date', false); ?>" data-site-time="<?php echo $site_datetime->format('Y-m-d H:i:s'); ?>"></div>
						</div>
						<?php $i++; endwhile; ?>
					</div>
					<div class="countdown-tabs">
						<?php $i = 1; ?>
						<?php while (have_rows('countdown_countdowns')) : the_row(); ?>
							<div class="countdown-tab <?php if ($i == 1) echo 'active'; ?>"
								data-tab="countdown-<?php echo $i; ?>">
								<h5 class="countdown-tabname"><?php the_sub_field('tab_name'); ?></h5>
								<div class="countdown-time">




									<?php
									if (get_sub_field('show_dates')) {
									if (get_sub_field('countdown_from_end_date')) {
										echo date("F j", strtotime(get_sub_field('end_date'))); ?>
										-
										<?php echo date("F j, Y", strtotime(get_sub_field('start_date'))); ?>
									<?php } else { ?>


									<?php echo date("F j", strtotime(get_sub_field('start_date'))); ?>
									-
									<?php the_sub_field('end_date'); 	}
								}


									?>


								</div>
							</div>
							<?php $i++; endwhile; ?>
						</div>
					</div>

					<?php
					$first_row = get_field('countdown_images')[0]['image'];
					$second_row = get_field('countdown_images')[1]['image'];
					$first_row_image = wp_get_attachment_image_src( $first_row, 'full' );
					$second_row_image = wp_get_attachment_image_src( $second_row, 'full' );
					?>
					<div class="countdown-image countdown-image-first image-reveal" style="background-image: url('<?php echo $first_row_image[0]; ?>');">
						<div class="countdown-image-overlay">
							<div class="countdown-image-description"><?php echo get_field('countdown_images')[0]['description'] ?></div>
							<div class="countdown-image-caption"><?php echo get_field('countdown_images')[0]['caption'] ?></div>
						</div>
					</div>

					<div class="countdown-image countdown-image-second image-reveal" style="background-image: url('<?php echo $second_row_image[0]; ?>');">
						<div class="countdown-image-overlay">
							<div class="countdown-image-description"><?php echo get_field('countdown_images')[1]['description'] ?></div>
							<div class="countdown-image-caption"><?php echo get_field('countdown_images')[1]['caption'] ?></div>
						</div>
					</div>

					<div class="countdown-social">
						<?php if ( ! empty( get_field( 'social_facebook_url' ) ) ) : ?>
							<a class="countdown-social-icon" href="<?php the_field('social_facebook_url'); ?>">
								<img alt="facebook" class="countdown-social-fb-icon" src="<?php the_images_url(); ?>/icon-fb.png" />
							</a>
						<?php endif; ?>
						<h3 class="countdown-social-title"><?php the_field('social_text_title'); ?></h3>
						<a target="_blank" href="<?php the_field('social_link_subtitle'); ?>" class="countdown-social-subtitle"><?php the_field('social_text_subtitle'); ?></a>
						
						<?php
						$social_icons = get_field( 'social_icons' );
						if ( $social_icons ) :
							?>
							<div class="countdown-social-icons">
							<?php
							foreach ( $social_icons as $icon ) :
								?>
								<a href="<?php echo $icon['social_link'] ?>" target="_blank" class="footer-elements__info_columns_social_single">
									<?php echo file_get_contents($icon['social_icon']['url']) ?>
								</a>
								<?php 
							endforeach; ?>
							</div>
						<?php endif;
						?>
						<?php if ( get_field('social_button_text') ) : ?>
						<a class="cta-like-us-on-facebook cbutton cbutton-1" href="<?php the_field('social_facebook_url'); ?>">
							<?php the_field('social_button_text'); ?>
						</a>
						<?php endif; ?>
					</div>
				</div>
			</section>

		</div>

	</main>

	<?php get_footer(); ?>
