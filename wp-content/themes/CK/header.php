<?php
/**
 * The Header for theme.
 *
 * Displays all of the <head> section and page header
 *
 * @package WordPress
 * @subpackage CK
 * @since CK 1.0
*/
?>
<!DOCTYPE html>
<!--[if IE 8]><html <?php language_attributes(); ?> class="no-js ie ie8 lte8 lt9"><![endif]-->
<!--[if IE 9]><html <?php language_attributes(); ?> class="no-js ie ie9 lte9 "><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html <?php language_attributes(); ?> class="no-js">
	<!--<![endif]-->

	<head>
		<?php
			include_once( get_template_directory() . '/tags-head.php' );
		?>
		<meta name="google-site-verification" content="nk6Ka0RdOLHE_sb9yD6zWjUeh169zxiMI1Jjc4shRWA" />
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<?php wp_head(); ?>
		<?php
			include( get_template_directory() . '/lib/custom-nav-menus/custom-nav-menus.php' );
			include( get_template_directory() . '/lib/nav-menu-walker/nav-menu-walker.php' );
			date_default_timezone_set('America/Los_Angeles');
		?>
		<style>
			body .slider-button--left {
				background-image: url(<?php echo get_field('slider_right_icon', 'options')['url'] ?>);
			}

			body .slider-button--right {
				background-image: url(<?php echo get_field('slider_left_icon', 'options')['url'] ?>);
			}

		</style>
	</head>

	<?php

		$actual = date('G:i A');
		$chosenStart = get_field('call_us_show_hour', 'options');
		$chosenEnd = get_field('call_us_hide_hour', 'options');

		$currentDate = date('Y-m-d');
		$currentDate = date('Y-m-d', strtotime($currentDate));

		$open = false;

		if ( (strtotime($actual) >= strtotime($chosenStart)) && (strtotime($actual) <= strtotime($chosenEnd))) :
		$open = true;
		else:
		$open = false;
		endif;

		foreach (get_field('call_us_dates_to_hide', 'options') as $dates) {

			$startDate = $dates['start_date'];
			$startDate = date('Y-m-d', strtotime($startDate));
			$endDate = $dates['end_date'];
			$endDate = date('Y-m-d', strtotime($endDate));
			if (($currentDate > $startDate) && ($currentDate < $endDate)) {
				$open = false;
			}

		}

		if (date('N', strtotime($currentDate)) >= 6) {
			$open = false;
		}

	?>

	<body class="<?php echo custom_body_class(); ?>">
		<?php
			include_once( get_template_directory() . '/tags-body.php' );
		?>


		<?php if (get_field('alert_show', 'options') == 'yes'): ?>

		<div class="alert-message animated">

			<span class="alert-message__content"><?php the_field('alert_message', 'options') ?></span>

			<a href="<?php the_field('alert_link', 'options') ?>" class="alert-message__link">
				<?php the_field('alert_button', 'options') ?>
			</a>

			<a href="#" class="alert-message__close">
				<?php echo file_get_contents(get_template_directory_uri().'/images/svg/alert-close.svg'); ?>

			</a>

		</div>

		<?php endif ?>

		<nav class="mobile-menu-wrapper">
			<a href="#" class="mobile-menu-closer">
				<?php echo file_get_contents(get_field('mobile_menu_trigger-close_icon', 'options')['url']); ?>
			</a>
			<?php wp_nav_menu(array("theme_location" => 'mobile', 'container' => false, 'menu_class' => 'mobile-menu', 'items_wrap' => '<ul class="%2$s">%3$s</ul>')); ?>
		</nav>

		<div id="page">

			<header class="main animated">

				<a href="<?php echo home_url() ?>" class="main-logo">

					<?php echo file_get_contents(get_field('main_logo_page','options')['url']); ?>
				</a>

				<nav style="<?php echo $open ? '' : 'margin: 0'; ?>">
					<?php wp_nav_menu(array("theme_location" => 'primary', 'container' => false, 'menu_class' => 'main-menu', 'items_wrap' => '<ul class="%2$s">%3$s</ul>')); ?>
				</nav>

				<?php if ($open) : ?>
				<span class="call-us">

					<span class="call-us__content"><?php the_field('call_us_content', 'options') ?></span>

					<a href="tel:<?php the_field('call_us_phone_number', 'options') ?>" class="call-us__phone">
						<?php the_field('call_us_phone_number', 'options') ?>
						<?php echo file_get_contents(get_field('call_us_icon_mobile', 'options')['url']); ?>
						<span class="call-us__resp"><?php the_field('call_us_content_mobile', 'options') ?></span>
					</a>


				</span>
				<?php endif; ?>

				<div class="ctas <?php echo $open ? '' : 'forclosed'; ?>">

					<a href="<?php the_field('contact_link','options') ?>" class="ctas-contact">
						<?php echo file_get_contents(get_field('contact_hover_logo','options')['url']); ?>
						<?php the_field('contact_label','options') ?>
					</a>

					<a href="#" class="ctas-next-steps">
						<?php echo file_get_contents(get_field('next_steps_logo','options')['url']); ?>
						<?php echo file_get_contents(get_field('next_steps_close_logo','options')['url']); ?>
						<?php the_field('next_steps_label','options') ?>
					</a>

					<a href="<?php the_field('apply_link','options') ?>" class="ctas-apply">
						<?php echo file_get_contents(get_field('apply_hover_logo','options')['url']); ?>
						<?php the_field('apply_label','options') ?>
					</a>

				</div>

				<a href="#" class="mobile-menu-trigger">
					<?php echo file_get_contents(get_field('mobile_menu_trigger_icon', 'options')['url']); ?>
				</a>
			</header>

			<?php $nextSteps = get_field('next_steps_content','options'); ?>
			<?php if ($nextSteps): ?>

				<div class="next-steps-overlay">

					<div class="container">

						<div class="next-steps-wrapper">

							<div class="row">

								<?php foreach ($nextSteps as $step): ?>

								<a href="<?php echo $step["url"]; ?>" class="next-steps__single col-md-3 col-sm-6 col-xs-12">
									<span><?php echo $step["title"]; ?></span>
									<?php echo file_get_contents($step["image"]['url']); ?>
								</a>

								<?php endforeach ?>

							</div>

						</div>

					</div>

				</div>

			<?php endif; ?>


			<section class="main">

