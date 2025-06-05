<?php
/**
 * Template Name: Cookies Policy
 *
 *
 * @package WordPress
 * @subpackage CK
 * @since CK 1.0
 */

get_header(); the_post(); ?>

<main class="content full-width">
	
	<section class="page-content">
		<article class="page-content__wrapper">
			<div class="container">
				<div class="row">
					<div class="col-12">

						<!-- Termly Tracking Code -->
						<div name="termly-embed" data-id="443e4536-35b2-4b13-b1e5-4c8869b66d6a" data-type="iframe"></div>
						<script type="text/javascript">(function(d, s, id) {

						  var js, tjs = d.getElementsByTagName(s)[0];

						  if (d.getElementById(id)) return;

						  js = d.createElement(s); js.id = id;

						  js.src = "https://app.termly.io/embed-policy.min.js";

						  tjs.parentNode.insertBefore(js, tjs);

						}(document, 'script', 'termly-jssdk'));</script>
	
					</div>
				</div>
			</div>
		</article>
	</section>

</main>

<?php get_footer(); ?>