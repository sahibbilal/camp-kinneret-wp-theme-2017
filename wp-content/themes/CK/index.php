<?php
/**
 * The main template file.
 *
 * @package WordPress
 * @subpackage CK
 * @since CK 1.0
 */
get_header();
?>
	<main class="content blog-content">
		<h1 class="blog-title">
			<?php _e('Camp Kinneret Blog', 'CK'); ?>
		</h1>
		<?php 
			$conditional = false;
			$ob = get_queried_object();

			if ( is_tag() ) {
					$conditional = true;
					$tag = $ob->slug;
				}

			if ( is_category() ) {
					$conditional = true;
					$category = $ob->slug;
				}

			if ( is_author() ) {
					$conditional = true;
					$author = $ob->ID;
				}

		?>

		<div class="container">

			<a href="#" class="blog-navigation__trigger col-xs-12">
				<span class="blog-navigation__trigger-closed"><?php _e('close filters','CK') ?> </span>
				<span class="blog-navigation__trigger-opened active"><?php _e('filters','CK') ?> </span>
			</a>


			<nav class="blog-navigation">
				<a href="<?php echo home_url() ?>/blog" class="blog-navigation__latest heading-style-5 <?php echo $conditional ? '' : 'active' ; ?>">Latest</a>
				<div class="blog-navigation__categories">
					<?php 

				$args = array(
					'hierarchical'        => false,
					'order'               => 'ASC',
					'orderby'             => 'name',
					'separator'           => '<br />',
					'taxonomy'            => 'category',
					'title_li'            => '<span class="cats-title filters-title heading-style-5">'.__( 'Category' ).'</span>',
				);
				
				wp_list_categories($args);
				
				?>
				</div>

				<div class="blog-navigation__authors">

					<span class="filters-title authors-title heading-style-5">
						<?php _e('Author','CK'); ?>
					</span>

					<ul>
						<?php wp_list_authors( array('style' => 'list') ); ?>
					</ul>

				</div>

				<div class="blog-navigation__tags">
					<span class="filters-title tags-title heading-style-5">
				<?php _e('Article Tag','CK'); ?>
				</span>
					<ul class="tags_list">
						<?php
					$tags = get_tags();
					foreach ($tags as $simple_tag) { ?>
							<li class="tag-item"><a href="<?php echo get_tag_link($simple_tag->term_id); ?>"><?php echo $simple_tag->name ?> </a></li>
							<?php }
					?>
					</ul>
				</div>

				<div class="search-form blog-navigation__search">
					<?php get_search_form(); ?>
				</div>

			</nav>
			<?php 
		if (have_posts()) : ?>

			<?php get_template_part('loop', 'index'); ?>

			<?php else: ?>

			<h2>
				<?php _e('Sorry, nothing found.','CK'); ?>
			</h2>

			<?php endif;  ?>


		</div>
	</main>

	<?php
			$args = array(
	            'mid_size'           => 3
	        )
			?>
		<?php the_posts_pagination($args); ?>
		<?php
		if ($wp_query->max_num_pages > 0 ) { ?>
		<a href="<?php echo get_query_var('paged') >= $wp_query->max_num_pages ? '#' : 'page/'.$wp_query->max_num_pages; ?>/" class="page-numbers max-num-pages"><?php echo $wp_query->max_num_pages; ?></a> 
		<?php } ?>
		
		<?php get_footer(); ?>
