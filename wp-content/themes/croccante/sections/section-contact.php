<?php $showContact = croccante_options('_onepage_section_contact', ''); ?>
<?php if ($showContact == 1) : ?>
	<?php
		$contactSectionID = croccante_options('_onepage_id_contact', 'contact');
		$contactTitle = croccante_options('_onepage_title_contact', __('Contact Us', 'croccante'));
		$contactSubTitle = croccante_options('_onepage_subtitle_contact', __('Get in touch', 'croccante'));
		$contactPositionTitle = croccante_options('_onepage_positiontitle_contact', 'left');
		$contactTitleAnimation = croccante_options('_onepage_titleanimation_contact', 'noanim');
		$contactAddText = croccante_options('_onepage_additionaltext_contact', '');
		$contactCompanyName = croccante_options('_onepage_companyname_contact', '');
		$contactCompanyAddress1 = croccante_options('_onepage_companyaddress1_contact', '');
		$contactCompanyAddress2 = croccante_options('_onepage_companyaddress2_contact', '');
		$contactCompanyAddress3 = croccante_options('_onepage_companyaddress3_contact', '');
		$contactCompanyPhone = croccante_options('_onepage_companyphone_contact', '');
		$contactCompanyFax = croccante_options('_onepage_companyfax_contact', '');
		$contactCompanyEmail = croccante_options('_onepage_companyemail_contact', '');
		$contactShortcode = croccante_options('_onepage_shortcode_contact', '');
		$contactIcon = croccante_options('_onepage_icon_contact', 'fa fa-envelope');
	?>
<section class="croccante_onepage_section croccante_contact <?php echo $contactShortcode ? 'withForm' : 'noForm' ?> <?php echo $contactTitle ? 'withTitle' : 'noTitle' ?>" id="<?php echo esc_attr($contactSectionID); ?>">
	<div class="croccante_contact_background">
	<div class="croccante_contact_color"></div>
		<div class="croccante_action_contact <?php echo esc_attr($contactPositionTitle); ?>">
			<?php if($contactTitle): ?>
			<div class="onepage_header contact <?php echo esc_attr($contactTitleAnimation); ?>"><div class="crocaniminside"></div>
				<div class="croccante_inside_header">
					<?php if($contactTitle || is_customize_preview()): ?>
						<h2 class="croccante_main_text"><?php echo esc_html($contactTitle); ?></h2>
					<?php endif; ?>
					<?php if($contactSubTitle || is_customize_preview()): ?>
						<p class="croccante_subtitle"><?php echo esc_html($contactSubTitle); ?></p>
					<?php endif; ?>
				</div>
			</div>
			<?php endif; ?>
			<div class="contact_columns">
				<div class="contact_columns_inside">
					<div class="croccanteContactField">
						<?php if($contactAddText || is_customize_preview()): ?>
							<div class="croccanteAdditionalText"><p><?php echo wp_kses($contactAddText, croccante_allowed_html()); ?></p></div>
						<?php endif; ?>
						<?php if($contactCompanyName || is_customize_preview()): ?>
							<div class="croccanteCompanyName"><h3><?php echo esc_html($contactCompanyName); ?></h3></div>
						<?php endif; ?>
						<?php if($contactCompanyAddress1 || is_customize_preview()): ?>
							<div class="croccanteCompanyAddress1"><div class="croccanteCompanyAddress1Icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div><p><?php echo esc_html($contactCompanyAddress1); ?></p></div>
						<?php endif; ?>
						<?php if($contactCompanyAddress2 || is_customize_preview()): ?>
							<div class="croccanteCompanyAddress2"><p><?php echo esc_html($contactCompanyAddress2); ?></p></div>
						<?php endif; ?>
						<?php if($contactCompanyAddress3 || is_customize_preview()): ?>
							<div class="croccanteCompanyAddress3"><p><?php echo esc_html($contactCompanyAddress3); ?></p></div>
						<?php endif; ?>
						<?php if($contactCompanyPhone || is_customize_preview()): ?>
							<div class="croccanteCompanyPhone"><div class="croccanteCompanyPhoneIcon"><i class="fa fa-phone" aria-hidden="true"></i></div><p><?php echo esc_html($contactCompanyPhone); ?></p></div>
						<?php endif; ?>
						<?php if($contactCompanyFax || is_customize_preview()): ?>
							<div class="croccanteCompanyFax"><div class="croccanteCompanyFaxIcon"><i class="fa fa-fax" aria-hidden="true"></i></div><p><?php echo esc_html($contactCompanyFax); ?></p></div>
						<?php endif; ?>
						<?php if(is_email($contactCompanyEmail) || is_customize_preview()): ?>
							<div class="croccanteCompanyEmail"><div class="croccanteCompanyEmailIcon"><i class="fa fa-envelope" aria-hidden="true"></i></div><p><?php echo esc_html(antispambot($contactCompanyEmail)); ?></p></div>
						<?php endif; ?>
					</div>
					<?php if($contactShortcode): ?>
					<div class="croccanteContactForm">
						<?php echo do_shortcode(wp_kses_post($contactShortcode)); ?>
					</div>
					<?php endif; ?>
					<?php if($contactIcon): ?>
						<div class="croccanteContactIcon"><i class="<?php echo esc_attr($contactIcon); ?>" aria-hidden="true"></i></div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>