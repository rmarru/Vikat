<?php 
$showCta = croccante_options('_onepage_section_cta', '');
?>
<?php if ($showCta == 1) : ?>
	<?php
		$ctaSectionID = croccante_options('_onepage_id_cta','cta');
		$ctaIcon = croccante_options('_onepage_fontawesome_cta','fa fa-flash');
		$ctaPhrase = croccante_options('_onepage_phrase_cta','');
		$ctaDesc = croccante_options('_onepage_desc_cta','');
		$ctaTextButton = croccante_options('_onepage_textbutton_cta',__('More Information', 'croccante'));
		$ctaLinkButton = croccante_options('_onepage_urlbutton_cta','#');
		$ctaOpenLink = croccante_options('_onepage_openurl_cta','_blank');
	?>
<section class="croccante_onepage_section croccante_cta <?php echo $ctaDesc ? 'withDesc' : 'noDesc' ?>" id="<?php echo esc_attr($ctaSectionID); ?>">
	<div class="croccante_cta_background">
		<div class="croccante_cta_color"></div>
		<div class="croccante_action_cta">
			<div class="cta_columns">
				<div class="ctaText">
					<div class="ctaIcon"><i class="<?php echo esc_attr($ctaIcon); ?>" aria-hidden="true"></i></div>
					<div class="ctaPhrase">
						<?php if ($ctaPhrase || is_customize_preview()) : ?>
							<h3><?php echo esc_html($ctaPhrase); ?></h3>
						<?php endif; ?>
						<?php if ($ctaDesc || is_customize_preview()) : ?>
							<p><?php echo esc_html($ctaDesc); ?></p>
						<?php endif; ?>
					</div>
				</div>
				<div class="ctaButton croccanteButton"><a href="<?php echo esc_url($ctaLinkButton); ?>" target="<?php echo esc_attr($ctaOpenLink); ?>"><?php echo esc_html($ctaTextButton); ?></a></div>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>