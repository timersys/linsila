<?php
/**
 * The template for displaying the footer
 * @package Linsila
 * @since 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

</div><!-- .site-content -->

<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="site-info">
		<?php
		do_action( 'linsila/credits' );
		?>
		<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'twentyfifteen' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'twentyfifteen' ), 'WordPress' ); ?></a>
	</div><!-- .site-info -->
</footer><!-- .site-footer -->

</div><!-- .site -->

<?php wp_footer(); ?>

</body>
</html>
