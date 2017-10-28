<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package SRCC
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="container">
				<div class="row">

					<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
					<div class="col-md-9">
					<?php } ?>

					<div class="row">

						<?php
						if ( have_posts() ) :

							if ( is_home() && ! is_front_page() ) : ?>
								<header>
									<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
								</header>

							<?php
							endif;

							/* Start the Loop */
							while ( have_posts() ) : the_post();

								/*
								 * Include the Post-Format-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
							?>

							<div class="col-md-6">
								<?php get_template_part( 'template-parts/content', get_post_format() ); ?>
							</div>

							<?php endwhile;

							the_posts_navigation();

						else :
							
							get_template_part( 'template-parts/content', 'none' );

						 endif; ?>

					</div>

					<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
					</div><!-- .col-md-8 .col-sm-7 -->
					<?php } ?>


					<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
					<div class="col-md-3">
					<?php } ?>

					<?php get_sidebar(); ?>

					<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
					</div>
					<?php } ?>

				</div><!-- .row -->
			</div><!-- .container -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
