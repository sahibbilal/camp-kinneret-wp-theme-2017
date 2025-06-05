<?php
/**
 * The footer for theme.
 *
 *
 * @package WordPress
 * @subpackage CK
 * @since CK 1.0
 */
  ?>
</section> <!-- /.main -->

	<footer class="main">

		<div class="container">

			<?php $main_logo = get_field('footer_main_logo','options'); ?>
			<?php $paragraph = get_field('footer_paragraph','options'); ?>
			<?php $info_columns = get_field('footer_info_columns','options'); ?>
			<?php $social_icons = get_field('social_icons','options'); ?>
			<?php $camp_logos = get_field('camp_logos','options'); ?>
			<?php $copyrights = get_field('copyrights','options'); ?>
			<?php $website_by = get_field('website_by','options'); ?>
			<?php $website_by_logo = get_field('website_by_logo','options')['url']; ?>
			<?php $website_by_link = get_field('website_by_link','options'); ?>

			<div class="footer-elements">

				<a href="<?php echo home_url() ?>" class="footer-elements__logo">
					<?php echo file_get_contents($main_logo['url']) ?>
				</a>

				<div class="row">

				<div class="footer-elements__left col-md-6 col-md-offset-0 col-sm-8 col-sm-offset-2">

					<p class="footer-elements__title">
						<?php echo $paragraph; ?>
					</p>

					<?php if ( $camp_logos ): ?>

						<div class="footer-elements__camp-logos">

							<?php 
							foreach ($camp_logos as $logo) :
							
								$logo_link = $logo['link'];
								$logo_img_url = file_get_contents($logo['logo']['url']);
								
								if ($logo_img_url && $logo_link) :
								?>

								<a href="<?php echo $logo['link'] ?>" target="_blank" class="footer-elements__camp-logos_single">
									<?php echo file_get_contents($logo['logo']['url']) ?>
								</a>
								
								<?php 
								endif;

							endforeach;
							?>

						</div>

					<?php endif ?>

				</div><!-- /.footer-elements__left -->


				<div class="footer-elements__right col-md-6 col-md-offset-0 col-sm-8 col-sm-offset-2">

					<?php if ($info_columns): ?>

						<div class="footer-elements__info_columns">

							<?php foreach ($info_columns as $column) : ?>

								<div class="footer-elements__info_columns-single">

									<?php if ($column['column_title']) : ?>

										<h4 class="footer-elements__info_columns-title"><?php echo $column['column_title'] ?></h4>

									<?php endif ?>

									<?php if ($column['rows']): ?>

										<?php foreach ($column['rows'] as $row) : ?>
											<?php switch ($row['content_row_type']) {

												case 'address': ?>

												<address class="footer-elements__info_columns-row">

													<?php echo $row['address_row']; ?>

												</address>

												<?php break;

												case 'phone': ?>
												<a href="tel:<?php echo $row['phone_number']; ?>" class="footer-elements__info_columns-tel"><?php echo $row['phone_number']; ?></a>
												<?php break;

												case 'link': ?>

												<a href="<?php echo $row['link_url'] ?>" class="footer-elements__info_columns-link">

													<?php echo $row['link_label']; ?>

												</a>

												<?php break;

												default:

												break;
											} ?>


										<?php endforeach;?>

									<?php endif ?>

								</div>

							<?php endforeach;?>

							<div class="footer-elements__info_columns-single">


								<?php if ($social_icons): ?>

									<div class="footer-elements__info_columns_social">

										<?php foreach ($social_icons as $icon) : ?>
											<a href="<?php echo $icon['social_link'] ?>" target="_blank" class="footer-elements__info_columns_social_single">
												<?php echo file_get_contents($icon['social_icon']['url']) ?>
											</a>

										<?php endforeach;?>

									</div>

								<?php endif ?>

							</div>

						</div>

					<?php endif ?>

				</div><!-- /.footer-elements__right -->

				<div class="footer-elements__left col-md-6 col-md-offset-0 col-sm-8 col-sm-offset-2">

					<?php if ($camp_logos): ?>

						<div class="footer-elements__camp-logos footer-elements__camp-logos--mobile">

							<?php 
							foreach ($camp_logos as $logo) :
							
								$logo_link = $logo['link'];
								$logo_img_url = file_get_contents($logo['logo']['url']);
								
								if ($logo_img_url && $logo_link) :
								?>

								<a href="<?php echo $logo['link'] ?>" target="_blank" class="footer-elements__camp-logos_single">
									<?php echo file_get_contents($logo['logo']['url']) ?>
								</a>
								
								<?php 
								endif;

							endforeach;
							?>

						</div>

					<?php endif ?>

				</div><!-- /.footer-elements__left -->

				</div>

				<div class="footer-elements__copyrights">

				<span>&#9400; <?php echo date("Y"); ?></span>

					<p class="footer-elements__copyrights-content">

						<?php echo $copyrights ?>

					</p>

					<p class="footer-elements__copyrights-websiteby">

						<span><?php echo $website_by; ?></span>

						<a href="<?php echo $website_by_link; ?>" target="_blank" class="footer-elements__copyrights-websiteby-link"> <?php echo file_get_contents($website_by_logo) ?></a>


					</p>

				</div>


			</div><!-- /.footer-elements -->


		</div><!-- /.container -->

	</footer>

</div> <!-- /#page -->

<?php wp_footer(); ?>                        
</body>
</html>
