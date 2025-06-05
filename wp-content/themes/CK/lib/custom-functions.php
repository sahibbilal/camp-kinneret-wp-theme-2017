<?php

include_once( get_template_directory() . '/lib/custom-nav-menus/custom-nav-menus.php' );
include_once( get_template_directory() . '/lib/nav-menu-walker/nav-menu-walker.php' );

function localize_scripts() {
	$params = array(
		'siteUrl' => home_url(),
		'templateUrl' => get_template_directory_uri(),
		'stylesheetUrl' => get_stylesheet_directory_uri(),
		'ajaxUrl' => site_url() . '/wp-admin/admin-ajax.php'
		);

	$params =  apply_filters('sitevars', $params);
	wp_localize_script('script', 'SiteVars', $params);
}

// Allow SVG through WordPress Media Uploader
add_filter('upload_mimes', 'cc_mime_types');
function cc_mime_types($existing_mimes=array()){
	$existing_mimes['svg'] = 'image/svg+xml';
	return $existing_mimes;
}
add_filter( 'wp_check_filetype_and_ext', function($filetype_ext_data, $file, $filename, $mimes) {
	if ( substr($filename, -4) === '.svg' ) {
		$filetype_ext_data['ext'] = 'svg';
		$filetype_ext_data['type'] = 'image/svg+xml';
	}
	return $filetype_ext_data;
}, 100, 4 );

add_filter( 'image_size_names_choose', 'ml_custom_image_choose' );
function ml_custom_image_choose( $args ) {

	global $_wp_additional_image_sizes;

	// make the names human friendly by removing dashes and capitalising
	foreach( $_wp_additional_image_sizes as $key => $value ) {
		$custom[ $key ] = ucwords( str_replace( '-', ' ', $key ) );
	}

	return array_merge( $args, $custom );
}

add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );

// Colours for Wysiwyg
function wysiwyg_options($init) {

	$custom_colours = '
	"10069F", "Color Blue",
	"050050", "Color Blue Sec",
	"FF5400", "Color Orange",
	"ff671f", "Color Orange Sec",
	"cdd3e0", "Color Grey",
	"e4e5eb", "Color Grey Sec",
	"f2f4fa", "Color Grey Thi",
	"f9fbff", "Color Grey Fou",
	';

    // build colour grid default+custom colors
	$init['textcolor_map'] = '['.$custom_colours.']';

    // change the number of rows in the grid if the number of colors changes
    // 8 swatches per row
	$init['textcolor_rows'] = 1;

	return $init;
}
add_filter('tiny_mce_before_init', 'wysiwyg_options');

/**
* Function for add respinsive and retina sources as css styled breakpoints
* @param array  $retinaArray {
*     One or more arrays of source data to include in the 'srcset'.
*
*     @type type array {
*          @type type int $count     		Counter for run function in loop;
*          @type type string $element 	 	CSS element for styling as background image;
*          @type type int $imageID    		ID of image from WP Database
*     }
* }
* @param array  $prefix    		Name of defined thumbnail size (or its prefix for custom sized, eg: 'full-responsive-' // You shold define as many
*								thumbnail sizes as your equired with width as appendix)
* @param string $breakpoints    Array of custom breakpoints (if You dont define, function taks it from appendix of $prefix value)
*
* Remember to use WP Retina X2 plugin for WP to provide @x2 images for generated WP thumbnails
*/

function retina_styles( $retinaArray = null, $prefix = 'full-width', $breakpoints = null ) {

	if (!$breakpoints) {
		$breakpoints=array();
		foreach (get_intermediate_image_sizes() as $size) {
			if (strpos($size, $prefix) !== false) {
				array_push($breakpoints, str_replace($prefix, '', $size));
			}
		};
	}

	?>
	<style>
		<?php
		if ($retinaArray) :

			$counter=0;

			foreach ($breakpoints as $key) :
				$counter++;

				if ($counter != 1):
					echo "@media (max-width: ".str_replace('-', '', $key)."px) {".PHP_EOL;
				endif;

				foreach (array_reverse($retinaArray) as $element => $value) :

					echo $value['element'].$value['count']."{".PHP_EOL;

					echo "background-image: url(".wp_get_attachment_image_url(intval($value['imageID']), $prefix.$key).")".PHP_EOL."}".PHP_EOL;

				endforeach;

				if ($counter != 1):
					echo PHP_EOL."}".PHP_EOL;
				endif;

				echo "@media".PHP_EOL;


				if ($counter != 1):
					echo "only screen and (-webkit-min-device-pixel-ratio: 2) and (max-width: ".str_replace('-', '', $key)."px),".PHP_EOL;
					echo "only screen and (   min--moz-device-pixel-ratio: 2) and (max-width: ".str_replace('-', '', $key)."px),".PHP_EOL;
					echo "only screen and (     -o-min-device-pixel-ratio: 2/1) and (max-width: ".str_replace('-', '', $key)."px),".PHP_EOL;
					echo "only screen and (        min-device-pixel-ratio: 2) and (max-width: ".str_replace('-', '', $key)."px),".PHP_EOL;
					echo "only screen and (                min-resolution: 192dpi) and (max-width: ".str_replace('-', '', $key)."px),".PHP_EOL;
					echo "only screen and (                min-resolution: 2dppx) and (max-width: ".str_replace('-', '', $key)."px)";
					echo " {".PHP_EOL;
				else :
					echo "only screen and (-webkit-min-device-pixel-ratio: 2),".PHP_EOL;
					echo "only screen and (   min--moz-device-pixel-ratio: 2),".PHP_EOL;
					echo "only screen and (     -o-min-device-pixel-ratio: 2/1),".PHP_EOL;
					echo "only screen and (        min-device-pixel-ratio: 2),".PHP_EOL;
					echo "only screen and (                min-resolution: 192dpi),".PHP_EOL;
					echo "only screen and (                min-resolution: 2dppx)";
					echo " {".PHP_EOL;
				endif;

				foreach (array_reverse($retinaArray) as $element => $value) :

					if (wr2x_get_retina_from_url( wp_get_attachment_image_url(intval($value['imageID']), $prefix.$key)) != '') :
						echo $value['element'].$value['count']."{".PHP_EOL;

						echo "background-image: url(".wr2x_get_retina_from_url( wp_get_attachment_image_url(intval($value['imageID']), $prefix.$key) )."); ".PHP_EOL."}".PHP_EOL;

					endif;

				endforeach;

				echo PHP_EOL."}".PHP_EOL;

			endforeach;

		endif; ?>
	</style>
<?php
}

/**
*  Hide the header CTA block on 'staff' sub-pages 
*/
add_action( 'wp_head', 'staff_cta_css' );
function staff_cta_css(){
	global $post;
	$post_parent_page = wp_get_post_parent_id($post);
	if ( $post_parent_page == '460' || $post->ID == '460' ) {
		echo '<style type="text/css"> header.main .ctas a { display:none !important; } </style>';
	}
}

function define_gpi_properties_placeholder() { ?>
    <script>
        if (typeof GPIProperties === 'undefined') {
            window.GPIProperties = function(args) {
                console.warn('GPIProperties is called but not defined.', args);
            };
        }
    </script>
    <?php
}
add_action('wp_footer', 'define_gpi_properties_placeholder', 20);