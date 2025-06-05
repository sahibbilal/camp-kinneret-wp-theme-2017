<?php
/**
 * Images Grid block for page
 *
 */

$image_cards = get_sub_field('image_cards');
if( $image_cards ) :

	$image_cards_cols   = count($image_cards);
	$image_cards_col_bs = 6;
	if( $image_cards_cols > 2 ) {
		$image_cards_col_bs = 12 / $image_cards_cols;
	}

	$image_cards_col_class = 'col-lg-';
	$image_cards_col_class .= $image_cards_col_bs;
	$image_cards_col_class .= ' col-sm-6 col-xs-12';
	?>

	<div class="row justify-content-center imagegrid-image-wrap">

		<?php
		foreach( $image_cards as $card ) :

			$image = $card['image'];
			if( $image ) {
				$description = $card['description'] ?? '';
				$caption     = $card['caption'] ?? '';
				$link        = $card['link'] ?? '';

				$single_image = wp_get_attachment_image_src( $image, 'home-slider-image' );
				?>
				<div class="<?php echo $image_cards_col_class; ?>">
					<div class="imagegrid-image imagegrid-image-card image-reveal" style="background-image: url('<?php echo $single_image[0]; ?>');">
						<div class="imagegrid-image-overlay">

							<?php if( $description ) { ?>
								<div class="imagegrid-image-description"><?php echo $description; ?></div>
							<?php } ?>

							<?php if( $caption ) { ?>
								<div class="imagegrid-image-caption"><?php echo $caption; ?></div>
							<?php } ?>

							<?php if( !empty($link) ) { ?>
								<?php
								$link_url    = $link['url'];
								$link_title  = $link['title'];
								$link_target = $link['target'] ? $link['target'] : '_self';
								?>
								<a class="cbutton cbutton-1" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
									<?php echo esc_html( $link_title ); ?>
								</a>
							<?php } ?>

						</div>
					</div>
				</div>
				<?php
			}

		endforeach;
		?>

	</div>
	<?php
endif;