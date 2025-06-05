<?php
/**
 * Template Name: User Type Template
 * The statict page template.
 *
 *
 * @package WordPress
 * @subpackage CK
 * @since CK 1.0
 */

get_header(); the_post(); ?>

<main class="content full-width">
	<section class="hero hero--usertype fadeInBlock">

		<div class="under-pattern">
			<?php echo file_get_contents(get_template_directory_uri().'/images/svg/home-hero-pattern.svg'); ?>
		</div>
		<?php retina_styles(
			array(
				array(
					'count' => null,
					'element' => '.hero__image-wrapper',
					'imageID' => get_post_thumbnail_id(get_the_ID())
					)
				),
			'full-width',
			null); ?>

			<div class="hero__image-wrapper"></div>

			<div class="hero__title-wrapper">

				<h1 class="heading-style-1"><?php the_title(); ?></h1>

			</div>

			<a href="#" class="scroll-down">

				<?php echo file_get_contents(get_template_directory_uri().'/images/svg/scroll-down.svg'); ?>
			</a>

		</section>

		<div class="container">
			<div class="row">

				<section class="ut_two-columns">

					<div class="col-md-6 col-md-offset-0 col-sm-10 col-sm-offset-1 ut_two-columns--title fadeInBlock">
						<h2 class="heading-style-2 ut_two-columns__title"><?php the_field('ut_title'); ?></h2>
						<div class="ut_two-columns__bg">
							<?php echo file_get_contents(get_field('ut_background')['url']); ?>
						</div>
					</div>


					<div class="col-md-6 col-md-offset-0 col-sm-10 col-sm-offset-1 ut_two-columns--content fadeInBlock">
						<?php the_field('ut_content'); ?>
					</div>

				</section>



				<?php if (have_rows('ut_content_links')): ?>
					<div class="content_links fadeInBlock">

						<?php while (have_rows('ut_content_links')) {  the_row(); ?>
						<div class="content_links__wrapper">

							<a href='<?php the_sub_field('button_url') ?>' class='content_links-single'>

								<?php the_sub_field('button_text'); ?>

							</a>

						</div>
						<?php } ?>

					</div>
				<?php endif ?>

				<section class="quotations">


					<div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-xs-10 col-xs-offset-1 fadeInBlock">

						<?php $imgBg1 = get_field('quotes_background_image'); ?>
						<?php $imgBg2 = get_field('quotes_background_image_additional'); ?>
						<div class="quotation-bg1"><?php echo file_get_contents($imgBg2['url']); ?></div>
						<div class="quotation-bg2"><?php echo file_get_contents($imgBg1['url']); ?></div>

						<?php $quotes = get_field('random_quotes'); ?>

						<?php if ($quotes): ?>
							<?php $quotesCount = count($quotes) ?>
							<?php $i = rand(0, $quotesCount-1) ?>
								<span class="heading-style-2 quotation-text">"<?php echo $quotes[$i]['quotation_text']; ?>"</span>
								<span class="heading-style-5 quotation-author"><?php echo $quotes[$i]['author']; ?><span class="slash-space"></span><?php echo $quotes[$i]['position']; ?></span>
						<?php endif ?>


					</div>

				</section>
			</div>
		</div>
	</main>

	<?php get_footer(); ?>
