<?php
/**
 * Menu Item Template: Menu Template
 */
?>
<a href="<?php echo get_the_permalink(get_field('menu_item_link')); ?>"><?php the_title(); ?></a>

<div class="megamenu-overlay"></div>

<div class="navi-megamenu">

	<div class="container">

		<div class="row">

			<?php $menus = get_field('mega_menus'); ?>

			<?php if ($menus): ?>

				<nav class="navi-megamenu-wrapper col-xs-9">
					<div class="row">
						<?php foreach ($menus as $menu) : ?>

							<?php
							$nav_megamenu = $menu['single_menu_column'];

							if($nav_megamenu) : ?>

							<?php $html = '<ul id = "%1$s" class = "%2$s">%3$s</ul>';
							$args = array(
								'menu' => $nav_megamenu,
								'container' => true,
								'menu_class' => 'second_navigation megamenu-list col-xs-4',
								'items_wrap' => $html,
								'depth' => 0,
								);

							wp_nav_menu( $args );
							endif; ?>

						<?php endforeach; ?>

					</div>

				</nav>

			<?php endif ?>

			<div class="megamenu-cta col-xs-3">

				<?php $image = get_field('mega_menu_cta_image') ?>

				<a href="<?php the_field('mega_menu_cta_link') ?>" class="megamenu-cta-link">

					<?php echo wp_get_attachment_image($image['ID'], 'mega-menu-th'); ?>

					<span class="megamenu-cta-caption">
						<?php the_field('mega_menu_cta_caption') ?>
					</span>


				</a>
			</div>

		</div>

	</div>

</div>
