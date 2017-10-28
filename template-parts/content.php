<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package SRCC
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ) { ?>
	<figure class="featured-image archive-image">
		<a href="<?php echo esc_url( get_permalink() ); ?>" target="_blank" rel="bookmark">
		<?php the_post_thumbnail( 'srcc-featured-image-archive-thumbnail' ); ?>
		</a>
	</figure>
	<?php } ?>

	<div class="post-content">
		<header class="entry-header">

			<div class="entry-text">
				<?php srcc_the_category_list(); ?>
				<?php
				if ( is_singular() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				endif;

				if ( is_singular() && has_excerpt() ) {
					the_excerpt();
				}

				if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta">
					<?php srcc_posted_on(); ?>
				</div><!-- .entry-meta -->
				<?php
				endif; ?>
			</div>
				
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_excerpt(); ?>
		</div><!-- .entry-content -->

		<div class="continue-reading">
		<?php 
			$read_more = sprintf( wp_kses( /* translators: %s: Name of current post. Only visible to screen readers */ __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'srcc' ), array( 'span' => array( 'class' => array(), ), ) ), get_the_title() );
		?>
			<a href="<?php echo esc_url( get_permalink() ); ?>" target="_blank" rel="bookmark" class="btn"><?php echo $read_more; ?></a>
		</div>
	</div><!-- .post-content -->
</article><!-- #post-<?php the_ID(); ?> -->
