<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Skeleton
 * @since Skeleton 0.1
 */
?>
	</div><!-- #main -->
</div><!-- #wrapper -->

<div id="wrapper_footer">
	<div id="footer">
		<div id="colophon">

<?php
	/* A sidebar in the footer? Yep. You can can customize
	 * your footer with four columns of widgets.
	 */
	get_sidebar( 'footer' );
?>

			<div id="site-info">
				&copy; <a href="<?php echo home_url( '/' ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<?php bloginfo( 'name' ); ?>
				</a>
			
			</div><!-- #site-info -->

			<div id="site-generator">
				<?php do_action( 'Skeleton_credits' ); ?>
				<a href="<?php echo esc_url( __('http://wordpress.org/', 'Skeleton') ); ?>"
						title="<?php esc_attr_e('Semantic Personal Publishing Platform', 'Skeleton'); ?>" rel="generator">
					<?php printf( __('Proudly powered by %s.', 'Skeleton'), 'WordPress' ); ?>
				</a>
				
				<?php do_action( 'Skeleton_credits' ); ?>
				<a href="<?php echo esc_url( __('http://codedesign.elkind.net/', 'Skeleton') ); ?>"
						title="<?php esc_attr_e('codedesign.elkind.net', 'Skeleton'); ?>" rel="generator">
					<?php printf( __('Skeleton+ Theme by %s.', 'Skeleton'), 'Jeny Elkind' ); ?>
				</a>
			</div><!-- #site-generator -->

		</div><!-- #colophon -->
	</div><!-- #footer -->

</div><!-- #wrappern footer -->

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>
