<?php $showTeam = croccante_options('_onepage_section_team', ''); ?>
<?php if ($showTeam == 1) : ?>
	<?php
		$teamSectionID = croccante_options('_onepage_id_team', 'team');
		$teamTitle = croccante_options('_onepage_title_team', __('Our Team', 'croccante'));
		$teamSubTitle = croccante_options('_onepage_subtitle_team', __('Nice to meet you', 'croccante'));
		$teamPositionTitle = croccante_options('_onepage_positiontitle_team', 'left');
		$teamTitleAnimation = croccante_options('_onepage_titleanimation_team', 'noanim');
		$teamTestimonialBox1 = croccante_options('_onepage_choosepage_1_team');
		$teamTestimonialBox2 = croccante_options('_onepage_choosepage_2_team');
		$teamTestimonialBox3 = croccante_options('_onepage_choosepage_3_team');
		$teamTestimonialBox4 = croccante_options('_onepage_choosepage_4_team');
		$teamTestimonialBox5 = croccante_options('_onepage_choosepage_5_team');
		$teamTestimonialBox6 = croccante_options('_onepage_choosepage_6_team');
		$customMore = croccante_options('_excerpt_more', '&hellip;');
		$textLenght = croccante_options('_onepage_lenght_team', '50');
	?>
<section class="croccante_onepage_section croccante_team <?php echo $teamTitle ? 'withTitle' : 'noTitle' ?>" id="<?php echo esc_attr($teamSectionID); ?>">
	<div class="croccante_team_background">
	<div class="croccante_team_color"></div>
		<div class="croccante_action_team <?php echo esc_attr($teamPositionTitle); ?>">
			<?php if($teamTitle): ?>
			<div class="onepage_header team <?php echo esc_attr($teamTitleAnimation); ?>"><div class="crocaniminside"></div>
				<div class="croccante_inside_header">
					<?php if($teamTitle || is_customize_preview()): ?>
						<h2 class="croccante_main_text"><?php echo esc_html($teamTitle); ?></h2>
					<?php endif; ?>
					<?php if($teamSubTitle || is_customize_preview()): ?>
						<p class="croccante_subtitle"><?php echo esc_html($teamSubTitle); ?></p>
					<?php endif; ?>
				</div>
			</div>
			<?php endif; ?>
			<div class="team_columns">
				<div class="team_columns_inside">
					<?php if($teamTestimonialBox1): ?>
						<div class="croccanteTeamSingle">
							<?php if ('' != get_the_post_thumbnail($teamTestimonialBox1)) : ?>
								<?php echo get_the_post_thumbnail(intval($teamTestimonialBox1), 'croccante-hover-post'); ?>
							<?php endif; ?>
							<div class="croccanteTeamName"><?php echo get_the_title(intval($teamTestimonialBox1)); ?></div>
							<div class="croccanteTeamDesc">
							<?php 
								$post_content1 = get_post(intval($teamTestimonialBox1));
								$content1 = $post_content1->post_content; ?>
								<p><?php echo wp_trim_words($content1 , intval($textLenght), esc_html($customMore) ); ?></p>
							</div>
						</div>
					<?php endif; ?>
					<?php if($teamTestimonialBox2): ?>
						<div class="croccanteTeamSingle">
							<?php if ('' != get_the_post_thumbnail($teamTestimonialBox2)) : ?>
								<?php echo get_the_post_thumbnail(intval($teamTestimonialBox2), 'croccante-hover-post'); ?>
							<?php endif; ?>
							<div class="croccanteTeamName"><?php echo get_the_title(intval($teamTestimonialBox2)); ?></div>
							<div class="croccanteTeamDesc">
							<?php 
								$post_content2 = get_post(intval($teamTestimonialBox2));
								$content2 = $post_content2->post_content; ?>
								<p><?php echo wp_trim_words($content2 , intval($textLenght), esc_html($customMore) ); ?></p>
							</div>
						</div>
					<?php endif; ?>
					<?php if($teamTestimonialBox3): ?>
						<div class="croccanteTeamSingle">
							<?php if ('' != get_the_post_thumbnail($teamTestimonialBox3)) : ?>
								<?php echo get_the_post_thumbnail(intval($teamTestimonialBox3), 'croccante-hover-post'); ?>
							<?php endif; ?>
							<div class="croccanteTeamName"><?php echo get_the_title(intval($teamTestimonialBox3)); ?></div>
							<div class="croccanteTeamDesc">
							<?php 
								$post_content3 = get_post(intval($teamTestimonialBox3));
								$content3 = $post_content3->post_content; ?>
								<p><?php echo wp_trim_words($content3 , intval($textLenght), esc_html($customMore) ); ?></p>
							</div>
						</div>
					<?php endif; ?>
					<?php if($teamTestimonialBox4): ?>
						<div class="croccanteTeamSingle">
							<?php if ('' != get_the_post_thumbnail($teamTestimonialBox4)) : ?>
								<?php echo get_the_post_thumbnail(intval($teamTestimonialBox4), 'croccante-hover-post'); ?>
							<?php endif; ?>
							<div class="croccanteTeamName"><?php echo get_the_title(intval($teamTestimonialBox4)); ?></div>
							<div class="croccanteTeamDesc">
							<?php 
								$post_content4 = get_post(intval($teamTestimonialBox4));
								$content4 = $post_content4->post_content; ?>
								<p><?php echo wp_trim_words($content4 , intval($textLenght), esc_html($customMore) ); ?></p>
							</div>
						</div>
					<?php endif; ?>
					<?php if($teamTestimonialBox5): ?>
						<div class="croccanteTeamSingle">
							<?php if ('' != get_the_post_thumbnail($teamTestimonialBox5)) : ?>
								<?php echo get_the_post_thumbnail(intval($teamTestimonialBox5), 'croccante-hover-post'); ?>
							<?php endif; ?>
							<div class="croccanteTeamName"><?php echo get_the_title(intval($teamTestimonialBox5)); ?></div>
							<div class="croccanteTeamDesc">
							<?php 
								$post_content5 = get_post(intval($teamTestimonialBox5));
								$content5 = $post_content5->post_content; ?>
								<p><?php echo wp_trim_words($content5 , intval($textLenght), esc_html($customMore) ); ?></p>
							</div>
						</div>
					<?php endif; ?>
					<?php if($teamTestimonialBox6): ?>
						<div class="croccanteTeamSingle">
							<?php if ('' != get_the_post_thumbnail($teamTestimonialBox6)) : ?>
								<?php echo get_the_post_thumbnail(intval($teamTestimonialBox6), 'croccante-hover-post'); ?>
							<?php endif; ?>
							<div class="croccanteTeamName"><?php echo get_the_title(intval($teamTestimonialBox6)); ?></div>
							<div class="croccanteTeamDesc">
							<?php 
								$post_content6 = get_post(intval($teamTestimonialBox6));
								$content6 = $post_content6->post_content; ?>
								<p><?php echo wp_trim_words($content6 , intval($textLenght), esc_html($customMore) ); ?></p>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>