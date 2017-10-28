<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package SRCC
 */

?>

<?php
	
	$post_thumbnail_css = '';

	if ( has_post_thumbnail() ) {
		$post_thumbnail = get_the_post_thumbnail_url( null, 'srcc-featured-image-fullscreen' );
		$post_thumbnail_css = ' style="background-image: url('.$post_thumbnail.')"';
	}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header"<?php echo $post_thumbnail_css; ?>>
		<div class="container">
			<div class="entry-header-content">
				<?php srcc_the_category_list(); ?>
				<?php
				if ( is_singular() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				endif;

				the_excerpt();

				if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta">
					<?php srcc_posted_on(); ?>
				</div><!-- .entry-meta -->
				<?php
				endif; ?>
			</div>
		</div>
	</header><!-- .entry-header -->

	<div class="content-wrapper">

		<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
			<div class="container">
			<div class="row">
			<div class="col-md-8">
		<?php } ?>

		<div class="entry-content">
			<?php
				the_content( sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'srcc' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				) );

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'srcc' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php srcc_entry_footer(); ?>
		</footer><!-- .entry-footer -->

		<!-- If comments are open or we have at least one comment, load up the comment template. -->
		<?php if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
		?>

		<?php srcc_post_navigation(); ?>

		<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
			</div>
			<div class="col-md-3 col-md-offset-1">
		<?php } ?>

		<?php get_sidebar(); ?>

		<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
			</div>
			</div>
			</div>
		<?php } ?>

	</div><!-- .content-wrapper -->
	
</article><!-- #post-<?php the_ID(); ?> -->
