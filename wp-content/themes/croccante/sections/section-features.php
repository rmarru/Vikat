<?php $showFeatures = croccante_options('_onepage_section_features', ''); ?>
<?php if ($showFeatures == 1) : ?>
	<?php
		$featuresSectionID = croccante_options('_onepage_id_features', 'features');
		$featuresTitle = croccante_options('_onepage_title_features', __('Elements', 'croccante'));
		$featuresSubTitle = croccante_options('_onepage_subtitle_features', __('Amazing Features', 'croccante'));
		$featuresPositionTitle = croccante_options('_onepage_positiontitle_features', 'left');
		$featuresTitleAnimation = croccante_options('_onepage_titleanimation_features', 'noanim');
		$howManyBoxes = croccante_options('_onepage_manybox_features', '3');
		$textLenght = croccante_options('_onepage_lenght_features', '20');
		$customMore = croccante_options('_excerpt_more', '&hellip;');
	?>
<section class="croccante_onepage_section croccante_features <?php echo $featuresTitle ? 'withTitle' : 'noTitle' ?>" id="<?php echo esc_attr($featuresSectionID); ?>">
	<div class="croccante_features_background">
	<div class="croccante_features_color"></div>
		<div class="croccante_action_features <?php echo esc_attr($featuresPositionTitle); ?>">
			<?php if($featuresTitle): ?>
			<div class="onepage_header features <?php echo esc_attr($featuresTitleAnimation); ?>"><div class="crocaniminside"></div>
				<div class="croccante_inside_header">
					<?php if($featuresTitle || is_customize_preview()): ?>
						<h2 class="croccante_main_text"><?php echo esc_html($featuresTitle); ?></h2>
					<?php endif; ?>
					<?php if($featuresSubTitle || is_customize_preview()): ?>
						<p class="croccante_subtitle"><?php echo esc_html($featuresSubTitle); ?></p>
					<?php endif; ?>
				</div>
			</div>
			<?php endif; ?>
			<div class="features_columns">
				<?php if ($howManyBoxes == 1): ?>
				<?php
					$fontAwesomeIcon1 = croccante_options('_onepage_fontawesome_1_features', 'fa fa-bell');
					$choosePageBox1 = croccante_options('_onepage_choosepage_1_features');
					$textButton1 = croccante_options('_onepage_boxtextbutton_1_features', __('More Information', 'croccante'));
					$linkButton1 = croccante_options('_onepage_boxlinkbutton_1_features', '#');
				?>
				<div class="one features_columns_single">
					<?php if($fontAwesomeIcon1): ?>
						<div class="featuresIcon"><i class="<?php echo esc_attr($fontAwesomeIcon1); ?>" aria-hidden="true"></i></div>
					<?php endif; ?>
					<?php if($choosePageBox1): ?>
						<h3><?php echo get_the_title(intval($choosePageBox1)); ?></h3>
						<?php
						$post_content1 = get_post(intval($choosePageBox1));
						$content1 = $post_content1->post_content;
						?>
						<p><?php echo wp_trim_words($content1 , intval($textLenght), esc_html($customMore) ); ?></p>
					<?php endif; ?>
					<?php if($textButton1 || is_customize_preview()): ?>
						<div class="croccanteButton features"><a href="<?php echo esc_url($linkButton1); ?>"><?php echo esc_html($textButton1); ?></a></div>
					<?php endif; ?>
				</div>
				<?php endif; ?>
				<?php if ($howManyBoxes == 2): ?>
				<?php
					$fontAwesomeIcon1 = croccante_options('_onepage_fontawesome_1_features', 'fa fa-bell');
					$choosePageBox1 = croccante_options('_onepage_choosepage_1_features');
					$textButton1 = croccante_options('_onepage_boxtextbutton_1_features', __('More Information', 'croccante'));
					$linkButton1 = croccante_options('_onepage_boxlinkbutton_1_features', '#');
					$fontAwesomeIcon2 = croccante_options('_onepage_fontawesome_2_features', 'fa fa-bell');
					$choosePageBox2 = croccante_options('_onepage_choosepage_2_features');
					$textButton2 = croccante_options('_onepage_boxtextbutton_2_features', __('More Information', 'croccante'));
					$linkButton2 = croccante_options('_onepage_boxlinkbutton_2_features', '#');
				?>
				<div class="two features_columns_single">
					<?php if($fontAwesomeIcon1): ?>
						<div class="featuresIcon"><i class="<?php echo esc_attr($fontAwesomeIcon1); ?>" aria-hidden="true"></i></div>
					<?php endif; ?>
					<?php if($choosePageBox1): ?>
						<h3><?php echo get_the_title(intval($choosePageBox1)); ?></h3>
						<?php
						$post_content1 = get_post(intval($choosePageBox1));
						$content1 = $post_content1->post_content;
						?>
						<p><?php echo wp_trim_words($content1 , intval($textLenght), esc_html($customMore) ); ?></p>
					<?php endif; ?>
					<?php if($textButton1 || is_customize_preview()): ?>
						<div class="croccanteButton features"><a href="<?php echo esc_url($linkButton1); ?>"><?php echo esc_html($textButton1); ?></a></div>
					<?php endif; ?>
				</div>
				<div class="two features_columns_single">
					<?php if($fontAwesomeIcon2): ?>
						<div class="featuresIcon"><i class="<?php echo esc_attr($fontAwesomeIcon2); ?>" aria-hidden="true"></i></div>
					<?php endif; ?>
					<?php if($choosePageBox2): ?>
						<h3><?php echo get_the_title(intval($choosePageBox2)); ?></h3>
						<?php
						$post_content2 = get_post(intval($choosePageBox2));
						$content2 = $post_content2->post_content;
						?>
						<p><?php echo wp_trim_words($content2 , intval($textLenght), esc_html($customMore) ); ?></p>
					<?php endif; ?>
					<?php if($textButton2 || is_customize_preview()): ?>
						<div class="croccanteButton features"><a href="<?php echo esc_url($linkButton2); ?>"><?php echo esc_html($textButton2); ?></a></div>
					<?php endif; ?>
				</div>
				<?php endif; ?>
				<?php if ($howManyBoxes == 3): ?>
				<?php
					$fontAwesomeIcon1 = croccante_options('_onepage_fontawesome_1_features', 'fa fa-bell');
					$choosePageBox1 = croccante_options('_onepage_choosepage_1_features');
					$textButton1 = croccante_options('_onepage_boxtextbutton_1_features', __('More Information', 'croccante'));
					$linkButton1 = croccante_options('_onepage_boxlinkbutton_1_features', '#');
					$fontAwesomeIcon2 = croccante_options('_onepage_fontawesome_2_features', 'fa fa-bell');
					$choosePageBox2 = croccante_options('_onepage_choosepage_2_features');
					$textButton2 = croccante_options('_onepage_boxtextbutton_2_features', __('More Information', 'croccante'));
					$linkButton2 = croccante_options('_onepage_boxlinkbutton_2_features', '#');
					$fontAwesomeIcon3 = croccante_options('_onepage_fontawesome_3_features', 'fa fa-bell');
					$choosePageBox3 = croccante_options('_onepage_choosepage_3_features');
					$textButton3 = croccante_options('_onepage_boxtextbutton_3_features', __('More Information', 'croccante'));
					$linkButton3 = croccante_options('_onepage_boxlinkbutton_3_features', '#');
				?>
				<div class="three features_columns_single">
					<?php if($fontAwesomeIcon1): ?>
						<div class="featuresIcon"><i class="<?php echo esc_attr($fontAwesomeIcon1); ?>" aria-hidden="true"></i></div>
					<?php endif; ?>
					<?php if($choosePageBox1): ?>
						<h3><?php echo get_the_title(intval($choosePageBox1)); ?></h3>
						<?php
						$post_content1 = get_post(intval($choosePageBox1));
						$content1 = $post_content1->post_content;
						?>
						<p><?php echo wp_trim_words($content1 , intval($textLenght), esc_html($customMore) ); ?></p>
					<?php endif; ?>
					<?php if($textButton1 || is_customize_preview()): ?>
						<div class="croccanteButton features"><a href="<?php echo esc_url($linkButton1); ?>"><?php echo esc_html($textButton1); ?></a></div>
					<?php endif; ?>
				</div>
				<div class="three features_columns_single">
					<?php if($fontAwesomeIcon2): ?>
						<div class="featuresIcon"><i class="<?php echo esc_attr($fontAwesomeIcon2); ?>" aria-hidden="true"></i></div>
					<?php endif; ?>
					<?php if($choosePageBox2): ?>
						<h3><?php echo get_the_title(intval($choosePageBox2)); ?></h3>
						<?php
						$post_content2 = get_post(intval($choosePageBox2));
						$content2 = $post_content2->post_content;
						?>
						<p><?php echo wp_trim_words($content2 , intval($textLenght), esc_html($customMore) ); ?></p>
					<?php endif; ?>
					<?php if($textButton2 || is_customize_preview()): ?>
						<div class="croccanteButton features"><a href="<?php echo esc_url($linkButton2); ?>"><?php echo esc_html($textButton2); ?></a></div>
					<?php endif; ?>
				</div>
				<div class="three features_columns_single">
					<?php if($fontAwesomeIcon3): ?>
						<div class="featuresIcon"><i class="<?php echo esc_attr($fontAwesomeIcon3); ?>" aria-hidden="true"></i></div>
					<?php endif; ?>
					<?php if($choosePageBox3): ?>
						<h3><?php echo get_the_title(intval($choosePageBox3)); ?></h3>
						<?php
						$post_content3 = get_post(intval($choosePageBox3));
						$content3 = $post_content3->post_content;
						?>
						<p><?php echo wp_trim_words($content3 , intval($textLenght), esc_html($customMore) ); ?></p>
					<?php endif; ?>
					<?php if($textButton3 || is_customize_preview()): ?>
						<div class="croccanteButton features"><a href="<?php echo esc_url($linkButton3); ?>"><?php echo esc_html($textButton3); ?></a></div>
					<?php endif; ?>
				</div>
				<?php endif; ?>
				<?php if ($howManyBoxes == 4): ?>
				<?php
					$fontAwesomeIcon1 = croccante_options('_onepage_fontawesome_1_features', 'fa fa-bell');
					$choosePageBox1 = croccante_options('_onepage_choosepage_1_features');
					$textButton1 = croccante_options('_onepage_boxtextbutton_1_features', __('More Information', 'croccante'));
					$linkButton1 = croccante_options('_onepage_boxlinkbutton_1_features', '#');
					$fontAwesomeIcon2 = croccante_options('_onepage_fontawesome_2_features', 'fa fa-bell');
					$choosePageBox2 = croccante_options('_onepage_choosepage_2_features');
					$textButton2 = croccante_options('_onepage_boxtextbutton_2_features', __('More Information', 'croccante'));
					$linkButton2 = croccante_options('_onepage_boxlinkbutton_2_features', '#');
					$fontAwesomeIcon3 = croccante_options('_onepage_fontawesome_3_features', 'fa fa-bell');
					$choosePageBox3 = croccante_options('_onepage_choosepage_3_features');
					$textButton3 = croccante_options('_onepage_boxtextbutton_3_features', __('More Information', 'croccante'));
					$linkButton3 = croccante_options('_onepage_boxlinkbutton_3_features', '#');
					$fontAwesomeIcon4 = croccante_options('_onepage_fontawesome_4_features', 'fa fa-bell');
					$choosePageBox4 = croccante_options('_onepage_choosepage_4_features');
					$textButton4 = croccante_options('_onepage_boxtextbutton_4_features', __('More Information', 'croccante'));
					$linkButton4 = croccante_options('_onepage_boxlinkbutton_4_features', '#');
				?>
				<div class="four features_columns_single">
					<?php if($fontAwesomeIcon1): ?>
						<div class="featuresIcon"><i class="<?php echo esc_attr($fontAwesomeIcon1); ?>" aria-hidden="true"></i></div>
					<?php endif; ?>
					<?php if($choosePageBox1): ?>
						<h3><?php echo get_the_title(intval($choosePageBox1)); ?></h3>
						<?php
						$post_content1 = get_post(intval($choosePageBox1));
						$content1 = $post_content1->post_content;
						?>
						<p><?php echo wp_trim_words($content1 , intval($textLenght), esc_html($customMore) ); ?></p>
					<?php endif; ?>
					<?php if($textButton1 || is_customize_preview()): ?>
						<div class="croccanteButton features"><a href="<?php echo esc_url($linkButton1); ?>"><?php echo esc_html($textButton1); ?></a></div>
					<?php endif; ?>
				</div>
				<div class="four features_columns_single">
					<?php if($fontAwesomeIcon2): ?>
						<div class="featuresIcon"><i class="<?php echo esc_attr($fontAwesomeIcon2); ?>" aria-hidden="true"></i></div>
					<?php endif; ?>
					<?php if($choosePageBox2): ?>
						<h3><?php echo get_the_title(intval($choosePageBox2)); ?></h3>
						<?php
						$post_content2 = get_post(intval($choosePageBox2));
						$content2 = $post_content2->post_content;
						?>
						<p><?php echo wp_trim_words($content2 , intval($textLenght), esc_html($customMore) ); ?></p>
					<?php endif; ?>
					<?php if($textButton2 || is_customize_preview()): ?>
						<div class="croccanteButton features"><a href="<?php echo esc_url($linkButton2); ?>"><?php echo esc_html($textButton2); ?></a></div>
					<?php endif; ?>
				</div>
				<div class="four features_columns_single">
					<?php if($fontAwesomeIcon3): ?>
						<div class="featuresIcon"><i class="<?php echo esc_attr($fontAwesomeIcon3); ?>" aria-hidden="true"></i></div>
					<?php endif; ?>
					<?php if($choosePageBox3): ?>
						<h3><?php echo get_the_title(intval($choosePageBox3)); ?></h3>
						<?php
						$post_content3 = get_post(intval($choosePageBox3));
						$content3 = $post_content3->post_content;
						?>
						<p><?php echo wp_trim_words($content3 , intval($textLenght), esc_html($customMore) ); ?></p>
					<?php endif; ?>
					<?php if($textButton3 || is_customize_preview()): ?>
						<div class="croccanteButton features"><a href="<?php echo esc_url($linkButton3); ?>"><?php echo esc_html($textButton3); ?></a></div>
					<?php endif; ?>
				</div>
				<div class="four features_columns_single">
					<?php if($fontAwesomeIcon4): ?>
						<div class="featuresIcon"><i class="<?php echo esc_attr($fontAwesomeIcon4); ?>" aria-hidden="true"></i></div>
					<?php endif; ?>
					<?php if($choosePageBox4): ?>
						<h3><?php echo get_the_title(intval($choosePageBox4)); ?></h3>
						<?php
						$post_content4 = get_post(intval($choosePageBox4));
						$content4 = $post_content4->post_content;
						?>
						<p><?php echo wp_trim_words($content4 , intval($textLenght), esc_html($customMore) ); ?></p>
					<?php endif; ?>
					<?php if($textButton4 || is_customize_preview()): ?>
						<div class="croccanteButton features"><a href="<?php echo esc_url($linkButton4); ?>"><?php echo esc_html($textButton4); ?></a></div>
					<?php endif; ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>