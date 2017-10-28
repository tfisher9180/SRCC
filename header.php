<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
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
		'business_info'	=> array(
			'phone_number'	=> get_theme_mod( 'phone_number' ),
			'email_address'	=> get_theme_mod( 'email_address' ),
		),
	);

	// Filter out unset settings - returns new $mods array
	foreach ( $mods as $mod => $array ) {
		$mods[ $mod ] = array_filter( $array, function( $value ) {
			return $value != '';
		} );
	}

?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'srcc' ); ?></a>

	<header id="masthead" class="site-header">

		<!-- ============================ THE TOPBAR =============================== -->

		<?php if ( ! empty( $mods[ 'social_media' ] ) ) { ?>
		<div class="topbar">
			<div class="container">
				<div class="flex-container">
					<button class="menu-toggle" aria-controls="primary-menu">
						<span class="screen-reader-text"><?php esc_html_e( 'Toggle Navigation', 'srcc' ); ?></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<div class="topbar-left">
					<?php wp_nav_menu( array( 'theme_location' => 'quick-links', 'container' => 'false', 'depth' => '2' ) ); ?>
					</div>
					<div class="topbar-right">
						<div class="social-icons">
						<?php foreach ( $mods[ 'social_media' ] as $platform => $url ) { ?>
							<a href="<?php echo esc_url( $url ); ?>" target="_blank">
								<i class="fa fa-<?php echo $platform; ?>"></i>
							</a>
						<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<nav class="mobile-navigation navigation" role="navigation">
				<div class="container">
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => 'false' ) ); ?>

					<div class="row">
						<div class="social-icons">
						<?php foreach ( $mods[ 'social_media' ] as $platform => $url ) { ?>
							<a href="<?php echo esc_url( $url ); ?>" target="_blank">
								<i class="fa fa-<?php echo $platform; ?>"></i>
							</a>
						<?php } ?>
						</div>
					</div>
				</div>
			</nav>
		</div>
		<?php } ?>

		<!-- ============================ THE LOGO AREA ============================ -->

		<div class="site-identity">
			<div class="container">
				<div class="flex-container">
					<div class="site-branding">
						<?php
						if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
							the_custom_logo();
						} else {
							if ( is_front_page() && is_home() ) : ?>
								<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
							<?php else : ?>
								<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
							<?php
							endif;

							$description = get_bloginfo( 'description', 'display' );
							if ( $description || is_customize_preview() ) : ?>
								<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
							<?php
							endif;
						}
						?>
					</div>
					<nav class="main-navigation navigation" role="navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => 'false' ) ); ?>
					</nav>
				</div><!-- .flex-container -->
			</div><!-- .container -->
		</div><!-- .site-identity -->

	</header><!-- #masthead -->

	<div id="content" class="site-content">
