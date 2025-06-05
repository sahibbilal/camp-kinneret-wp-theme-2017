<?php
/**
 * Two columns content for quote block for page
 *
 */

$bg = get_sub_field('quotation_background');
$img = get_sub_field('image_for_quotation');
?>
<div class="two-columns-content fadeInBlock">
	<div class="two-columns-content__quotation">
		<span class="two-columns-content__quote-text">"<?php the_sub_field('quotation'); ?>"</span>
		<?php echo file_get_contents($bg['url']); ?>
	</div>
	<?php
	retina_styles(
		array(
			array(
				'count' => null,
				'element' => '.two-columns-content__image-wrapper',
				'imageID' => $img['id']
			)
		),
		'two-columns',
		null
	);
	?>
	<div class="two-columns-content__image-wrapper image-reveal">
		<!-- <?php echo wp_get_attachment_image($img['id'], '', false, array('class' => 'two-columns-content__image')); ?> -->
	</div>
</div>