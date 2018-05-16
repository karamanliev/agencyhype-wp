<?php
/**
 * Fires after the main content, before the footer is output.
 *
 * @since ??
 */
do_action( 'et_after_main_content' );

if ( 'on' == et_get_option( 'divi_back_to_top', 'false' ) ) : ?>

	<span class="et_pb_scroll_top et-pb-icon"></span>

<?php endif;

if ( ! is_page_template( 'page-template-blank.php' ) ) : ?>

			<!-- FOOTER CTA MARKUP -->
			<div class="contact-full-width-wrap">
				<div class="container cta-contact-wrapper">
					<div class="cta-contact-container contact-us-bg">
						<h4 class="contact-title">Schedule Your Consultation Today</h4>
						<p class="paragraph-small text-center">Schedule your 30-minute consultation, so we can learn more about each other and determine if we are a good fit.
						No strings attached, just an honest chat to see if we can help.</p>
						<div class="text-center">
							<a class="btn-default contact-us-btn text-uppercase desktop-cta-btn" href="https://www.agencyhype.com/contacts">Schedule Consultation</a> <a class=
							"btn-default contact-us-btn text-uppercase mobile-cta-btn" href="https://www.agencyhype.com/contacts">Talk to an expert</a>
						</div>
					</div>
				</div>
			</div>

			<footer id="main-footer">
				<?php get_sidebar( 'footer' ); ?>


		<?php
			if ( has_nav_menu( 'footer-menu' ) ) : ?>

				<div id="et-footer-nav">
					<div class="container">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'footer-menu',
								'depth'          => '1',
								'menu_class'     => 'bottom-nav',
								'container'      => '',
								'fallback_cb'    => '',
							) );
						?>
					</div>
				</div> <!-- #et-footer-nav -->

			<?php endif; ?>

				<div id="footer-bottom">
					<div class="container clearfix">
				<?php
					if ( false !== et_get_option( 'show_footer_social_icons', true ) ) {
						get_template_part( 'includes/social_icons', 'footer' );
					}

					echo et_get_footer_credits();
				?>
					</div>	<!-- .container -->
				</div>
			</footer> <!-- #main-footer -->
		</div> <!-- #et-main-area -->

<?php endif; // ! is_page_template( 'page-template-blank.php' ) ?>

	</div> <!-- #page-container -->

	<?php wp_footer(); ?>
</body>
</html>
