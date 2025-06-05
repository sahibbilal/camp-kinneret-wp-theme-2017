<?php
/**
 * The single post page template.
 *
 *
 * @package WordPress
 * @subpackage CK
 * @since CK 1.0
 */

get_header(); the_post(); ?>

	<main class="content">

			<section class="sub-content blogpost">
				<div class="container">

					<div class="row">
						<h1 class="blogpost-title col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-xs-12">
							<?php the_title(); ?>
						</h1>


						<div class="blogpost__intro col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-xs-12">

							<span class="blogpost-author">
								<?php echo __('by ', 'CK').get_the_author(); ?>
							</span>
							<a href="<?php echo get_the_category()[0]->url; ?>" class="blogpost-category"><?php echo get_the_category()[0]->name; ?></a>
							<span class="blogpost-date"><?php echo get_the_date('m.d.y'); ?></span>

						</div>

					</div>
					<div class="blogpost__entry">
						<div class="row">
							<div class="blogpost__entry--thumbnail col-lg-10 col-lg-offset-1 col-md-12 ">

								<?php 
								if (get_the_post_thumbnail()){
									echo get_the_post_thumbnail(get_the_ID(), 'blog-post-thumbnail'); 
								} else {
									echo wp_get_attachment_image(get_field('blog_post_default_image', 'options')['ID'], 'blog-post-thumbnail'); 
								}
								
								?>
								
							</div>

							<div class="blogpost__entry--content col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-xs-12 fadeInBlock">
								<?php the_content(); ?>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-xs-12 fadeInBlock">
							<?php echo get_the_tag_list('<p class="blogpost__tags"><span class="blogpost__tags-single">','</span><span class="blogpost__tags-single">','</span></p>'); ?>

							<div class="blogpost__socials fadeInBlock">
								<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink( ); ?>" class="blogpost__socials-single blogpost__socials-single--facebook ">1</a>
								<a href="https://twitter.com/home?status=<?php echo get_permalink( ); ?>" class="blogpost__socials-single blogpost__socials-single--twitter">2</a>
								<a href="https://plus.google.com/share?url=<?php echo get_permalink( ); ?>" class="blogpost__socials-single blogpost__socials-single--google">3</a>
								<a href="https://pinterest.com/pin/create/button/?url=<?php echo get_permalink( ); ?>&media=&description=<?php the_title; ?>"
								class="blogpost__socials-single blogpost__socials-single--pinterest">4</a>
								<a href="mailto:?&body=<?php echo get_permalink( ); ?>" class="blogpost__socials-single blogpost__socials-single--envelope">5</a>
							</div>
						</div>
					</div>

					<a href="<?php echo get_permalink( get_option('page_for_posts' ) ); ?>" class="cbutton cbutton-1 blogpost-back-button">Back to blog</a>

				</div>

			<?php $next_post = get_next_post_link( '<div  class="blogpost-link blogpost-link-next">%link</div>' ); ?>
		<?php $prev_post = get_previous_post_link( '<div class="blogpost-link blogpost-link-prev">%link</div>' ); ?>

		<?php

		if ($prev_post) {
			echo $prev_post;
		} else {
			$last = new WP_Query( array(
				'post_status' => 'publish',
				'posts_per_page' => 1,
				'order' => 'DESC',
			));

			$last->the_post();
			echo '<div  class="blogpost-link blogpost-link-prev"><a href="' . get_permalink() . '">Prev post</a></div>';
			wp_reset_query();
		}

		if ($next_post) {
			echo $next_post;
		} else {
			$first = new WP_Query( array(
				'post_status' => 'publish',
				'posts_per_page' => 1,
				'order' => 'ASC',
			));

			$first->the_post();
			echo '<div  class="blogpost-link blogpost-link-next"><a href="' . get_permalink() . '">Next post</a></div>';
			wp_reset_query();
		}

 ?>

			</section>
	</main>

	<?php get_footer(); ?>
