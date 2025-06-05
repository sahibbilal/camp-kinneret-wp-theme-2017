<?php
/**
 * Page blocks display
 *
 */

if( have_rows('custom_template_elements') ):

	while ( have_rows('custom_template_elements') ) : the_row();

		$single_row_layout = get_row_layout();

		switch( $single_row_layout ) {

			case 'wysiwyg_content_area':
				// WYSIWYG Content Area
				get_template_part( 'page-blocks/block-wysiwyg-content' );
				break;

			case 'content_links':
				// Content links
				get_template_part( 'page-blocks/block-content-links' );
				break;

			case 'two_columns_content_for_quote':
				// Two columns content for quote
				get_template_part( 'page-blocks/block-two-columns-content' );
				break;

			case 'full_slider':
				// Full slider
				get_template_part( 'page-blocks/block-full-slider' );
				break;

			case 'images_grid':
				// Images Grid
				get_template_part( 'page-blocks/block-images-grid' );
				break;

		}

	endwhile;

else :

	echo 'There is no any content. try to add some in WP Panel.';

endif;