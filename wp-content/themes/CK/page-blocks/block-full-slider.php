<?php
/**
 * Full slider block for page
 *
 */

$captionIcon = get_field('optional_caption_icon', 'options');
$rightIcon   = get_field('slider_right_icon', 'options');
$leftIcon    = get_field('slider_left_icon', 'options');

$row_cell_class = "page-slider";
if ( is_page_template( 'page-tpl-sidebar.php' ) ) {
	$row_cell_class .= ' col-xs-12 fadeInBlock';
} else {
	$row_cell_class .= ' col-lg-10 col-lg-offset-1 fadeInBlock';
}

if( have_rows('slidshow') ) :
	?>
	<div class="row">
		<div class="<?php echo esc_attr( $row_cell_class ); ?>">

			<?php while(have_rows('slidshow')) : the_row(); ?>

				<div class='page-slider_wrapper'>
					<?php
					$image = get_sub_field('image');
					$slideCaption = get_sub_field('caption');
					$icon = file_get_contents($captionIcon['url']);
					$imgSrc = wp_get_attachment_image($image['ID'], 'slider-image', false, array('class'=>'page-slider__image'));
					?>

					<?php echo $imgSrc; ?>

					<?php if( get_sub_field('caption_show') == 'yes' ) : ?>
						<span class='page-slider__caption-trigger'>
							<?php echo $icon; ?>
						</span>
						<span class="page-slider__caption-content">
							<?php echo $slideCaption; ?>
						</span>
					<?php endif; ?>
				</div>

			<?php endwhile; ?>

		</div>
	</div>
	<?php
endif;