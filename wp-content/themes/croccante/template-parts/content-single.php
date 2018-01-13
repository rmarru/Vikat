<?php
/**
 * Template part for displaying sinlge post
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package croccante
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php croccante_entry_category(); ?>
		<?php the_title( '<h1 class="entry-title">', '</h1>' );

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php croccante_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->
	
	<?php
		if ( '' != get_the_post_thumbnail() ) {
			echo '<div class="single-featuredImg">';
			the_post_thumbnail('croccante-the-post');
			echo '</div>';
		}
	?>

	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'croccante' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span class="page-links-number">',
				'link_after'  => '</span>'
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php croccante_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
