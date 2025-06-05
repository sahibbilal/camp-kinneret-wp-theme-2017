<?php
/**
 * Template Name: Custom Sidebar Template
 * The statict page template.
 *
 *
 * @package WordPress
 * @subpackage CK
 * @since CK 1.0
 */

get_header();
the_post();

?>

<main class="content full-width has-sidebar">

	<?php $alignment = get_field('featured_image_align'); ?>

	<?php if (has_post_thumbnail()): ?>
		<?php $imageID = get_post_thumbnail_id( get_the_ID() );?>
		<?php $bg_image = get_the_post_thumbnail_url(get_the_ID()); ?>
		<?php $size = 'full-width'; ?>
		<?php $breakpoints = array( 1680, 1140, 960, 720, 540, 320 ); ?>

		<?php $counter = 0; ?>
		<?php $retinaArray = array(
			array(
				'count' => $counter,
				'element' => '.page-hero',
				'imageID' => $imageID )
			);
			?>
		<?php retina_styles($retinaArray, $size, $breakpoints = null); ?>

		<div class="page-hero" style="background-position: center <?php echo $alignment ?>; background-image: url(<?php echo $bg_image; ?>);">
		</div>
	<?php endif; ?>

	<?php if (get_field('menu_under_hero_display') == 'yes'): ?>
		<?php $sec_menu = get_field('menu_choose'); ?>

		<nav class="second-navigation">

			<span class="second-navigation__trigger"><?php echo $sec_menu->name; ?></span>

			<?php
			if($sec_menu) :

				$html = '<ul id = "%1$s" class = "%2$s">%3$s</ul>';
				$args = array(
					'menu' => $sec_menu->ID,
					'container' => true,
					'menu_class' => 'second-navigation__list',
					'items_wrap' => $html,
					'depth' => 0,
				);

				wp_nav_menu( $args );
			endif;
			?>

		</nav>

	<?php endif; ?>

	<section class="page-content">
		<article class="page-content__wrapper">
			<div class="container">
				<div class="row">

					<h1 class="page-content__title col-xs-12 text-center">
						<?php $title = the_title('', '', 0); ?>
						<?php echo str_replace('Protected:', '', $title); ?>
					</h1>

				</div>

				<div class="row sidebar-menu__wrapper">
					<div class="col-lg-3 col-md-4 col-xs-12">
						<div class="sidebar-menu">

							<?php $sidebar_menu = get_field('sidebar_menu_select'); ?>
							<?php if( $sidebar_menu ) : ?>
								<nav>
									<span class="sidebar-menu__title open-trigger"><?php echo $sidebar_menu->name; ?></span>
									<?php
									$html = '<ul id = "%1$s" class = "%2$s">%3$s</ul>';
									$args = array(
										'menu' => $sidebar_menu->ID,
										'container' => true,
										'menu_class' => 'sidebar-menu__list',
										'items_wrap' => $html,
										'depth' => 0,
									);
									wp_nav_menu( $args );
									?>
								</nav>
							<?php endif; ?>

						</div>
					</div>
					<div class="col-md-8 col-lg-offset-1 col-xs-12">
						<div class="container">
							<?php if( !post_password_required( $post )): // Hide ACFs for use with WP password protect feature ?>

								<?php locate_template('template-custom-elements.php', true, true); ?>

							<?php endif; ?>
						</div>
					</div>
				</div>

				<div class="row">

					<div class="sub-content col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-xs-12 fadeInBlock">

						<?php the_content(); // Required for the password protect feature ?>

					</div>

				</div>

			</div>

		</article>
	</section>

	<?php $choose = get_field('choose_custom_menu_items'); ?>
	<?php $menus = !empty($choose) ? get_field('mega_menus', $choose->ID) : false; ?>
	<?php if(get_field('hide_bp_menu')) $menus = false; ?>

	<?php if ($menus): ?>

		<section class="bottom-page-menu fadeInBlock">
			<div class="container">

				<span class="bottom-page-menu__title"><?php the_field('bottom_menu_title') ?></span>

				<div class="bottom-page-menu__single-wrapper">

					<?php foreach ($menus as $menu) : ?>

						<?php
						$nav_megamenu = $menu['single_menu_column'];

						if($nav_megamenu) : ?>

							<?php
							$html = '<ul id = "%1$s" class = "%2$s">%3$s</ul>';
							$args = array(
								'menu' => $nav_megamenu,
								'container' => true,
								'menu_class' => 'bottom-page-menu__single megamenu-list col-xs-4',
								'items_wrap' => $html,
								'depth' => 0,
							);

							wp_nav_menu( $args );
						endif; ?>

					<?php endforeach; ?>
				</div>

			</div>
		</section>

	<?php endif ?>
</main>

<?php
get_footer();