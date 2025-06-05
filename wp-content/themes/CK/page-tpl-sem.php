<?php
/**
 * Template Name: SEM Template
 * The statict page template.
 *
 *
 * @package WordPress
 * @subpackage CK
 * @since CK 1.0
 */
get_header();
the_post(); ?>



	<article class="content full-width">

		<div class="container container--sem-content">
			<header class="sem-header">
				<a href="<?php echo home_url() ?>" class="main-logo">
					<?php echo file_get_contents(get_field('main_logo_page','options')['url']); ?>
				</a>
			</header>
			<section class="sem-content">
				<?php locate_template('template-custom-elements.php', true, true); ?>
			</section>

			<footer class="sem-footer">

				<?php $copyrights = get_field('copyrights','options'); ?>
				<?php $website_by = get_field('website_by','options'); ?>
				<?php $website_by_logo = get_field('website_by_logo','options')['url']; ?>
				<?php $website_by_link = get_field('website_by_link','options'); ?>
				<?php $main_logo = get_field('footer_main_logo','options'); ?>
				<a href="<?php echo home_url() ?>" class="footer-elements__logo">
					<?php echo file_get_contents($main_logo['url']) ?>
				</a>
				<?php wp_nav_menu(array('menu' => 31, 'container' => false, 'menu_class' => 'sem-footer-menu', 'items_wrap' => '<ul class="%2$s">%3$s</ul>')); ?>

				<?php $social_icons = get_field('social_icons','options'); ?>
				<?php if ($social_icons): ?>

				<div class="footer-elements__info_columns_social">

					<?php foreach ($social_icons as $icon) : ?>
					<a href="<?php echo $icon['social_link'] ?>" target="_blank" class="footer-elements__info_columns_social_single">
						<?php echo file_get_contents($icon['social_icon']['url']) ?>
					</a>

					<?php endforeach;?>

				</div>

				<?php endif ?>
				<div class="footer-elements__copyrights">

					<span>&#9400; <?php echo date("Y"); ?></span>

					<p class="footer-elements__copyrights-content">

						<?php echo $copyrights ?>

					</p>

					<p class="footer-elements__copyrights-websiteby">

						<span><?php echo $website_by; ?></span>

						<a href="<?php echo $website_by_link; ?>" target="_blank" class="footer-elements__copyrights-websiteby-link">
							<?php echo file_get_contents($website_by_logo) ?>
						</a>


					</p>

				</div>


			</footer>
		</div>

		<div class="container--sem-form">
			<div class="container--sem-form__wrapper">
				<?php echo do_shortcode(get_field('sem_form_shortcode')); ?>
			</div>
		</div>

		<a href="#" class="form-trigger">
			<?php echo get_field('trigger_text') ? get_field('trigger_text') : __('Schedule a tour', 'CK'); ?>
		</a>

	</article>


	<?php get_footer(); ?>
