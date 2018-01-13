<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package croccante
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php croccante_entry_category(); ?>
		<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php croccante_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->
	
	<?php
		if ( '' != get_the_post_thumbnail() ) {
			echo '<div class="entry-featuredImg"><a href="' .esc_url(get_permalink()). '">';
			the_post_thumbnail('croccante-hover-post');
			echo '<div class="entry-featuredImg-border"></div></a></div>';
		}
	?>
	<?php $whatToShow = croccante_options('_showpost_type', 'excerpt'); ?>
	<?php if ($whatToShow == 'excerpt'): ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
	<?php else: ?>
		<div class="entry-content">
			<?php
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'croccante' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'croccante' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span class="page-links-number">',
				'link_after'  => '</span>'
			) );
			?>
		</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-footer">
		<?php if ($whatToShow == 'excerpt'): ?>
			<span class="read-more"><a href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read More', 'croccante') ?><i class="fa fa-caret-right spaceLeft" aria-hidden="true"></i></a></span>
		<?php endif; ?>
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'croccante' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<span class="edit-link center"><i class="fa fa-wrench spaceRight" aria-hidden="true"></i>',
				'</span>'
			);
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
