<?php 
$showSlider = croccante_options('_onepage_section_slider', '');
?>
<?php if ($showSlider == 1) : ?>
<?php
	$showScrollDown = croccante_options('_onepage_scrolldown_slider', '1');
	$sliderSectionID = croccante_options('_onepage_id_slider', 'slider');
	$firstSlideImage = croccante_options('_onepage_image_1_slider', '');
	$firstSlideText = croccante_options('_onepage_text_1_slider', '');
	$firstSlideSubtext = croccante_options('_onepage_subtext_1_slider', '');
	$secondSlideImage = croccante_options('_onepage_image_2_slider', '');
	$secondSlideText = croccante_options('_onepage_text_2_slider', '');
	$secondSlideSubtext = croccante_options('_onepage_subtext_2_slider', '');
	$thirdSlideImage = croccante_options('_onepage_image_3_slider', '');
	$thirdSlideText = croccante_options('_onepage_text_3_slider', '');
	$thirdSlideSubtext = croccante_options('_onepage_subtext_3_slider', '');
?>
<section class="croccante_onepage_section croccante_slider" id="<?php echo esc_attr($sliderSectionID); ?>">
	<div class="flexslider">
	  <ul class="slides">
		<?php if ($firstSlideImage) : ?>
		<li>
			<div class="flexImage" style="background-image: url(<?php echo esc_url($firstSlideImage); ?>);">
			</div>
			<div class="flexText">
				<div class="inside">
					<?php if ($firstSlideText || is_customize_preview()) : ?>
					<h2><?php echo esc_html($firstSlideText); ?></h2>
					<?php endif; ?>
					<?php if ($firstSlideSubtext || is_customize_preview()) : ?>
					<span><?php echo esc_html($firstSlideSubtext); ?></span>
					<?php endif; ?>
				</div>
			</div>
		</li>
		<?php endif; ?>
		<?php if ($secondSlideImage) : ?>
		<li>
			<div class="flexImage" style="background-image: url(<?php echo esc_url($secondSlideImage); ?>);">
			</div>
			<div class="flexText">
				<div class="inside">
					<?php if ($secondSlideText || is_customize_preview()) : ?>
					<h2><?php echo esc_html($secondSlideText); ?></h2>
					<?php endif; ?>
					<?php if ($secondSlideSubtext || is_customize_preview()) : ?>
					<span><?php echo esc_html($secondSlideSubtext); ?></span>
					<?php endif; ?>
				</div>
			</div>
		</li>
		<?php endif; ?>
		<?php if ($thirdSlideImage) : ?>
		<li>
			<div class="flexImage" style="background-image: url(<?php echo esc_url($thirdSlideImage); ?>);">
			</div>
			<div class="flexText">
				<div class="inside">
					<?php if ($thirdSlideText || is_customize_preview()) : ?>
					<h2><?php echo esc_html($thirdSlideText); ?></h2>
					<?php endif; ?>
					<?php if ($thirdSlideSubtext || is_customize_preview()) : ?>
					<span><?php echo esc_html($thirdSlideSubtext); ?></span>
					<?php endif; ?>
				</div>
			</div>
		</li>
		<?php endif; ?>
	  </ul>
	  <?php if ($showScrollDown) : ?>
		<div class="scrollDownCroccante"><div class="inside"></div></div>
	<?php endif; ?>
	</div>
</section>
<?php endif; ?>