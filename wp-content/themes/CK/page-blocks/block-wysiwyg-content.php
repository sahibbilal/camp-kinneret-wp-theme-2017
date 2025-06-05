<?php
/**
 * WYSIWYG Content Area block for page
 *
 */

$row_cell_class = "sub-content";
if ( is_page_template( 'page-tpl-sidebar.php' ) ) {
	$row_cell_class .= ' col-xs-12 fadeInBlock';
} else {
	$row_cell_class .= ' col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-xs-12 fadeInBlock';
}
?>
<div class="row">
	<div class="<?php echo esc_attr( $row_cell_class ); ?>">
		<?php echo preg_replace('/<!--(.*?)-->/', '', get_sub_field('content')); ?>
	</div>
</div>