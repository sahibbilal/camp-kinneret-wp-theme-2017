<?php
/**
 * The 404 page template.
 *
 *
 * @package WordPress
 * @subpackage CK
 * @since CK 1.0
 */

get_header(); ?>

<main class="content full-width">
    <div class="container">
        <section class="not-found">
            <img class="not-found-icon" src="<?php the_images_url(); ?>/icon-404.png" srcset="<?php the_images_url(); ?>/icon-404.png 546w, <?php the_images_url(); ?>/retina/icon-404.png 1091w" />
            <h1 class="not-found-title"><?php the_field('404_title', 'option'); ?></h1>
            <h2 class="not-found-subtitle"><?php the_field('404_subtitle', 'option'); ?></h2>
            <a class="not-found-button" href="<?php the_field('404_button_url', 'option'); ?>"><?php the_field('404_button_text', 'option'); ?></a>
        </section>
    </div>
</main>

<?php get_footer(); ?>
