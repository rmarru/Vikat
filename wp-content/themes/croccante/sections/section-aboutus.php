<?php $showAboutus = croccante_options('_onepage_section_aboutus', ''); ?>
<?php if ($showAboutus == 1) : ?>
	<?php
		$aboutusSectionID = croccante_options('_onepage_id_aboutus', 'aboutus');
		$aboutusTitle = croccante_options('_onepage_title_aboutus', __('About Us', 'croccante'));
		$aboutusSubTitle = croccante_options('_onepage_subtitle_aboutus', __('Who We Are', 'croccante'));
		$aboutusPositionTitle = croccante_options('_onepage_positiontitle_aboutus', 'left');
		$aboutusTitleAnimation = croccante_options('_onepage_titleanimation_aboutus', 'noanim');
		$aboutusPageBox = croccante_options('_onepage_choosepage_aboutus');
		$aboutusButtonText = croccante_options('_onepage_textbutton_aboutus', __('More Information', 'croccante'));
		$aboutusButtonLink = croccante_options('_onepage_linkbutton_aboutus', '#');
	?>
<section class="croccante_onepage_section croccante_aboutus <?php echo has_post_thumbnail($aboutusPageBox) ? 'withImage' : 'noImage' ?> <?php echo $aboutusTitle ? 'withTitle' : 'noTitle' ?>" id="<?php echo esc_attr($aboutusSectionID); ?>">
	<div class="croccante_aboutus_background">
	<div class="croccante_aboutus_color"></div>
		<div class="croccante_action_aboutus <?php echo esc_attr($aboutusPositionTitle); ?>">
			<?php if($aboutusTitle): ?>
			<div class="onepage_header aboutus <?php echo esc_attr($aboutusTitleAnimation); ?>"><div class="crocaniminside"></div>
				<div class="croccante_inside_header">
					<?php if($aboutusTitle || is_customize_preview()): ?>
						<h2 class="croccante_main_text"><?php echo esc_html($aboutusTitle); ?></h2>
					<?php endif; ?>
					<?php if($aboutusSubTitle || is_customize_preview()): ?>
						<p class="croccante_subtitle"><?php echo esc_html($aboutusSubTitle); ?></p>
					<?php endif; ?>
				</div>
			</div>
			<?php endif; ?>
			<div class="aboutus_columns">
				<div class="one aboutus_columns_three">
					<div class="aboutInner">
						<?php if($aboutusPageBox) : ?>
						<h3><?php echo get_the_title(intval($aboutusPageBox)); ?></h3>
						<?php 
							$post_content = get_post(intval($aboutusPageBox));
							$content = $post_content->post_content;
							$content = apply_filters( 'the_content', $content );
							$content = str_replace( ']]>', ']]&gt;', $content );
							echo $content;
						?>
						<?php endif; ?>
						<?php if($aboutusButtonText || is_customize_preview()): ?>
							<div class="croccanteButton aboutus"><a href="<?php echo esc_url($aboutusButtonLink); ?>"><?php echo esc_html($aboutusButtonText); ?></a></div>
						<?php endif; ?>
					</div>
				</div>
				<?php if ('' != get_the_post_thumbnail($aboutusPageBox)) : ?>
					<div class="two aboutus_columns_three">
						<div class="aboutInnerImage">
							<?php echo get_the_post_thumbnail(intval($aboutusPageBox), 'large'); ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>