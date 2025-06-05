<?php
/**
 * Content links block for page
 *
 */
the_sub_field('content');

$images = get_sub_field('with_image');
if ($images == 'yes') :

	if (have_rows('content_links')) :
		?>
		<div class='content_links content_links--images  fadeInBlock'>
			<div class="row">
				<?php while(have_rows('content_links')) : the_row(); ?>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<a href='<?php echo get_sub_field('content_links_url') ?>' class='content_links-single image-reveal' style='background-image: url(<?php echo get_sub_field('content_links_image')['url'] ?>)'>
							<span class='cbutton'>
								<?php echo get_sub_field('content_links_text'); ?>
							</span>
						</a>
					</div>
				<?php endwhile; ?>
			</div>
		</div>
		<?php
	endif;

else :

	if (have_rows('content_links')) :
		?>
		<div class='content_links  fadeInBlock'>
			<?php while(have_rows('content_links')) : the_row(); ?>
				<div class="content_links__wrapper">
					<a href='<?php the_sub_field('content_links_url') ?>' class='content_links-single'>
						<?php the_sub_field('content_links_text'); ?>
					</a>
				</div>
			<?php endwhile; ?>
		</div>
		<?php
	endif;

endif;