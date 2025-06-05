<?php
/**
 * Loop for home page.
 *
 * @package WordPress
 * @subpackage CK
 * @since CK 1.0
 */
?>
	<section class="posts">
		<?php while (have_posts()) : the_post(); ?>
		<article class="article-post">
					<a href="<?php the_permalink(); ?>">
		<div class="row">
			<div class="article-post__left-side col-lg-6 col-md-6 col-xs-12">

				<span class="category-link">
					<?php echo get_the_category()[0]->name; ?>
				</span>

				<h2 class="article-post-title heading-style-2">
						<?php the_title(); ?>
				</h2>

				<p class="article-post-outro">
					<span><?php echo __('by ','CK').get_the_author(); ?></span>
					<span><?php echo get_the_date('m.d.y'); ?></span>
				</p>

			</div>
			<div class="article-post__right-side col-lg-7 col-md-7 col-xs-12">
				<?php 
				if (get_the_post_thumbnail()){
					echo get_the_post_thumbnail(get_the_ID(), 'blog-page-thumbnail'); 
				} else {
					echo wp_get_attachment_image(get_field('blog_post_default_image', 'options')['ID'], 'blog-page-thumbnail'); 
				}
				?>
				<?php ?>
			</div>
			</div>
			
					</a>
		</article>
		<?php endwhile; ?>
	</section>
