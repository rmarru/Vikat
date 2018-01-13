<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package croccante
 */

?>

	</div><!-- #content -->
	<?php $showSearchButton = croccante_options('_search_button', '1');
	if ($showSearchButton) : ?>
	<!-- Start: Search Form -->
	<div class="opacityBoxSearch"></div>
	<div class="search-container">
		<?php get_search_form(); ?>
	</div>
	<!-- End: Search Form -->
	<?php endif; ?>

	<footer id="colophon" class="site-footer">
		<?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) ) : ?>
			<div class="footerArea">
				<div class="croccanteFooterWidget">
					<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
						<aside id="footer-1" class="widget-area footer">
							<?php dynamic_sidebar( 'footer-1' ); ?>
						</aside><!-- #footer-1 -->
					<?php endif; ?>
					<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
						<aside id="footer-2" class="widget-area footer">
							<?php dynamic_sidebar( 'footer-2' ); ?>
						</aside><!-- #footer-2 -->
					<?php endif; ?>
					<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
						<aside id="footer-3" class="widget-area footer">
							<?php dynamic_sidebar( 'footer-3' ); ?>
						</aside><!-- #footer-3 -->
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>
		<div class="site-copy-down">
			<div class="site-info">
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'croccante' ) ); ?>">
				<?php
				/* translators: %s: WordPress name */
				printf( esc_html__( 'Proudly powered by %s', 'croccante' ), 'WordPress' );
				?>
				</a>
				<span class="sep"> | </span>
				<?php 
				/* translators: 1: theme name, 2: theme developer */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'croccante' ), '<a target="_blank" href="https://crestaproject.com/downloads/croccante/" rel="nofollow" title="Croccante Theme">Croccante</a>', 'CrestaProject' );
				?>
			</div><!-- .site-info -->
			<div class="site-social">
				<?php croccante_show_social_network();
				$scrollToTopMobile = croccante_options('_scroll_top', '');
				?>
				<a href="#top" id="toTop" class="<?php echo $scrollToTopMobile ? 'scrolltop_on' : 'scrolltop_off' ?>"><i class="fa fa-angle-up fa-lg"></i></a>
			</div><!-- .site-social -->
		</div><!-- .site-copy-down -->
	</footer><!-- #colophon -->
</div><!-- #page -->
<?php wp_footer(); ?>

</body>
</html>
