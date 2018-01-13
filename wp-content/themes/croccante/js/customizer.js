/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	/* Text */
	wp.customize( 'croccante_theme_options[_onepage_text_1_slider]', function( value ) {
		value.bind( function( to ) {
			$( '.flexslider .slides > li:first-child .flexText .inside h2' ).text( to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_text_2_slider]', function( value ) {
		value.bind( function( to ) {
			$( '.flexslider .slides > li:nth-child(2) .flexText .inside h2' ).text( to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_text_3_slider]', function( value ) {
		value.bind( function( to ) {
			$( '.flexslider .slides > li:nth-child(3) .flexText .inside h2' ).text( to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_subtext_1_slider]', function( value ) {
		value.bind( function( to ) {
			$( '.flexslider .slides > li:first-child .flexText .inside span' ).text( to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_subtext_2_slider]', function( value ) {
		value.bind( function( to ) {
			$( '.flexslider .slides > li:nth-child(2) .flexText .inside span' ).text( to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_subtext_3_slider]', function( value ) {
		value.bind( function( to ) {
			$( '.flexslider .slides > li:nth-child(3) .flexText .inside span' ).text( to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_title_aboutus]', function( value ) {
		value.bind( function( to ) {
			$( '.croccante_action_aboutus .croccante_main_text' ).text( to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_subtitle_aboutus]', function( value ) {
		value.bind( function( to ) {
			$( '.croccante_action_aboutus .croccante_subtitle' ).text( to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_textbutton_aboutus]', function( value ) {
		value.bind( function( to ) {
			$( '.aboutus_columns_three.one .croccanteButton a' ).text( to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_title_features]', function( value ) {
		value.bind( function( to ) {
			$( '.croccante_action_features .croccante_main_text' ).text( to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_subtitle_features]', function( value ) {
		value.bind( function( to ) {
			$( '.croccante_action_features .croccante_subtitle' ).text( to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_boxtextbutton_1_features]', function( value ) {
		value.bind( function( to ) {
			$( '.features_columns_single:first-child .croccanteButton a' ).text( to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_boxtextbutton_2_features]', function( value ) {
		value.bind( function( to ) {
			$( '.features_columns_single:nth-child(2) .croccanteButton a' ).text( to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_boxtextbutton_3_features]', function( value ) {
		value.bind( function( to ) {
			$( '.features_columns_single:nth-child(3) .croccanteButton a' ).text( to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_boxtextbutton_4_features]', function( value ) {
		value.bind( function( to ) {
			$( '.features_columns_single:nth-child(4) .croccanteButton a' ).text( to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_title_skills]', function( value ) {
		value.bind( function( to ) {
			$( '.croccante_action_skills .croccante_main_text' ).text( to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_subtitle_skills]', function( value ) {
		value.bind( function( to ) {
			$( '.croccante_action_skills .croccante_subtitle' ).text( to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_phrase_cta]', function( value ) {
		value.bind( function( to ) {
			$( '.cta_columns .ctaPhrase h3' ).text( to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_desc_cta]', function( value ) {
		value.bind( function( to ) {
			$( '.cta_columns .ctaPhrase p' ).text( to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_title_services]', function( value ) {
		value.bind( function( to ) {
			$( '.croccante_action_services .croccante_main_text' ).text( to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_subtitle_services]', function( value ) {
		value.bind( function( to ) {
			$( '.croccante_action_services .croccante_subtitle' ).text( to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_phrase_services]', function( value ) {
		value.bind( function( to ) {
			$( '.services_columns_single .serviceContent h3' ).text( to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_textarea_services]', function( value ) {
		value.bind( function( to ) {
			$( '.services_columns_single .serviceContent p' ).text( to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_title_blog]', function( value ) {
		value.bind( function( to ) {
			$( '.croccante_action_blog .croccante_main_text' ).text( to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_subtitle_blog]', function( value ) {
		value.bind( function( to ) {
			$( '.croccante_action_blog .croccante_subtitle' ).text( to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_title_team]', function( value ) {
		value.bind( function( to ) {
			$( '.croccante_action_team .croccante_main_text' ).text( to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_subtitle_team]', function( value ) {
		value.bind( function( to ) {
			$( '.croccante_action_team .croccante_subtitle' ).text( to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_title_contact]', function( value ) {
		value.bind( function( to ) {
			$( '.croccante_action_contact .croccante_main_text' ).text( to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_subtitle_contact]', function( value ) {
		value.bind( function( to ) {
			$( '.croccante_action_contact .croccante_subtitle' ).text( to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_additionaltext_contact]', function( value ) {
		value.bind( function( to ) {
			$( '.croccanteAdditionalText p' ).text( to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_companyname_contact]', function( value ) {
		value.bind( function( to ) {
			$( '.croccanteCompanyName h3' ).text( to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_companyaddress1_contact]', function( value ) {
		value.bind( function( to ) {
			$( '.croccanteCompanyAddress1 p' ).text( to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_companyaddress2_contact]', function( value ) {
		value.bind( function( to ) {
			$( '.croccanteCompanyAddress2 p' ).text( to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_companyaddress3_contact]', function( value ) {
		value.bind( function( to ) {
			$( '.croccanteCompanyAddress3 p' ).text( to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_companyphone_contact]', function( value ) {
		value.bind( function( to ) {
			$( '.croccanteCompanyPhone p' ).text( to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_companyfax_contact]', function( value ) {
		value.bind( function( to ) {
			$( '.croccanteCompanyFax p' ).text( to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_companyemail_contact]', function( value ) {
		value.bind( function( to ) {
			$( '.croccanteCompanyEmail p' ).text( to );
		} );
	} );
	/* Background Color and Text */
	wp.customize( 'croccante_theme_options[_onepage_textcolor_slider]', function( value ) {
		value.bind( function( to ) {
			$('.flexslider .slides > li .flexText .inside, .flex-direction-nav a').css('color', to );
			$('.scrollDownCroccante, .flex-direction-nav a').css('border-color', to );
			$('.scrollDownCroccante .inside').css('background-color', to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_imgcolor_aboutus]', function( value ) {
		value.bind( function( to ) {
			$('.croccante_aboutus_color').css('background-color', to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_textcolor_aboutus]', function( value ) {
		value.bind( function( to ) {
			$('section.croccante_aboutus').css('color', to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_imgcolor_features]', function( value ) {
		value.bind( function( to ) {
			$('.croccante_features_color').css('background-color', to );
			$('.featuresIcon').css('color', to );
			$('.features_columns_single:hover .featuresIcon').css('color', to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_textcolor_features]', function( value ) {
		value.bind( function( to ) {
			$('section.croccante_features, .featuresIcon').css('color', to );
			$('.featuresIcon').css('border-color', to );
			$('.features_columns_single:hover .featuresIcon').css('background', to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_imgcolor_cta]', function( value ) {
		value.bind( function( to ) {
			$('.croccante_cta_color, .cta_columns .ctaIcon').css('background-color', to );
			$('section.croccante_cta:hover .cta_columns .ctaIcon').css('color', to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_textcolor_cta]', function( value ) {
		value.bind( function( to ) {
			$('section.croccante_cta, .cta_columns .ctaIcon').css('color', to );
			$('section.croccante_cta:hover .cta_columns .ctaIcon').css('background-color', to );
			$('.cta_columns .ctaIcon').css('border-color', to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_imgcolor_services]', function( value ) {
		value.bind( function( to ) {
			$('.croccante_services_color, .serviceIcon').css('background-color', to );
			$('.services_columns_single .serviceContent, .singleService:hover .serviceIcon').css('color', to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_textcolor_services]', function( value ) {
		value.bind( function( to ) {
			$('section.croccante_services, .serviceIcon').css('color', to );
			$('.serviceIcon').css('border-color', to );
			$('.services_columns_single.two .serviceColumnSingleColor, .singleService:hover .serviceIcon').css('background-color', to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_imgcolor_blog]', function( value ) {
		value.bind( function( to ) {
			$('.croccante_blog_color').css('background-color', to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_textcolor_blog]', function( value ) {
		value.bind( function( to ) {
			$('section.croccante_blog, section.croccante_blog .entry-meta a').css('color', to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_imgcolor_team]', function( value ) {
		value.bind( function( to ) {
			$('.croccante_team_color').css('background-color', to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_textcolor_team]', function( value ) {
		value.bind( function( to ) {
			$('section.croccante_team').css('color', to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_imgcolor_contact]', function( value ) {
		value.bind( function( to ) {
			$('.croccante_contact_color').css('background-color', to );
			$('.croccanteCompanyAddress1Icon, .croccanteCompanyPhoneIcon, .croccanteCompanyFaxIcon, .croccanteCompanyEmailIcon').css('color', to );
		} );
	} );
	wp.customize( 'croccante_theme_options[_onepage_textcolor_contact]', function( value ) {
		value.bind( function( to ) {
			$('section.croccante_contact, .contact_columns .croccanteContactForm input:not([type="submit"]), .contact_columns .croccanteContactForm textarea').css('color', to );
			$('section.croccante_contact, .contact_columns .croccanteContactForm input:not([type="submit"]), .contact_columns .croccanteContactForm textarea').css('border-color', to );
			$('.croccanteCompanyAddress1Icon, .croccanteCompanyPhoneIcon, .croccanteCompanyFaxIcon, .croccanteCompanyEmailIcon').css('background', to );
		} );
	} );
} )( jQuery );
