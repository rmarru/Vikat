<?php 
$showBlog = croccante_options('_onepage_section_blog', '');
?>
<?php if ($showBlog == 1) : ?>
	<?php
		$blogSectionID = croccante_options('_onepage_id_blog','blog');
		$blogTitle = croccante_options('_onepage_title_blog',__('News', 'croccante'));
		$blogSubTitle = croccante_options('_onepage_subtitle_blog', __('Latest Posts', 'croccante'));
		$blogPositionTitle = croccante_options('_onepage_positiontitle_blog', 'left');
		$blogTitleAnimation = croccante_options('_onepage_titleanimation_blog', 'noanim');
		$blogtoShow = croccante_options('_onepage_noposts_blog','3');
		$blogTextButton = croccante_options('_onepage_textbutton_blog',__('Go to the blog!', 'croccante'));
		$blogLinkButton = croccante_options('_onepage_linkbutton_blog', '#');
	?>
<section class="croccante_onepage_section croccante_blog <?php echo $blogTitle ? 'withTitle' : 'noTitle' ?>" id="<?php echo esc_attr($blogSectionID); ?>">
	<div class="croccante_blog_background">
	<div class="croccante_blog_color"></div>
		<div class="croccante_action_blog <?php echo esc_attr($blogPositionTitle); ?>">
		<?php if($blogTitle): ?>
		<div class="onepage_header blog <?php echo esc_attr($blogTitleAnimation); ?>"><div class="crocaniminside"></div>
			<div class="croccante_inside_header">
				<?php if($blogTitle || is_customize_preview()): ?>
					<h2 class="croccante_main_text"><?php echo esc_html($blogTitle); ?></h2>
				<?php endif; ?>
				<?php if($blogSubTitle || is_customize_preview()): ?>
					<p class="croccante_subtitle"><?php echo esc_html($blogSubTitle); ?></p>
				<?php endif; ?>
			</div>
		</div>
		<?php endif; ?>
			<div class="blog_columns">
					<?php
						$args = array( 'posts_per_page' => intval($blogtoShow), 'post_status'=>'publish', 'post_type'=>'post', 'orderby'=>'date', 'ignore_sticky_posts' => true );
						$the_query = new WP_Query( $args );
						if ($the_query->have_posts()) :
						while( $the_query->have_posts() ) : $the_query->the_post();
					?>
						<div class="croccanteBlogSingle">
							<?php
								if ( '' != get_the_post_thumbnail() ) {
									echo '<div class="entry-featuredImg"><a href="' .esc_url(get_permalink()). '">';
									the_post_thumbnail('croccante-hover-post');
									echo '<div class="entry-featuredImg-border"></div></a></div>';
								}
							?>
							<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
							<?php if ( 'post' === get_post_type() ) : ?>
							<div class="entry-meta">
								<?php croccante_posted_on(); ?>
							</div><!-- .entry-meta -->
							<?php
							endif; ?>
							<div class="entry-summary">
								<?php the_excerpt(); ?>
							</div><!-- .entry-content -->
						</div>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
					<?php endif; ?>
					<?php if($blogTextButton): ?>
						<div class="croccanteButton goToBlog"><a href="<?php echo esc_url($blogLinkButton); ?>"><?php echo esc_html($blogTextButton); ?></a></div>
					<?php endif; ?>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>