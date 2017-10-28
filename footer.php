<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package SRCC
 */

?>

<?php

	$mods = array(
		'social_media'	=> array(
			'facebook'		=> get_theme_mod( 'url_facebook' ),
			'twitter'			=> get_theme_mod( 'url_twitter' ),
			'instagram'		=> get_theme_mod( 'url_instagram' ),
			'youtube'			=> get_theme_mod( 'url_youtube' ),
			'linkedin'		=> get_theme_mod( 'url_linkedin' ),
		),
	);

	// Filter out unset settings - returns new $mods array
	foreach ( $mods as $mod => $array ) {
		$mods[ $mod ] = array_filter( $array, function( $value ) {
			return $value != '';
		} );
	}

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">

		<div class="footer-top">
			<div class="container">
				<?php get_sidebar( 'footer' ); ?>
			</div>
		</div>

		<div class="footer-bottom">
			<div class="container">
				<div class="flex-container">
					<div class="site-info">
						<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'srcc' ) ); ?>"><?php
							/* translators: %s: CMS name, i.e. WordPress. */
							printf( esc_html__( 'Proudly powered by %s', 'srcc' ), 'WordPress' );
						?></a>
						<span class="sep"> | </span>
						<?php
							/* translators: 1: Theme name, 2: Theme author. */
							printf( esc_html__( 'Theme: %1$s by %2$s.', 'srcc' ), 'srcc', '<a href="http://timothyfisherdev.com">Timothy Fisher</a>' );
						?>
					</div><!-- .site-info -->
					<div class="social-icons">
						<?php foreach ( $mods[ 'social_media' ] as $platform => $url ) { ?>
						<a href="<?php echo $url; ?>" target="_blank"><i class="fa fa-<?php echo $platform; ?>"></i></a>
						<?php } ?>
					</div>
				</div><!-- .flex-container -->
			</div><!-- .container -->
		</div><!-- .footer-bottom -->

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
