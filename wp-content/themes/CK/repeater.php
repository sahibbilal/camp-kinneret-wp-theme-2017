
			<?php
				$custom_field_groups = get_post_meta( get_the_ID(), 'custom_field_groups', true );
			?>
			<?php foreach( (array) $custom_field_groups as $count => $row ) { ?>
				<?php switch( $row ) {
					case 'simple_content': ?>
						<?php
							$content = get_post_meta( get_the_ID(), 'custom_field_groups_' . $count . '_content', true );
						?>
						<?php if( $content ) { ?>
							<div class="default-content simple-content entry-content">
								<?php echo apply_filters( 'the_content', $content ); ?>
							</div>
						<?php } ?>
					<?php break;
					case 'full_width_hero_image': ?>
						<?php
							$static_image = get_post_meta( get_the_ID(), 'custom_field_groups_' . $count . '_static_image', true );
							$image_src = wp_get_attachment_image_src($static_image, 'large');

							$full_width = get_post_meta( get_the_ID(), 'custom_field_groups_' . $count . '_full_width', true );
							$titledescription = esc_html( get_post_meta( get_the_ID(), 'custom_field_groups_' . $count . '_titledescription', true ) );
							$subtitle = esc_html( get_post_meta( get_the_ID(), 'custom_field_groups_' . $count . '_subtitle', true ) );
							$button_label = esc_html( get_post_meta( get_the_ID(), 'custom_field_groups_' . $count . '_button_label', true ) );
							$button_link = get_post_meta( get_the_ID(), 'custom_field_groups_' . $count . '_button_link', true );
							$full_image_link = get_post_meta( get_the_ID(), 'custom_field_groups_' . $count . '_full_image_link', true );
							$scroll_top = get_post_meta( get_the_ID(), 'custom_field_groups_' . $count . '_full_image_link', true );
						?>
						<div class="masthead full-width-hero container">
							<?php if ( $image_src ) { ?>
								<div class="masthead_image" style="background-image: url('<?php echo $image_src[0]; ?>');"></div>
							<?php } ?>
							<?php if( $titledescription || $subtitle || ( $button_label && $button_link ) ) { ?>
								<div class="masthead_content">
									<?php if( $titledescription ) { ?>
										<h1><?php echo $titledescription; ?></h1>
									<?php } ?>
									<?php if( $subtitle ) { ?>
										<p><?php echo $subtitle; ?></p>
									<?php } ?>
									<?php if( $button_label && $button_link ) { ?>
										<a href="<?php echo $button_link; ?>" class="btn"><?php echo $button_label; ?></a>
									<?php } ?>
								</div>
								<?php if( $scroll_top ) { ?>
									<a href="#page" class="scroll-top">Scroll-top</a>
								<?php } ?>
							<?php } ?>
						</div>
					<?php break;
					case 'box_of_content_with_image_background': ?>
						<?php
							$image_background = get_post_meta( get_the_ID(), 'custom_field_groups_' . $count . '_image_background', true );
							$image_src = wp_get_attachment_image_src($image_background, 'large');
							$space = get_post_meta( get_the_ID(), 'custom_field_groups_' . $count . '_space', true );
							$content_vertical_alignment = get_post_meta( get_the_ID(), 'custom_field_groups_' . $count . '_content_vertical_alignment', true );
							$layout = get_post_meta( get_the_ID(), 'custom_field_groups_' . $count . '_layout', true );
							$overlay_color = get_post_meta( get_the_ID(), 'custom_field_groups_' . $count . '_overlay_color', true );
							$opacity = get_post_meta( get_the_ID(), 'custom_field_groups_' . $count . '_opacity', true );
							$content = get_post_meta( get_the_ID(), 'custom_field_groups_' . $count . '_content', true );
						?>
						<style>
							<?php echo '.group-' . $count; ?> {
								<?php if ($opacity) { ?>
									opacity: <?php echo $opacity; ?>;
								<?php } ?>
								<?php if ($overlay_color) { ?>
									background-color: <?php echo $overlay_color; ?>;
								<?php } ?>

								<?php if ( $space === 'small' ) { ?>
									<?php $padding = '30px'; ?>
								<?php } elseif ($space === 'medium') { ?>
									<?php $padding = '60px'; ?>
								<?php } elseif ($space === 'large') { ?>
									<?php $padding = '90px'; ?>
								<?php } ?>
								<?php if ( $content_vertical_alignment === 'top' ) { ?>
									padding-bottom: <?php echo $padding; ?>;
								<?php } elseif ($content_vertical_alignment === 'middle') { ?>
									padding-top: <?php echo $padding; ?>;
									padding-bottom: <?php echo $padding; ?>;
								<?php } elseif ($content_vertical_alignment === 'bottom') { ?>
									padding-top: <?php echo $padding; ?>;

								<?php } ?>
							}
						</style>
						<div class="masthead <?php if ( $layout === 'full-width' ) { ?>masthead_full-width<?php } ?> container <?php echo 'group-' . $count; ?>">
							<?php if ( $image_src ) { ?>
								<div class="masthead_image" style="background-image: url('<?php echo $image_src[0]; ?>');"></div>
							<?php } ?>
							<?php if( $content ) { ?>
								<div class="masthead_content">
									<?php echo apply_filters( 'the_content', $content ); ?>
								</div>
							<?php } ?>
						</div>
					<?php break;
					case 'row_of_columns': ?>
						<?php
							$layout_columns = get_post_meta( get_the_ID(), 'custom_field_groups_' . $count . '_layout_columns', true );
							$borders = get_post_meta( get_the_ID(), 'custom_field_groups_' . $count . '_borders', true );
							$spacing = get_post_meta( get_the_ID(), 'custom_field_groups_' . $count . '_spacing', true );
							$padding_bottom = get_post_meta( get_the_ID(), 'custom_field_groups_' . $count . '_padding_bottom', true );
							$margin_bottom = get_post_meta( get_the_ID(), 'custom_field_groups_' . $count . '_margin_bottom', true );
							$content = get_post_meta( get_the_ID(), 'custom_field_groups_' . $count . '_content', true );
							$class = 'col-12';
							if ($layout_columns == 2) {
								$class = 'col-8';
							} elseif ($layout_columns == 3) {
								$class = 'col-4';
							}
							if ($borders) {
								$class .= ' border';
							}
						?>
						<div class=" <?php echo $class; ?>">
							<?php if( $content ) { ?>
								<p><?php echo apply_filters( 'the_content', $content ); ?></p>
							<?php } ?>
						</div>
					<?php break;
					case 'grid_of_posts_or_pages': ?>
						<?php
							$layout_columns = get_post_meta( get_the_ID(), 'custom_field_groups_' . $count . '_layout_columns', true );
							$postspages_selection = get_post_meta( get_the_ID(), 'custom_field_groups_' . $count . '_postspages_selection', true );
							$use_featured_image = get_post_meta( get_the_ID(), 'custom_field_groups_' . $count . '_use_featured_image', true );
							$featured_image_position = get_post_meta( get_the_ID(), 'custom_field_groups_' . $count . '_featured_image_position', true );
							$class = 'col-12';
							if ($layout_columns == 2) {
								$class = 'col-sm-6';
							} elseif ($layout_columns == 3) {
								$class = 'col-sm-4';
							}
							//$sticky = get_option( 'sticky_posts' );

							$tst = get_post_meta( get_the_ID(), 'custom_field_groups_' . $count . '_tst', true );

						//	$intArray = array_map(
						//		function($value) { return (int)$value; },
						//		$postspages_selection
						//	);

							$args = array(
								'p'         => array($tst),
								'post_type' => 'any'
							);

						//	var_dump($intArray);
								echo '<hr>';
							$query = new WP_Query( $args );
						//	var_dump($postspages_selection);
							echo '<hr>';
							var_dump($tst);
							echo '<hr>';
						?>
						<?php if ( $query->have_posts() ) { ?>
							<?php while ( $query->have_posts() ) { $query->the_post(); ?>
								<?php //the_title(); ?>
								<?php echo get_the_ID(); ?>
								<br>
							<?php } ?>
							<?php wp_reset_postdata(); ?>
						<?php } ?>
						<div class="row align-items-center flex-column row-posts-pages">
							<div class="col-md-11 col-lg-10 col-xl-8">
								<div class="row">
									<article class="col-sm-6 single-col">
										<div class="col-content">
											<header class="caption">
												<h2><a href="http://localhost/O4QPPH8L/public_html/resources/" class="">Leading Edge Fund</a></h2>
												<hr>
											</header>
											<p>Lorem ipsum dolor sit amet, consectetur adip iscing elit prae sent ut orci nec erat pulvinar mas uada quis ornare. Lorem ipsum dolor sit amet.</p>
											<a href="" class="link">learn more &gt;</a>
										</div>
									</article>
									<article class="col-sm-6 single-col">
										<div class="col-content">
											<header class="caption">
												<h2><a href="http://localhost/O4QPPH8L/public_html/resources/" class="">Leading Edge Fund</a></h2>
												<hr>
											</header>
											<p>Lorem ipsum dolor sit amet, consectetur adip iscing elit prae sent ut orci nec erat pulvinar mas uada quis ornare. Lorem ipsum dolor sit amet.</p>
											<a href="" class="link">learn more &gt;</a>
										</div>
									</article>
									<article class="col-sm-4 single-col">
										<div class="col-content">
											<header class="caption">
												<h2><a href="http://localhost/O4QPPH8L/public_html/resources/" class="">Leading Edge Fund</a></h2>
												<hr>
											</header>
											<p>Lorem ipsum dolor sit amet, consectetur adip iscing elit prae sent ut orci nec erat pulvinar mas uada quis ornare. Lorem ipsum dolor sit amet.</p>
											<a href="" class="link">learn more &gt;</a>
										</div>
									</article>
									<article class="col-sm-4 single-col">
										<div class="col-content">
											<header class="caption">
												<h2><a href="http://localhost/O4QPPH8L/public_html/resources/" class="">Leading Edge Fund</a></h2>
												<hr>
											</header>
											<p>Lorem ipsum dolor sit amet, consectetur adip iscing elit prae sent ut orci nec erat pulvinar mas uada quis ornare. Lorem ipsum dolor sit amet.</p>
											<a href="" class="link">learn more &gt;</a>
										</div>
									</article>
									<article class="col-sm-4 single-col">
										<div class="col-content">
											<header class="caption">
												<h2><a href="http://localhost/O4QPPH8L/public_html/resources/" class="">Leading Edge Fund</a></h2>
												<hr>
											</header>
											<p>Lorem ipsum dolor sit amet, consectetur adip iscing elit prae sent ut orci nec erat pulvinar mas uada quis ornare. Lorem ipsum dolor sit amet.</p>
											<a href="" class="link">learn more &gt;</a>
										</div>
									</article>
									<article class="col-12 single-col">
										<div class="col-content">
											<header class="caption">
												<h2><a href="http://localhost/O4QPPH8L/public_html/resources/" class="">Leading Edge Fund</a></h2>
												<hr>
											</header>
											<p>Lorem ipsum dolor sit amet, consectetur adip iscing elit prae sent ut orci nec erat pulvinar mas uada quis ornare. Lorem ipsum dolor sit amet.</p>
											<a href="" class="link">learn more &gt;</a>
										</div>
									</article>
								</div> <!-- row -->
							</div> <!-- col-md-11 col-lg-10 col-xl-8 -->
						</div> <!-- row align-items-center flex-column cols-row -->
					<?php break; ?>
					<?php //default: echo "No match!"; break; ?>
				<?php } ?>
			<?php } ?>
