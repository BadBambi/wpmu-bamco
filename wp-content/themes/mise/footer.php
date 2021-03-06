<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package mise
 */

?>

	</div><!-- #content -->
	</div><!-- .mise-inner -->
	<?php $showSearchButton = mise_options('_search_button', '1');
	$copyrightText = mise_options('_copyright_text', '&copy; '.date('Y').' '. get_bloginfo('name'));
	if ($showSearchButton) : ?>
		<!-- Start: Search Form -->
		<div class="opacityBoxSearch"></div>
		<div class="search-container">
			<?php get_search_form(); ?>
		</div>
		<!-- End: Search Form -->
	<?php endif; ?>
	<?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) : ?>
		<footer id="colophon" class="site-footer">
			<div class="mainFooter">
				<div class="miseFooterWidget">
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
				<div class="miseFooterInfo">
					<div class="site-info">
						<?php if ($copyrightText || is_customize_preview()): ?>
							<span class="custom"><?php echo wp_kses($copyrightText, mise_allowed_html()); ?></span>
						<?php endif; ?>
						<span class="sep"> | </span>
						<?php
						/* translators: 1: theme name, 2: theme developer */
						printf( esc_html__( 'WordPress Theme: %1$s by %2$s.', 'mise' ), '<a target="_blank" href="https://crestaproject.com/downloads/mise/" rel="noopener noreferrer" title="Mise Theme">Mise</a>', 'CrestaProject' );
						?>
					</div><!-- .site-info -->
					<?php 
					$showInFooter =  mise_options('_social_footer', '1');
					if ($showInFooter == 1) {
						mise_show_social_network('footer');
					} ?>
				</div>
				<nav id="footer-navigation" class="second-navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_id' => 'footer-menu', 'depth' => 1, 'fallback_cb' => false ) ); ?>
				</nav>
			</div>
		</footer><!-- #colophon -->
	<?php endif; ?>
</div><!-- #page -->
<?php $scrollToTopMobile = mise_options('_scroll_top', ''); ?>
<a href="#top" id="toTop" aria-hidden="true" class="<?php echo $scrollToTopMobile ? 'scrolltop_on' : 'scrolltop_off' ?>"><i class="fa fa-angle-up fa-lg"></i></a>
<?php wp_footer(); ?>

</body>
</html>
