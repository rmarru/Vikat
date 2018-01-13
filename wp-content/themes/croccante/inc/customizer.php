<?php
/**
 * croccante Theme Customizer
 *
 * @package croccante
 */

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function croccante_customize_preview_js() {
	wp_enqueue_script( 'croccante_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'croccante_customize_preview_js' );

function croccante_customizer_script() {
	wp_enqueue_script( 'croccante-customizer-script', get_template_directory_uri() .'/js/customizer-script.js', array("jquery"),'', true  );
	wp_enqueue_style( 'croccante-customizer-style', get_template_directory_uri() .'/inc/css/customizer-style.css');	
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() .'/css/font-awesome.min.css');
}
add_action( 'customize_controls_enqueue_scripts', 'croccante_customizer_script' );

/**
 * Replace Excerpt More
 */
if ( ! function_exists( 'croccante_new_excerpt_more' ) ) {
	function croccante_new_excerpt_more( $more ) {
		if ( is_admin() ) {
			return $more;
		}
		$customMore = croccante_options('_excerpt_more', '&hellip;');
		return esc_html($customMore);
	}
}
add_filter('excerpt_more', 'croccante_new_excerpt_more');

/**
 * Custom Excerpt Length
 */
if( ! function_exists('croccante_custom_excerpt_length')){
	function croccante_custom_excerpt_length( $length ) {
		if ( ! is_admin() && is_page_template('template-onepage.php') ) {
			$textBlog = croccante_options('_onepage_lenght_blog', '20');
			return intval($textBlog);
		} else {
			return $length;
		}
	}
}
add_filter( 'excerpt_length', 'croccante_custom_excerpt_length', 999 );

 /**
 * Delete font size style from tag cloud widget
 */
if ( ! function_exists( 'croccante_fix_tag_cloud' ) ) {
	function croccante_fix_tag_cloud($tag_string){
	   return preg_replace('/ style=("|\')(.*?)("|\')/','',$tag_string);
	}
}
add_filter('wp_generate_tag_cloud', 'croccante_fix_tag_cloud',10,1);

 /**
 * Page Loader
 */
if( ! function_exists('croccante_loadingPage')){
	function croccante_loadingPage() {
		echo '<div class="cLoader1"></div>';
	}
}

 /**
 * One page map
 */
if( ! function_exists('croccante_sectionmap')){
	function croccante_sectionmap() {
		if (croccante_options('_onepage_settings_sectionmap', '') == 1) {
			$singleSection = 'slider,aboutus,features,skills,cta,services,blog,team,contact';
			$values = explode( ',', $singleSection );
			echo '<ul class="croccante_sectionmap">';
			foreach( $values as $val ) {
				if(croccante_options('_onepage_section_'.$val) == 1) {
					$sectionID = croccante_options('_onepage_id_'.$val, $val);
					$sectionText = croccante_options('_onepage_settings_map_'.$val);
					if ($sectionText) {
						echo '<li class="' . esc_attr($sectionID) . '"><a href="#' . esc_attr($sectionID) . '"><span class="box"></span></a><span class="text">' .esc_html($sectionText). '</span></li>';
					}
				}
			}
			echo '</ul>';
		}
	}
}

/**
 * Register Custom Settings
 */
function croccante_custom_settings_register( $wp_customize ) {
	/* Add Panels */
	$wp_customize->add_panel( 'cresta_croccante_themeoptions', array(
	 'priority'       => 50,
	  'capability'     => 'edit_theme_options',
	  'theme_supports' => '',
	  'title'          => esc_html__('Croccante Theme Options', 'croccante')
	) );
	$wp_customize->add_panel( 'cresta_croccante_onepage', array(
	 'priority'       => 50,
	  'capability'     => 'edit_theme_options',
	  'theme_supports' => '',
	  'active_callback' => 'croccante_is_one_page',
	  'title'    => esc_html__( 'Croccante Onepage', 'croccante' ),
	) );
	/* Add Sections Theme Options */
	$wp_customize->add_section( 'cresta_croccante_theme_options_general', array(
	     'title'    => esc_html__( 'General Settings', 'croccante' ),
	     'priority' => 10,
		 'panel'  => 'cresta_croccante_themeoptions',
	) );
	$wp_customize->add_section( 'cresta_croccante_theme_options_colors', array(
	     'title'    => esc_html__( 'Theme Colors', 'croccante' ),
	     'priority' => 10,
		 'panel'  => 'cresta_croccante_themeoptions',
	) );
	$wp_customize->add_section( 'cresta_croccante_theme_options_social', array(
	     'title'    => esc_html__( 'Social Network', 'croccante' ),
	     'priority' => 10,
		 'panel'  => 'cresta_croccante_themeoptions',
	) );
	/* Add Sections OnePage */
	$wp_customize->add_section( 'cresta_croccante_onepage_section_settings', array(
	     'title'    => esc_html__( 'Onepage general settings', 'croccante' ),
	     'priority' => 10,
		 'panel'  => 'cresta_croccante_onepage',
	) );
	$wp_customize->add_section( 'cresta_croccante_onepage_section_slider', array(
	     'title'    => esc_html__( 'Section slider', 'croccante' ),
	     'priority' => 10,
		 'panel'  => 'cresta_croccante_onepage',
	) );
	$wp_customize->add_section( 'cresta_croccante_onepage_section_aboutus', array(
	     'title'    => esc_html__( 'Section about us', 'croccante' ),
	     'priority' => 10,
		 'panel'  => 'cresta_croccante_onepage',
	) );
	$wp_customize->add_section( 'cresta_croccante_onepage_section_features', array(
	     'title'    => esc_html__( 'Section features', 'croccante' ),
	     'priority' => 10,
		 'panel'  => 'cresta_croccante_onepage',
	) );
	$wp_customize->add_section( 'cresta_croccante_onepage_section_skills', array(
	     'title'    => esc_html__( 'Section skills', 'croccante' ),
	     'priority' => 10,
		 'panel'  => 'cresta_croccante_onepage',
	) );
	$wp_customize->add_section( 'cresta_croccante_onepage_section_cta', array(
	     'title'    => esc_html__( 'Section call to action', 'croccante' ),
	     'priority' => 10,
		 'panel'  => 'cresta_croccante_onepage',
	) );
	$wp_customize->add_section( 'cresta_croccante_onepage_section_services', array(
	     'title'    => esc_html__( 'Section services', 'croccante' ),
	     'priority' => 10,
		 'panel'  => 'cresta_croccante_onepage',
	) );
	$wp_customize->add_section( 'cresta_croccante_onepage_section_blog', array(
	     'title'    => esc_html__( 'Section blog', 'croccante' ),
	     'priority' => 10,
		 'panel'  => 'cresta_croccante_onepage',
	) );
	$wp_customize->add_section( 'cresta_croccante_onepage_section_team', array(
	     'title'    => esc_html__( 'Section team', 'croccante' ),
	     'priority' => 10,
		 'panel'  => 'cresta_croccante_onepage',
	) );
	$wp_customize->add_section( 'cresta_croccante_onepage_section_contact', array(
	     'title'    => esc_html__( 'Section contact', 'croccante' ),
	     'priority' => 10,
		 'panel'  => 'cresta_croccante_onepage',
	) );
	$wp_customize->add_section( 'cresta_croccante_links', array(
	 'priority'       => 999,
	  'capability'     => 'edit_theme_options',
	  'title'          => esc_html__('Croccante useful links', 'croccante')
	) );
	/**
	* ################ SECTION GENERAL SETTINGS
	*/
	/* Show Page Loader */
	$wp_customize->add_setting('croccante_theme_options[_show_loader]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'croccante_sanitize_checkbox'
    ) );
	$wp_customize->add_control('croccante_theme_options[_show_loader]', array(
        'label'      => __( 'Display page loader', 'croccante' ),
        'section'    => 'cresta_croccante_theme_options_general',
        'settings'   => 'croccante_theme_options[_show_loader]',
        'type'       => 'checkbox',
		'priority' => 1,
    ) );
	/* Show Search Button */
	$wp_customize->add_setting('croccante_theme_options[_search_button]', array(
        'default'    => '1',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'croccante_sanitize_checkbox'
    ) );
	$wp_customize->add_control('croccante_theme_options[_search_button]', array(
        'label'      => __( 'Display search button in the header', 'croccante' ),
        'section'    => 'cresta_croccante_theme_options_general',
        'settings'   => 'croccante_theme_options[_search_button]',
        'type'       => 'checkbox',
		'priority' => 2,
    ) );
	/* Enable Smooth Scroll */
	$wp_customize->add_setting('croccante_theme_options[_smooth_scroll]', array(
        'default'    => '1',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'croccante_sanitize_checkbox'
    ) );
	$wp_customize->add_control('croccante_theme_options[_smooth_scroll]', array(
        'label'      => __( 'Enable Smooth Scroll', 'croccante' ),
        'section'    => 'cresta_croccante_theme_options_general',
        'settings'   => 'croccante_theme_options[_smooth_scroll]',
        'type'       => 'checkbox',
		'priority' => 3,
    ) );
	/* Scroll to top also in mobile */
	$wp_customize->add_setting('croccante_theme_options[_scroll_top]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'croccante_sanitize_checkbox'
    ) );
	$wp_customize->add_control('croccante_theme_options[_scroll_top]', array(
        'label'      => __( 'Show scroll to top button also on mobile view', 'croccante' ),
        'section'    => 'cresta_croccante_theme_options_general',
        'settings'   => 'croccante_theme_options[_scroll_top]',
        'type'       => 'checkbox',
		'priority' => 3,
    ) );
	/* Custom Excerpt More */
	$wp_customize->add_setting('croccante_theme_options[_excerpt_more]', array(
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'default'    => '&hellip;'
    ) );
	$wp_customize->add_control('croccante_theme_options[_excerpt_more]', array(
        'label'      => __( 'Custom Excerpt Final', 'croccante' ),
        'section'    => 'cresta_croccante_theme_options_general',
        'settings'   => 'croccante_theme_options[_excerpt_more]',
        'type'       => 'text',
		'priority' => 4,
    ) );
	/* Show excerpt or full post */
	$wp_customize->add_setting('croccante_theme_options[_showpost_type]', array(
        'default'    => 'excerpt',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'croccante_sanitize_select',
    ) );
	$wp_customize->add_control('croccante_theme_options[_showpost_type]', array(
        'label'      => __( 'Show excerpt or full post', 'croccante' ),
        'section'    => 'cresta_croccante_theme_options_general',
        'settings'   => 'croccante_theme_options[_showpost_type]',
        'type'       => 'select',
		'priority' => 5,
		'choices' => array(
			'excerpt' => __( 'Show excerpt', 'croccante'),
			'fullpost' => __( 'Show full post', 'croccante'),
		),
    ) );
	/**
	* ################ SECTION THEME COLORS
	*/
	/* Main Border Section Color */
	$wp_customize->add_setting('croccante_theme_options[_heading_mainborder]', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Croccante_Customize_Heading(
		$wp_customize,
		'croccante_theme_options[_heading_mainborder]',
		array(
			'settings'		=> 'croccante_theme_options[_heading_mainborder]',
			'section'		=> 'cresta_croccante_theme_options_colors',
			'label'			=> __( 'Main Border Section', 'croccante' ),
			'priority' => 1,
		))
	);
	/* Content Section Color */
	$wp_customize->add_setting('croccante_theme_options[_heading_content]', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Croccante_Customize_Heading(
		$wp_customize,
		'croccante_theme_options[_heading_content]',
		array(
			'settings'		=> 'croccante_theme_options[_heading_content]',
			'section'		=> 'cresta_croccante_theme_options_colors',
			'label'			=> __( 'Content Section', 'croccante' ),
			'priority' => 5,
		))
	);
	/* Sidebar Section Color */
	$wp_customize->add_setting('croccante_theme_options[_heading_sidebar]', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Croccante_Customize_Heading(
		$wp_customize,
		'croccante_theme_options[_heading_sidebar]',
		array(
			'settings'		=> 'croccante_theme_options[_heading_sidebar]',
			'section'		=> 'cresta_croccante_theme_options_colors',
			'label'			=> __( 'Push Sidebar Section', 'croccante' ),
			'priority' => 11,
		))
	);
	/* Footer Section Color */
	$wp_customize->add_setting('croccante_theme_options[_heading_footer]', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Croccante_Customize_Heading(
		$wp_customize,
		'croccante_theme_options[_heading_footer]',
		array(
			'settings'		=> 'croccante_theme_options[_heading_footer]',
			'section'		=> 'cresta_croccante_theme_options_colors',
			'label'			=> __( 'Footer Section', 'croccante' ),
			'priority' => 15,
		))
	);
	
	$colors = array();
	
	$colors[] = array(
	'slug'=>'_mainborder_background_color', 
	'default' => '#ffffff',
	'label' => __('Main Border Background Color', 'croccante'),
	'priority' => 2,
	);
	$colors[] = array(
	'slug'=>'_mainborder_text_color', 
	'default' => '#242423',
	'label' => __('Main Border Text Color', 'croccante'),
	'priority' => 3,
	);
	$colors[] = array(
	'slug'=>'_mainborder_link_color', 
	'default' => '#5BC0EB',
	'label' => __('Main Border Link Hover Color', 'croccante'),
	'priority' => 4,
	);
	$colors[] = array(
	'slug'=>'_content_background_color', 
	'default' => '#f4f4f4',
	'label' => __('Content Background Color', 'croccante'),
	'priority' => 6,
	);
	$colors[] = array(
	'slug'=>'_content_secondarybackground_color', 
	'default' => '#ececec',
	'label' => __('General Secondary Background Color', 'croccante'),
	'priority' => 7,
	);
	$colors[] = array(
	'slug'=>'_content_text_color', 
	'default' => '#404040',
	'label' => __('Content Text Color', 'croccante'),
	'priority' => 8,
	);
	$colors[] = array(
	'slug'=>'_content_link_color', 
	'default' => '#5BC0EB',
	'label' => __('Content Link Color', 'croccante'),
	'priority' => 9,
	);
	$colors[] = array(
	'slug'=>'_content_border_color', 
	'default' => '#c9c9c9',
	'label' => __('General Border Color', 'croccante'),
	'priority' => 10,
	);
	$colors[] = array(
	'slug'=>'_sidebar_background_color', 
	'default' => '#ffffff',
	'label' => __('Push sidebar background color', 'croccante'),
	'priority' => 12,
	);
	$colors[] = array(
	'slug'=>'_sidebar_text_color', 
	'default' => '#404040',
	'label' => __('Push sidebar text color', 'croccante'),
	'priority' => 13,
	);
	$colors[] = array(
	'slug'=>'_sidebar_link_color', 
	'default' => '#5BC0EB',
	'label' => __('Push sidebar link color', 'croccante'),
	'priority' => 14,
	);
	$colors[] = array(
	'slug'=>'_footer_background_color', 
	'default' => '#000000',
	'label' => __('Footer background color', 'croccante'),
	'priority' => 16,
	);
	$colors[] = array(
	'slug'=>'_footer_text_color', 
	'default' => '#ffffff',
	'label' => __('Footer text color', 'croccante'),
	'priority' => 17,
	);
	$colors[] = array(
	'slug'=>'_footer_link_color', 
	'default' => '#9b9b9b',
	'label' => __('Footer link color', 'croccante'),
	'priority' => 18,
	);
	foreach( $colors as $croccante_theme_options_colors ) {
		$wp_customize->add_setting(
			'croccante_theme_options[' . $croccante_theme_options_colors['slug'] . ']', array(
				'default' => $croccante_theme_options_colors['default'],
				'type' => 'option', 
				'sanitize_callback' => 'sanitize_hex_color',
				'capability' => 'edit_theme_options'
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'croccante_theme_options[' . $croccante_theme_options_colors['slug'] . ']', array(
					'label' => $croccante_theme_options_colors['label'], 
					'section' => 'cresta_croccante_theme_options_colors',
					'settings' =>'croccante_theme_options[' . $croccante_theme_options_colors['slug'] . ']',
					'priority' => $croccante_theme_options_colors['priority'],
				)
			)
		);
	}
	/**
	* ################ SECTION SOCIAL NETWORK
	*/	
	$socialmedia = array();
	
	$socialmedia[] = array(
	'slug'=>'_facebookurl', 
	'default' => '',
	'label' => __('Facebook URL', 'croccante')
	);
	$socialmedia[] = array(
	'slug'=>'_twitterurl', 
	'default' => '',
	'label' => __('Twitter URL', 'croccante')
	);
	$socialmedia[] = array(
	'slug'=>'_googleplusurl', 
	'default' => '',
	'label' => __('Google Plus URL', 'croccante')
	);
	$socialmedia[] = array(
	'slug'=>'_linkedinurl', 
	'default' => '',
	'label' => __('Linkedin URL', 'croccante')
	);
	$socialmedia[] = array(
	'slug'=>'_instagramurl', 
	'default' => '',
	'label' => __('Instagram URL', 'croccante')
	);
	$socialmedia[] = array(
	'slug'=>'_youtubeurl', 
	'default' => '',
	'label' => __('YouTube URL', 'croccante')
	);
	$socialmedia[] = array(
	'slug'=>'_pinteresturl', 
	'default' => '',
	'label' => __('Pinterest URL', 'croccante')
	);
	$socialmedia[] = array(
	'slug'=>'_tumblrurl', 
	'default' => '',
	'label' => __('Tumblr URL', 'croccante')
	);
	$socialmedia[] = array(
	'slug'=>'_flickrurl', 
	'default' => '',
	'label' => __('Flickr URL', 'croccante')
	);
	$socialmedia[] = array(
	'slug'=>'_vkurl', 
	'default' => '',
	'label' => __('VK URL', 'croccante')
	);
	$socialmedia[] = array(
	'slug'=>'_xingurl', 
	'default' => '',
	'label' => __('Xing URL', 'croccante')
	);
	$socialmedia[] = array(
	'slug'=>'_redditurl', 
	'default' => '',
	'label' => __('Reddit URL', 'croccante')
	);
	foreach( $socialmedia as $croccante_theme_options ) {
		// SETTINGS
		$wp_customize->add_setting(
			'croccante_theme_options[' . $croccante_theme_options['slug']. ']', array(
				'default' => $croccante_theme_options['default'],
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw',
				'type'     => 'option',
			)
		);
		// CONTROLS
		$wp_customize->add_control(
			'croccante_theme_options[' . $croccante_theme_options['slug']. ']', 
			array('label' => $croccante_theme_options['label'], 
			'section'    => 'cresta_croccante_theme_options_social',
			'settings' =>'croccante_theme_options[' . $croccante_theme_options['slug']. ']',
			)
		);
	}
	/* Open social links */
	$wp_customize->add_setting('croccante_theme_options[_social_open_links]', array(
        'default'    => '_self',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'croccante_sanitize_select',
    ) );
	$wp_customize->add_control('croccante_theme_options[_social_open_links]', array(
        'label'      => __( 'Open social links', 'croccante' ),
        'section'    => 'cresta_croccante_theme_options_social',
        'settings'   => 'croccante_theme_options[_social_open_links]',
        'type'       => 'select',
		'priority' => 4,
		'choices' => array(
			'_self' => __( 'Same window', 'croccante'),
			'_blank' => __( 'New Window', 'croccante'),
		),
    ) );
	/**
	* ################ ONEPAGE GENERAL SETTINGS
	*/
	/* One Page Map */
	$wp_customize->add_setting('croccante_theme_options[_onepage_settings_sectionmaphead]', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Croccante_Customize_Heading(
		$wp_customize,
		'croccante_theme_options[_onepage_settings_sectionmaphead]',
		array(
			'settings'		=> 'croccante_theme_options[_onepage_settings_sectionmaphead]',
			'section'		=> 'cresta_croccante_onepage_section_settings',
			'label'			=> __( 'One Page Map', 'croccante' ),
			'priority' => 1,
		))
	);
	/* One page section map */
	$wp_customize->add_setting('croccante_theme_options[_onepage_settings_sectionmap]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'croccante_sanitize_checkbox'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_settings_sectionmap]', array(
        'label'      => __( 'Show the one page section map', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_settings',
        'settings'   => 'croccante_theme_options[_onepage_settings_sectionmap]',
        'type'       => 'checkbox',
		'priority' => 1,
    ) );
	/* Slider Text */
	$wp_customize->add_setting('croccante_theme_options[_onepage_settings_map_slider]', array(
		'default'    => '',
		'type'       => 'option',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control('croccante_theme_options[_onepage_settings_map_slider]', array(
		'label'      => __( 'Slider Text', 'croccante' ),
		'section'    => 'cresta_croccante_onepage_section_settings',
		'settings'   => 'croccante_theme_options[_onepage_settings_map_slider]',
		'type'       => 'text',
		'active_callback' => 'croccante_is_sectionmap_active',
	) );
	/* About us Text */
	$wp_customize->add_setting('croccante_theme_options[_onepage_settings_map_aboutus]', array(
		'default'    => '',
		'type'       => 'option',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control('croccante_theme_options[_onepage_settings_map_aboutus]', array(
		'label'      => __( 'About Us Text', 'croccante' ),
		'section'    => 'cresta_croccante_onepage_section_settings',
		'settings'   => 'croccante_theme_options[_onepage_settings_map_aboutus]',
		'type'       => 'text',
		'active_callback' => 'croccante_is_sectionmap_active',
	) );
	/* Features Text */
	$wp_customize->add_setting('croccante_theme_options[_onepage_settings_map_features]', array(
		'default'    => '',
		'type'       => 'option',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control('croccante_theme_options[_onepage_settings_map_features]', array(
		'label'      => __( 'Features Text', 'croccante' ),
		'section'    => 'cresta_croccante_onepage_section_settings',
		'settings'   => 'croccante_theme_options[_onepage_settings_map_features]',
		'type'       => 'text',
		'active_callback' => 'croccante_is_sectionmap_active',
	) );
	/* Skills Text */
	$wp_customize->add_setting('croccante_theme_options[_onepage_settings_map_skills]', array(
		'default'    => '',
		'type'       => 'option',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control('croccante_theme_options[_onepage_settings_map_skills]', array(
		'label'      => __( 'Skills Text', 'croccante' ),
		'section'    => 'cresta_croccante_onepage_section_settings',
		'settings'   => 'croccante_theme_options[_onepage_settings_map_skills]',
		'type'       => 'text',
		'active_callback' => 'croccante_is_sectionmap_active',
	) );
	/* CTA Text */
	$wp_customize->add_setting('croccante_theme_options[_onepage_settings_map_cta]', array(
		'default'    => '',
		'type'       => 'option',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control('croccante_theme_options[_onepage_settings_map_cta]', array(
		'label'      => __( 'CTA Text', 'croccante' ),
		'section'    => 'cresta_croccante_onepage_section_settings',
		'settings'   => 'croccante_theme_options[_onepage_settings_map_cta]',
		'type'       => 'text',
		'active_callback' => 'croccante_is_sectionmap_active',
	) );
	/* Services Text */
	$wp_customize->add_setting('croccante_theme_options[_onepage_settings_map_services]', array(
		'default'    => '',
		'type'       => 'option',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control('croccante_theme_options[_onepage_settings_map_services]', array(
		'label'      => __( 'Services Text', 'croccante' ),
		'section'    => 'cresta_croccante_onepage_section_settings',
		'settings'   => 'croccante_theme_options[_onepage_settings_map_services]',
		'type'       => 'text',
		'active_callback' => 'croccante_is_sectionmap_active',
	) );
	/* Blog Text */
	$wp_customize->add_setting('croccante_theme_options[_onepage_settings_map_blog]', array(
		'default'    => '',
		'type'       => 'option',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control('croccante_theme_options[_onepage_settings_map_blog]', array(
		'label'      => __( 'Blog Text', 'croccante' ),
		'section'    => 'cresta_croccante_onepage_section_settings',
		'settings'   => 'croccante_theme_options[_onepage_settings_map_blog]',
		'type'       => 'text',
		'active_callback' => 'croccante_is_sectionmap_active',
	) );
	/* Team Text */
	$wp_customize->add_setting('croccante_theme_options[_onepage_settings_map_team]', array(
		'default'    => '',
		'type'       => 'option',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control('croccante_theme_options[_onepage_settings_map_team]', array(
		'label'      => __( 'Team Text', 'croccante' ),
		'section'    => 'cresta_croccante_onepage_section_settings',
		'settings'   => 'croccante_theme_options[_onepage_settings_map_team]',
		'type'       => 'text',
		'active_callback' => 'croccante_is_sectionmap_active',
	) );
	/* Contact Text */
	$wp_customize->add_setting('croccante_theme_options[_onepage_settings_map_contact]', array(
		'default'    => '',
		'type'       => 'option',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control('croccante_theme_options[_onepage_settings_map_contact]', array(
		'label'      => __( 'Contact Text', 'croccante' ),
		'section'    => 'cresta_croccante_onepage_section_settings',
		'settings'   => 'croccante_theme_options[_onepage_settings_map_contact]',
		'type'       => 'text',
		'active_callback' => 'croccante_is_sectionmap_active',
	) );
	/**
	* ################ SECTION SLIDER
	*/
	/* Show Slider Section */
	$wp_customize->add_setting('croccante_theme_options[_onepage_section_slider]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'croccante_sanitize_checkbox'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_section_slider]', array(
        'label'      => __( 'Display section slider', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_slider',
        'settings'   => 'croccante_theme_options[_onepage_section_slider]',
        'type'       => 'checkbox',
		'priority' => 1,
    ) );
	/* Section ID */
	$wp_customize->add_setting('croccante_theme_options[_onepage_id_slider]', array(
        'default'    => 'slider',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_id_slider]', array(
        'label'      => __( 'Section ID name', 'croccante' ),
		'description'	=> __( 'ID for this section - if you want the user to be able to scroll down to this section.', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_slider',
        'settings'   => 'croccante_theme_options[_onepage_id_slider]',
		'active_callback' => 'croccante_is_slider_active',
        'type'       => 'text',
		'priority' => 2,
    ) );
	/* Background Color Slider */
	$wp_customize->add_setting( 'croccante_theme_options[_onepage_imgcolor_slider]', array(
		'default' => '#404040',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'croccante_theme_options[_onepage_imgcolor_slider]', 
		array(
			'label' => __( 'Background Color shade Section', 'croccante' ),
			'section' => 'cresta_croccante_onepage_section_slider',
			'settings' =>'croccante_theme_options[_onepage_imgcolor_slider]',
			'active_callback' => 'croccante_is_slider_active',
			'priority' => 2,
		) )
	);
	/* Text Color Slider */
	$wp_customize->add_setting( 'croccante_theme_options[_onepage_textcolor_slider]', array(
		'default' => '#ffffff',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'croccante_theme_options[_onepage_textcolor_slider]', 
		array(
			'label' => __( 'Text Color Section', 'croccante' ),
			'section' => 'cresta_croccante_onepage_section_slider',
			'settings' =>'croccante_theme_options[_onepage_textcolor_slider]',
			'active_callback' => 'croccante_is_slider_active',
			'priority' => 2,
		) )
	);
	/* Scroll down button */
	$wp_customize->add_setting('croccante_theme_options[_onepage_scrolldown_slider]', array(
        'default'    => '1',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'croccante_sanitize_checkbox'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_scrolldown_slider]', array(
        'label'      => __( 'Show scroll down button', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_slider',
        'settings'   => 'croccante_theme_options[_onepage_scrolldown_slider]',
        'type'       => 'checkbox',
		'active_callback' => 'croccante_is_slider_active',
		'priority' => 3,
    ) );
	for( $number = 1; $number < 4; $number++ ){
		/* Slider Text */
		$wp_customize->add_setting('croccante_theme_options[_onepage_head_'.$number.'_slider]', array(
			'sanitize_callback' => 'sanitize_text_field',
			'type'       => 'option',
		));
		$wp_customize->add_control(
			new Croccante_Customize_Heading(
			$wp_customize,
			'croccante_theme_options[_onepage_head_'.$number.'_slider]',
			array(
				'settings'		=> 'croccante_theme_options[_onepage_head_'.$number.'_slider]',
				'section'		=> 'cresta_croccante_onepage_section_slider',
				'label'			=> __( 'Slider ', 'croccante' ).$number,
				'active_callback' => 'croccante_is_slider_active',
			))
		);
		/* Slide Image */
		$wp_customize->add_setting('croccante_theme_options[_onepage_image_'.$number.'_slider]', array(
			'default'    => '',
			'type'       => 'option',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw'
		) );
		$wp_customize->add_control( 
			new WP_Customize_Image_Control(
			$wp_customize, 
			'croccante_theme_options[_onepage_image_'.$number.'_slider]', 
			array(
				'label'      => __( 'Slide image ', 'croccante' ).$number,
				'section'    => 'cresta_croccante_onepage_section_slider',
				'settings'   => 'croccante_theme_options[_onepage_image_'.$number.'_slider]',
				'active_callback' => 'croccante_is_slider_active',
			) ) 
		);
		/* Slide Text */
		$wp_customize->add_setting('croccante_theme_options[_onepage_text_'.$number.'_slider]', array(
			'default'    => '',
			'type'       => 'option',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage'
		) );
		$wp_customize->add_control('croccante_theme_options[_onepage_text_'.$number.'_slider]', array(
			'label'      => __( 'Slider Text ', 'croccante' ).$number,
			'section'    => 'cresta_croccante_onepage_section_slider',
			'settings'   => 'croccante_theme_options[_onepage_text_'.$number.'_slider]',
			'type'       => 'text',
			'active_callback' => 'croccante_is_slider_active',
		) );
		/* Slide Subtext */
		$wp_customize->add_setting('croccante_theme_options[_onepage_subtext_'.$number.'_slider]', array(
			'default'    => '',
			'type'       => 'option',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage'
		) );
		$wp_customize->add_control('croccante_theme_options[_onepage_subtext_'.$number.'_slider]', array(
			'label'      => __( 'Slider Subtext ', 'croccante' ).$number,
			'section'    => 'cresta_croccante_onepage_section_slider',
			'settings'   => 'croccante_theme_options[_onepage_subtext_'.$number.'_slider]',
			'type'       => 'text',
			'active_callback' => 'croccante_is_slider_active',
		) );
	}
	/* Info slider */
	$wp_customize->add_setting('croccante_theme_options[_onepage_info_slider]',array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Croccante_Info_Text( 
		$wp_customize,
		'croccante_theme_options[_onepage_info_slider]',
		array(
			'settings'		=> 'croccante_theme_options[_onepage_info_slider]',
			'section'		=> 'cresta_croccante_onepage_section_slider',
			'label'			=> __( 'Note:', 'croccante' ),	
			'description'	=> __( 'Upload up to three sliders. Recommended image size: 1920X1080', 'croccante' ),
			'active_callback' => 'croccante_is_slider_active',
			'priority' => 18,
		))
	);
	/**
	* ################ SECTION ABOUT US
	*/
	/* Show About Us Section */
	$wp_customize->add_setting('croccante_theme_options[_onepage_section_aboutus]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'croccante_sanitize_checkbox'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_section_aboutus]', array(
        'label'      => __( 'Display section about us', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_aboutus',
        'settings'   => 'croccante_theme_options[_onepage_section_aboutus]',
        'type'       => 'checkbox',
		'priority' => 1,
    ) );
	/* Section ID */
	$wp_customize->add_setting('croccante_theme_options[_onepage_id_aboutus]', array(
        'default'    => 'aboutus',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_id_aboutus]', array(
        'label'      => __( 'Section ID name', 'croccante' ),
		'description'	=> __( 'ID for this section - if you want the user to be able to scroll down to this section.', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_aboutus',
        'settings'   => 'croccante_theme_options[_onepage_id_aboutus]',
		'active_callback' => 'croccante_is_aboutus_active',
        'type'       => 'text',
		'priority' => 2,
    ) );
	/* Background Image About us */
	$wp_customize->add_setting('croccante_theme_options[_onepage_imgback_aboutus]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw'
    ) );
	$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
		$wp_customize, 
		'croccante_theme_options[_onepage_imgback_aboutus]', 
		array(
			'label'      => __( 'Background Image Section (optional)', 'croccante' ),
			'section'    => 'cresta_croccante_onepage_section_aboutus',
			'settings'   => 'croccante_theme_options[_onepage_imgback_aboutus]',
			'active_callback' => 'croccante_is_aboutus_active',
			'priority' => 3,
		) ) 
	);
	/* Background Color About us */
	$wp_customize->add_setting( 'croccante_theme_options[_onepage_imgcolor_aboutus]', array(
		'default' => '#ffffff',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'croccante_theme_options[_onepage_imgcolor_aboutus]', 
		array(
			'label' => __( 'Background Color Section', 'croccante' ),
			'section' => 'cresta_croccante_onepage_section_aboutus',
			'settings' =>'croccante_theme_options[_onepage_imgcolor_aboutus]',
			'active_callback' => 'croccante_is_aboutus_active',
			'priority' => 4,
		) )
	);
	/* Text Color About us */
	$wp_customize->add_setting( 'croccante_theme_options[_onepage_textcolor_aboutus]', array(
		'default' => '#404040',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'croccante_theme_options[_onepage_textcolor_aboutus]', 
		array(
			'label' => __( 'Text Color Section', 'croccante' ),
			'section' => 'cresta_croccante_onepage_section_aboutus',
			'settings' =>'croccante_theme_options[_onepage_textcolor_aboutus]',
			'active_callback' => 'croccante_is_aboutus_active',
			'priority' => 5,
		) )
	);
	/* About us title section */
	$wp_customize->add_setting('croccante_theme_options[_onepage_title_aboutus]', array(
        'default'    => __( 'About Us', 'croccante' ),
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_title_aboutus]', array(
        'label'      => __( 'Title', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_aboutus',
        'settings'   => 'croccante_theme_options[_onepage_title_aboutus]',
        'type'       => 'text',
		'active_callback' => 'croccante_is_aboutus_active',
		'priority' => 6,
    ) );
	/* About us subtitle section */
	$wp_customize->add_setting('croccante_theme_options[_onepage_subtitle_aboutus]', array(
        'default'    => __( 'Who We Are', 'croccante' ),
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_subtitle_aboutus]', array(
        'label'      => __( 'Subtitle', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_aboutus',
        'settings'   => 'croccante_theme_options[_onepage_subtitle_aboutus]',
        'type'       => 'text',
		'active_callback' => 'croccante_is_aboutus_active',
		'priority' => 7,
    ) );
	/* Title left or right */
	$wp_customize->add_setting('croccante_theme_options[_onepage_positiontitle_aboutus]', array(
        'default'    => 'left',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'croccante_sanitize_select',
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_positiontitle_aboutus]', array(
        'label'      => __( 'Title and subtitle position', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_aboutus',
        'settings'   => 'croccante_theme_options[_onepage_positiontitle_aboutus]',
        'type'       => 'select',
		'active_callback' => 'croccante_is_aboutus_active',
		'priority' => 7,
		'choices' => array(
			'left' => __( 'Left', 'croccante'),
			'right' => __( 'Right', 'croccante'),
		),
    ) );
	/* Title animation */
	$wp_customize->add_setting('croccante_theme_options[_onepage_titleanimation_aboutus]', array(
        'default'    => 'noanim',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'croccante_sanitize_select',
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_titleanimation_aboutus]', array(
        'label'      => __( 'Title animation', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_aboutus',
        'settings'   => 'croccante_theme_options[_onepage_titleanimation_aboutus]',
        'type'       => 'select',
		'active_callback' => 'croccante_is_aboutus_active',
		'priority' => 7,
		'choices' => array(
			'noanim' => __( 'No', 'croccante'),
			'crocanim' => __( 'Yes', 'croccante'),
		),
    ) );
	/* About us text */
	$wp_customize->add_setting('croccante_theme_options[_onepage_head_aboutus]', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Croccante_Customize_Heading(
		$wp_customize,
		'croccante_theme_options[_onepage_head_aboutus]',
		array(
			'settings'		=> 'croccante_theme_options[_onepage_head_aboutus]',
			'section'		=> 'cresta_croccante_onepage_section_aboutus',
			'label'			=> __( 'About us text', 'croccante' ),
			'active_callback' => 'croccante_is_aboutus_active',
			'priority' => 8,
		)
		)
	);
	/* Aboutus Dropdown pages */
	$wp_customize->add_setting('croccante_theme_options[_onepage_choosepage_aboutus]', array(
		'default'    => false,
		'type'       => 'option',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control('croccante_theme_options[_onepage_choosepage_aboutus]', array(
		'label'      => __( 'Choose the page to display', 'croccante' ),
		'description'	=> __( 'Title, content and featured image will be used in the box', 'croccante' ),
		'section'    => 'cresta_croccante_onepage_section_aboutus',
		'settings'   => 'croccante_theme_options[_onepage_choosepage_aboutus]',
		'type'       => 'dropdown-pages',
		'active_callback' => 'croccante_is_aboutus_active',
	) );
	/* About us button */
	$wp_customize->add_setting('croccante_theme_options[_onepage_headbutton_aboutus]', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Croccante_Customize_Heading(
		$wp_customize,
		'croccante_theme_options[_onepage_headbutton_aboutus]',
		array(
			'settings'		=> 'croccante_theme_options[_onepage_headbutton_aboutus]',
			'section'		=> 'cresta_croccante_onepage_section_aboutus',
			'label'			=> __( 'About us button', 'croccante' ),
			'active_callback' => 'croccante_is_aboutus_active',
			'priority' => 11,
		)
		)
	);
	/* About us text button */
	$wp_customize->add_setting('croccante_theme_options[_onepage_textbutton_aboutus]', array(
        'default'    => __('More Information', 'croccante'),
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_textbutton_aboutus]', array(
        'label'      => __( 'Text Button', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_aboutus',
        'settings'   => 'croccante_theme_options[_onepage_textbutton_aboutus]',
        'type'       => 'text',
		'active_callback' => 'croccante_is_aboutus_active',
		'priority' => 12,
    ) );
	/* About us link button */
	$wp_customize->add_setting('croccante_theme_options[_onepage_linkbutton_aboutus]', array(
        'default'    => '#',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_linkbutton_aboutus]', array(
        'label'      => __( 'Link Button', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_aboutus',
        'settings'   => 'croccante_theme_options[_onepage_linkbutton_aboutus]',
        'type'       => 'url',
		'active_callback' => 'croccante_is_aboutus_active',
		'priority' => 13,
    ) );
	/**
	* ################ SECTION FEATURES
	*/
	/* Show Features Section */
	$wp_customize->add_setting('croccante_theme_options[_onepage_section_features]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'croccante_sanitize_checkbox'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_section_features]', array(
        'label'      => __( 'Display section features', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_features',
        'settings'   => 'croccante_theme_options[_onepage_section_features]',
        'type'       => 'checkbox',
		'priority' => 1,
    ) );
	/* Section ID */
	$wp_customize->add_setting('croccante_theme_options[_onepage_id_features]', array(
        'default'    => 'features',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_id_features]', array(
        'label'      => __( 'Section ID name', 'croccante' ),
		'description'	=> __( 'ID for this section - if you want the user to be able to scroll down to this section.', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_features',
        'settings'   => 'croccante_theme_options[_onepage_id_features]',
		'active_callback' => 'croccante_is_features_active',
        'type'       => 'text',
		'priority' => 2,
    ) );
	/* Background Image Features */
	$wp_customize->add_setting('croccante_theme_options[_onepage_imgback_features]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw'
    ) );
	$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
		$wp_customize, 
		'croccante_theme_options[_onepage_imgback_features]', 
		array(
			'label'      => __( 'Background Image Section (optional)', 'croccante' ),
			'section'    => 'cresta_croccante_onepage_section_features',
			'settings'   => 'croccante_theme_options[_onepage_imgback_features]',
			'active_callback' => 'croccante_is_features_active',
			'priority' => 3,
		) ) 
	);
	/* Background Color Features */
	$wp_customize->add_setting( 'croccante_theme_options[_onepage_imgcolor_features]', array(
		'default' => '#404040',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'croccante_theme_options[_onepage_imgcolor_features]', 
		array(
			'label' => __( 'Background Color Section', 'croccante' ),
			'section' => 'cresta_croccante_onepage_section_features',
			'settings' =>'croccante_theme_options[_onepage_imgcolor_features]',
			'active_callback' => 'croccante_is_features_active',
			'priority' => 4,
		) )
	);
	/* Text Color Features */
	$wp_customize->add_setting( 'croccante_theme_options[_onepage_textcolor_features]', array(
		'default' => '#ffffff',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'croccante_theme_options[_onepage_textcolor_features]', 
		array(
			'label' => __( 'Text Color Section', 'croccante' ),
			'section' => 'cresta_croccante_onepage_section_features',
			'settings' =>'croccante_theme_options[_onepage_textcolor_features]',
			'active_callback' => 'croccante_is_features_active',
			'priority' => 5,
		) )
	);
	/* Features title section */
	$wp_customize->add_setting('croccante_theme_options[_onepage_title_features]', array(
        'default'    => __( 'Elements', 'croccante' ),
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_title_features]', array(
        'label'      => __( 'Title', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_features',
        'settings'   => 'croccante_theme_options[_onepage_title_features]',
        'type'       => 'text',
		'active_callback' => 'croccante_is_features_active',
		'priority' => 6,
    ) );
	/* Features subtitle section */
	$wp_customize->add_setting('croccante_theme_options[_onepage_subtitle_features]', array(
        'default'    => __( 'Amazing Features', 'croccante' ),
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_subtitle_features]', array(
        'label'      => __( 'Subtitle', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_features',
        'settings'   => 'croccante_theme_options[_onepage_subtitle_features]',
        'type'       => 'text',
		'active_callback' => 'croccante_is_features_active',
		'priority' => 7,
    ) );
	/* Title left or right */
	$wp_customize->add_setting('croccante_theme_options[_onepage_positiontitle_features]', array(
        'default'    => 'left',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'croccante_sanitize_select',
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_positiontitle_features]', array(
        'label'      => __( 'Title and subtitle position', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_features',
        'settings'   => 'croccante_theme_options[_onepage_positiontitle_features]',
        'type'       => 'select',
		'active_callback' => 'croccante_is_features_active',
		'priority' => 7,
		'choices' => array(
			'left' => __( 'Left', 'croccante'),
			'right' => __( 'Right', 'croccante'),
		),
    ) );
	/* Title animation */
	$wp_customize->add_setting('croccante_theme_options[_onepage_titleanimation_features]', array(
        'default'    => 'noanim',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'croccante_sanitize_select',
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_titleanimation_features]', array(
        'label'      => __( 'Title animation', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_features',
        'settings'   => 'croccante_theme_options[_onepage_titleanimation_features]',
        'type'       => 'select',
		'active_callback' => 'croccante_is_features_active',
		'priority' => 7,
		'choices' => array(
			'noanim' => __( 'No', 'croccante'),
			'crocanim' => __( 'Yes', 'croccante'),
		),
    ) );
	/* How many boxes to display */
	$wp_customize->add_setting('croccante_theme_options[_onepage_manybox_features]', array(
        'default'    => '3',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'croccante_sanitize_select',
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_manybox_features]', array(
        'label'      => __( 'How many boxes to display', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_features',
        'settings'   => 'croccante_theme_options[_onepage_manybox_features]',
        'type'       => 'select',
		'active_callback' => 'croccante_is_features_active',
		'priority' => 8,
		'choices' => array(
			'1' => __( '1', 'croccante'),
			'2' => __( '2', 'croccante'),
			'3' => __( '3', 'croccante'),
			'4' => __( '4', 'croccante'),
		),
    ) );
	/* Text lenght for boxes */
	$wp_customize->add_setting('croccante_theme_options[_onepage_lenght_features]', array(
        'default'    => '20',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'absint',
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_lenght_features]', array(
        'label'      => __( 'Text lenght for boxes content (number of words)', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_features',
        'settings'   => 'croccante_theme_options[_onepage_lenght_features]',
        'type'       => 'number',
		'active_callback' => 'croccante_is_features_active',
		'priority' => 9,
    ) );
	for( $number = 1; $number < 5; $number++ ){
		/* Box Title Description */
		$wp_customize->add_setting('croccante_theme_options[_onepage_head_'.$number.'_features]', array(
			'sanitize_callback' => 'sanitize_text_field',
			'type'       => 'option',
		));
		$wp_customize->add_control(
			new Croccante_Customize_Heading(
			$wp_customize,
			'croccante_theme_options[_onepage_head_'.$number.'_features]',
			array(
				'settings'		=> 'croccante_theme_options[_onepage_head_'.$number.'_features]',
				'section'		=> 'cresta_croccante_onepage_section_features',
				'label'			=> __( 'Box number ', 'croccante' ).$number,
				'active_callback' => 'croccante_is_features_active',
			))
		);
		/* FontAwesome Icon */
		$wp_customize->add_setting('croccante_theme_options[_onepage_fontawesome_'.$number.'_features]', array(
			'default'			=> 'fa fa-bell',
			'sanitize_callback' => 'sanitize_text_field',
			'type'       => 'option',
		));
		$wp_customize->add_control(
			new Croccante_Fontawesome_Icon(
			$wp_customize,
			'croccante_theme_options[_onepage_fontawesome_'.$number.'_features]',
			array(
				'settings'		=> 'croccante_theme_options[_onepage_fontawesome_'.$number.'_features]',
				'section'		=> 'cresta_croccante_onepage_section_features',
				'label'			=> __( 'FontAwesome Icon', 'croccante' ),
				'type'       => 'icon',
				'active_callback' => 'croccante_is_features_active',
			))
		);
		/* Features Dropdown pages */
		$wp_customize->add_setting('croccante_theme_options[_onepage_choosepage_'.$number.'_features]', array(
			'default'    => false,
			'type'       => 'option',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'absint',
		) );
		$wp_customize->add_control('croccante_theme_options[_onepage_choosepage_'.$number.'_features]', array(
			'label'      => __( 'Choose the page to display', 'croccante' ),
			'description'	=> __( 'Title and content (unformatted) will be used in the box', 'croccante' ),
			'section'    => 'cresta_croccante_onepage_section_features',
			'settings'   => 'croccante_theme_options[_onepage_choosepage_'.$number.'_features]',
			'type'       => 'dropdown-pages',
			'active_callback' => 'croccante_is_features_active',
		) );
		/* Features text button */
		$wp_customize->add_setting('croccante_theme_options[_onepage_boxtextbutton_'.$number.'_features]', array(
			'default'    => __( 'More Information', 'croccante' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage'
		) );
		$wp_customize->add_control('croccante_theme_options[_onepage_boxtextbutton_'.$number.'_features]', array(
			'label'      => __( 'Text Button ', 'croccante' ).$number,
			'section'    => 'cresta_croccante_onepage_section_features',
			'settings'   => 'croccante_theme_options[_onepage_boxtextbutton_'.$number.'_features]',
			'type'       => 'text',
			'active_callback' => 'croccante_is_features_active',
		) );
		/* Features link button */
		$wp_customize->add_setting('croccante_theme_options[_onepage_boxlinkbutton_'.$number.'_features]', array(
			'default'    => '#',
			'type'       => 'option',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw'
		) );
		$wp_customize->add_control('croccante_theme_options[_onepage_boxlinkbutton_'.$number.'_features]', array(
			'label'      => __( 'Link Button ', 'croccante' ).$number,
			'section'    => 'cresta_croccante_onepage_section_features',
			'settings'   => 'croccante_theme_options[_onepage_boxlinkbutton_'.$number.'_features]',
			'type'       => 'url',
			'active_callback' => 'croccante_is_features_active',
		) );
	}
	/**
	* ################ SECTION SKILLS
	*/
	/* Show Skills Section */
	$wp_customize->add_setting('croccante_theme_options[_onepage_section_skills]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'croccante_sanitize_checkbox'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_section_skills]', array(
        'label'      => __( 'Display section skills', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_skills',
        'settings'   => 'croccante_theme_options[_onepage_section_skills]',
        'type'       => 'checkbox',
		'priority' => 1,
    ) );
	/* Section ID */
	$wp_customize->add_setting('croccante_theme_options[_onepage_id_skills]', array(
        'default'    => 'skills',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_id_skills]', array(
        'label'      => __( 'Section ID name', 'croccante' ),
		'description'	=> __( 'ID for this section - if you want the user to be able to scroll down to this section.', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_skills',
        'settings'   => 'croccante_theme_options[_onepage_id_skills]',
		'active_callback' => 'croccante_is_skills_active',
        'type'       => 'text',
		'priority' => 2,
    ) );
	/* Background Image Skills */
	$wp_customize->add_setting('croccante_theme_options[_onepage_imgback_skills]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw'
    ) );
	$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
		$wp_customize, 
		'croccante_theme_options[_onepage_imgback_skills]', 
		array(
			'label'      => __( 'Background Image Section (optional)', 'croccante' ),
			'section'    => 'cresta_croccante_onepage_section_skills',
			'settings'   => 'croccante_theme_options[_onepage_imgback_skills]',
			'active_callback' => 'croccante_is_skills_active',
			'priority' => 3,
		) ) 
	);
	/* Background Color Features */
	$wp_customize->add_setting( 'croccante_theme_options[_onepage_imgcolor_skills]', array(
		'default' => '#ffffff',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'croccante_theme_options[_onepage_imgcolor_skills]', 
		array(
			'label' => __( 'Background Color Section', 'croccante' ),
			'section' => 'cresta_croccante_onepage_section_skills',
			'settings' =>'croccante_theme_options[_onepage_imgcolor_skills]',
			'active_callback' => 'croccante_is_skills_active',
			'priority' => 4,
		) )
	);
	/* Text Color Features */
	$wp_customize->add_setting( 'croccante_theme_options[_onepage_textcolor_skills]', array(
		'default' => '#404040',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'croccante_theme_options[_onepage_textcolor_skills]', 
		array(
			'label' => __( 'Text Color Section', 'croccante' ),
			'section' => 'cresta_croccante_onepage_section_skills',
			'settings' =>'croccante_theme_options[_onepage_textcolor_skills]',
			'active_callback' => 'croccante_is_skills_active',
			'priority' => 5,
		) )
	);
	/* Features title section */
	$wp_customize->add_setting('croccante_theme_options[_onepage_title_skills]', array(
        'default'    => __( 'Our Skills', 'croccante' ),
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_title_skills]', array(
        'label'      => __( 'Title', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_skills',
        'settings'   => 'croccante_theme_options[_onepage_title_skills]',
        'type'       => 'text',
		'active_callback' => 'croccante_is_skills_active',
		'priority' => 6,
    ) );
	/* Features subtitle section */
	$wp_customize->add_setting('croccante_theme_options[_onepage_subtitle_skills]', array(
        'default'    => __( 'What We Do', 'croccante' ),
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_subtitle_skills]', array(
        'label'      => __( 'Subtitle', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_skills',
        'settings'   => 'croccante_theme_options[_onepage_subtitle_skills]',
        'type'       => 'text',
		'active_callback' => 'croccante_is_skills_active',
		'priority' => 7,
    ) );
	/* Title left or right */
	$wp_customize->add_setting('croccante_theme_options[_onepage_positiontitle_skills]', array(
        'default'    => 'left',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'croccante_sanitize_select',
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_positiontitle_skills]', array(
        'label'      => __( 'Title and subtitle position', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_skills',
        'settings'   => 'croccante_theme_options[_onepage_positiontitle_skills]',
        'type'       => 'select',
		'active_callback' => 'croccante_is_skills_active',
		'priority' => 7,
		'choices' => array(
			'left' => __( 'Left', 'croccante'),
			'right' => __( 'Right', 'croccante'),
		),
    ) );
	/* Title animation */
	$wp_customize->add_setting('croccante_theme_options[_onepage_titleanimation_skills]', array(
        'default'    => 'noanim',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'croccante_sanitize_select',
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_titleanimation_skills]', array(
        'label'      => __( 'Title animation', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_skills',
        'settings'   => 'croccante_theme_options[_onepage_titleanimation_skills]',
        'type'       => 'select',
		'active_callback' => 'croccante_is_skills_active',
		'priority' => 7,
		'choices' => array(
			'noanim' => __( 'No', 'croccante'),
			'crocanim' => __( 'Yes', 'croccante'),
		),
    ) );
	for( $number = 1; $number < 11; $number++ ){
		/* Box Title Description */
		$wp_customize->add_setting('croccante_theme_options[_onepage_head_'.$number.'_skills]', array(
			'sanitize_callback' => 'sanitize_text_field',
			'type'       => 'option',
		));
		$wp_customize->add_control(
			new Croccante_Customize_Heading(
			$wp_customize,
			'croccante_theme_options[_onepage_head_'.$number.'_skills]',
			array(
				'settings'		=> 'croccante_theme_options[_onepage_head_'.$number.'_skills]',
				'section'		=> 'cresta_croccante_onepage_section_skills',
				'label'			=> __( 'Skill number ', 'croccante' ).$number,
				'active_callback' => 'croccante_is_skills_active',
			))
		);
		/* Skill Name */
		$wp_customize->add_setting('croccante_theme_options[_onepage_skillname_'.$number.'_skills]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control('croccante_theme_options[_onepage_skillname_'.$number.'_skills]', array(
			'label'      => __( 'Skill name', 'croccante' ),
			'section'    => 'cresta_croccante_onepage_section_skills',
			'settings'   => 'croccante_theme_options[_onepage_skillname_'.$number.'_skills]',
			'active_callback' => 'croccante_is_skills_active',
			'type'       => 'text',
		) );
		/* Skill Value */
		$wp_customize->add_setting('croccante_theme_options[_onepage_skillvalue_'.$number.'_skills]', array(
			'default'    => '0',
			'type'       => 'option',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'absint'
		) );
		$wp_customize->add_control('croccante_theme_options[_onepage_skillvalue_'.$number.'_skills]', array(
			'label'      => __( 'Skill value', 'croccante' ),
			'description'	=> __( 'Enter a value between 0 and 100', 'croccante' ),
			'section'    => 'cresta_croccante_onepage_section_skills',
			'settings'   => 'croccante_theme_options[_onepage_skillvalue_'.$number.'_skills]',
			'active_callback' => 'croccante_is_skills_active',
			'type'       => 'number',
		) );
	}
	/**
	* ################ SECTION CALL TO ACTION
	*/
	/* Show Cta Section */
	$wp_customize->add_setting('croccante_theme_options[_onepage_section_cta]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'croccante_sanitize_checkbox'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_section_cta]', array(
        'label'      => __( 'Display section call to action', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_cta',
        'settings'   => 'croccante_theme_options[_onepage_section_cta]',
        'type'       => 'checkbox',
		'priority' => 1,
    ) );
	/* Section ID */
	$wp_customize->add_setting('croccante_theme_options[_onepage_id_cta]', array(
        'default'    => 'cta',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_id_cta]', array(
        'label'      => __( 'Section ID name', 'croccante' ),
		'description'	=> __( 'ID for this section - if you want the user to be able to scroll down to this section.', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_cta',
        'settings'   => 'croccante_theme_options[_onepage_id_cta]',
		'active_callback' => 'croccante_is_cta_active',
        'type'       => 'text',
		'priority' => 2,
    ) );
	/* Background Image Cta */
	$wp_customize->add_setting('croccante_theme_options[_onepage_imgback_cta]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw'
    ) );
	$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
		$wp_customize, 
		'croccante_theme_options[_onepage_imgback_cta]', 
		array(
			'label'      => __( 'Background Image Section (optional)', 'croccante' ),
			'section'    => 'cresta_croccante_onepage_section_cta',
			'settings'   => 'croccante_theme_options[_onepage_imgback_cta]',
			'active_callback' => 'croccante_is_cta_active',
			'priority' => 3,
		) ) 
	);
	/* Background Color Cta */
	$wp_customize->add_setting( 'croccante_theme_options[_onepage_imgcolor_cta]', array(
		'default' => '#404040',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'croccante_theme_options[_onepage_imgcolor_cta]', 
		array(
			'label' => __( 'Background Color Section', 'croccante' ),
			'section' => 'cresta_croccante_onepage_section_cta',
			'settings' =>'croccante_theme_options[_onepage_imgcolor_cta]',
			'active_callback' => 'croccante_is_cta_active',
			'priority' => 4,
		) )
	);
	/* Text Color Cta */
	$wp_customize->add_setting( 'croccante_theme_options[_onepage_textcolor_cta]', array(
		'default' => '#ffffff',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'croccante_theme_options[_onepage_textcolor_cta]', 
		array(
			'label' => __( 'Text Color Section', 'croccante' ),
			'section' => 'cresta_croccante_onepage_section_cta',
			'settings' =>'croccante_theme_options[_onepage_textcolor_cta]',
			'active_callback' => 'croccante_is_cta_active',
			'priority' => 5,
		) )
	);
	/* FontAwesome Icon */
	$wp_customize->add_setting('croccante_theme_options[_onepage_fontawesome_cta]', array(
		'default'			=> 'fa fa-flash',
		'sanitize_callback' => 'sanitize_text_field',
		'type' => 'option', 
	));
	$wp_customize->add_control(
		new Croccante_Fontawesome_Icon(
		$wp_customize,
		'croccante_theme_options[_onepage_fontawesome_cta]',
		array(
			'settings'		=> 'croccante_theme_options[_onepage_fontawesome_cta]',
			'section'		=> 'cresta_croccante_onepage_section_cta',
			'label'			=> __( 'FontAwesome Icon', 'croccante' ),
			'type'       => 'icon',
			'active_callback' => 'croccante_is_cta_active',
			'priority' => 6,
		))
	);
	/* Call to action phrase */
	$wp_customize->add_setting('croccante_theme_options[_onepage_phrase_cta]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_phrase_cta]', array(
        'label'      => __( 'Call to action phrase', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_cta',
        'settings'   => 'croccante_theme_options[_onepage_phrase_cta]',
		'active_callback' => 'croccante_is_cta_active',
        'type'       => 'text',
		'priority' => 7,
    ) );
	/* Call to action description */
	$wp_customize->add_setting('croccante_theme_options[_onepage_desc_cta]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_desc_cta]', array(
        'label'      => __( 'Call to action description', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_cta',
        'settings'   => 'croccante_theme_options[_onepage_desc_cta]',
		'active_callback' => 'croccante_is_cta_active',
        'type'       => 'text',
		'priority' => 8,
    ) );
	/* Call to action text button */
	$wp_customize->add_setting('croccante_theme_options[_onepage_textbutton_cta]', array(
        'default'    => __( 'More Information', 'croccante' ),
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_textbutton_cta]', array(
        'label'      => __( 'Text Button', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_cta',
        'settings'   => 'croccante_theme_options[_onepage_textbutton_cta]',
        'type'       => 'text',
		'active_callback' => 'croccante_is_cta_active',
		'priority' => 9,
    ) );
	/* Call to action link button */
	$wp_customize->add_setting('croccante_theme_options[_onepage_urlbutton_cta]', array(
        'default'    => '#',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_urlbutton_cta]', array(
        'label'      => __( 'Link Button', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_cta',
        'settings'   => 'croccante_theme_options[_onepage_urlbutton_cta]',
        'type'       => 'url',
		'active_callback' => 'croccante_is_cta_active',
		'priority' => 10,
    ) );
	/* Open the link in */
	$wp_customize->add_setting('croccante_theme_options[_onepage_openurl_cta]', array(
        'default'    => '_blank',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'croccante_sanitize_select',
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_openurl_cta]', array(
        'label'      => __( 'Open the link in', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_cta',
        'settings'   => 'croccante_theme_options[_onepage_openurl_cta]',
        'type'       => 'select',
		'active_callback' => 'croccante_is_cta_active',
		'priority' => 11,
		'choices' => array(
			'_self' => __( 'Same window', 'croccante'),
			'_blank' => __( 'New window', 'croccante'),
		),
    ) );
	/**
	* ################ SECTION SERVICES
	*/
	/* Show Services Section */
	$wp_customize->add_setting('croccante_theme_options[_onepage_section_services]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'croccante_sanitize_checkbox'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_section_services]', array(
        'label'      => __( 'Display section services', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_services',
        'settings'   => 'croccante_theme_options[_onepage_section_services]',
        'type'       => 'checkbox',
		'priority' => 1,
    ) );
	/* Section ID */
	$wp_customize->add_setting('croccante_theme_options[_onepage_id_services]', array(
        'default'    => 'services',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_id_services]', array(
        'label'      => __( 'Section ID name', 'croccante' ),
		'description'	=> __( 'ID for this section - if you want the user to be able to scroll down to this section.', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_services',
        'settings'   => 'croccante_theme_options[_onepage_id_services]',
		'active_callback' => 'croccante_is_services_active',
        'type'       => 'text',
		'priority' => 2,
    ) );
	/* Background Image Services */
	$wp_customize->add_setting('croccante_theme_options[_onepage_imgback_services]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw'
    ) );
	$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
		$wp_customize, 
		'croccante_theme_options[_onepage_imgback_services]', 
		array(
			'label'      => __( 'Background Image Section (optional)', 'croccante' ),
			'section'    => 'cresta_croccante_onepage_section_services',
			'settings'   => 'croccante_theme_options[_onepage_imgback_services]',
			'active_callback' => 'croccante_is_services_active',
			'priority' => 3,
		) ) 
	);
	/* Background Color Services */
	$wp_customize->add_setting( 'croccante_theme_options[_onepage_imgcolor_services]', array(
		'default' => '#ffffff',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'croccante_theme_options[_onepage_imgcolor_services]', 
		array(
			'label' => __( 'Background Color Section', 'croccante' ),
			'section' => 'cresta_croccante_onepage_section_services',
			'settings' =>'croccante_theme_options[_onepage_imgcolor_services]',
			'active_callback' => 'croccante_is_services_active',
			'priority' => 4,
		) )
	);
	/* Text Color Services */
	$wp_customize->add_setting( 'croccante_theme_options[_onepage_textcolor_services]', array(
		'default' => '#404040',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'croccante_theme_options[_onepage_textcolor_services]', 
		array(
			'label' => __( 'Text Color Section', 'croccante' ),
			'section' => 'cresta_croccante_onepage_section_services',
			'settings' =>'croccante_theme_options[_onepage_textcolor_services]',
			'active_callback' => 'croccante_is_services_active',
			'priority' => 5,
		) )
	);
	/* Services title section */
	$wp_customize->add_setting('croccante_theme_options[_onepage_title_services]', array(
        'default'    => __( 'Services', 'croccante' ),
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_title_services]', array(
        'label'      => __( 'Title', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_services',
        'settings'   => 'croccante_theme_options[_onepage_title_services]',
        'type'       => 'text',
		'active_callback' => 'croccante_is_services_active',
		'priority' => 6,
    ) );
	/* Services subtitle section */
	$wp_customize->add_setting('croccante_theme_options[_onepage_subtitle_services]', array(
        'default'    => __( 'What We Offer', 'croccante' ),
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_subtitle_services]', array(
        'label'      => __( 'Subtitle', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_services',
        'settings'   => 'croccante_theme_options[_onepage_subtitle_services]',
        'type'       => 'text',
		'active_callback' => 'croccante_is_services_active',
		'priority' => 7,
    ) );
	/* Title left or right */
	$wp_customize->add_setting('croccante_theme_options[_onepage_positiontitle_services]', array(
        'default'    => 'left',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'croccante_sanitize_select',
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_positiontitle_services]', array(
        'label'      => __( 'Title and subtitle position', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_services',
        'settings'   => 'croccante_theme_options[_onepage_positiontitle_services]',
        'type'       => 'select',
		'active_callback' => 'croccante_is_services_active',
		'priority' => 7,
		'choices' => array(
			'left' => __( 'Left', 'croccante'),
			'right' => __( 'Right', 'croccante'),
		),
    ) );
	/* Title animation */
	$wp_customize->add_setting('croccante_theme_options[_onepage_titleanimation_services]', array(
        'default'    => 'noanim',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'croccante_sanitize_select',
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_titleanimation_services]', array(
        'label'      => __( 'Title animation', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_services',
        'settings'   => 'croccante_theme_options[_onepage_titleanimation_services]',
        'type'       => 'select',
		'active_callback' => 'croccante_is_services_active',
		'priority' => 7,
		'choices' => array(
			'noanim' => __( 'No', 'croccante'),
			'crocanim' => __( 'Yes', 'croccante'),
		),
    ) );
	/* Text lenght for services */
	$wp_customize->add_setting('croccante_theme_options[_onepage_lenght_services]', array(
        'default'    => '30',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'absint',
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_lenght_services]', array(
        'label'      => __( 'Text lenght for boxes content (number of words)', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_services',
        'settings'   => 'croccante_theme_options[_onepage_lenght_services]',
        'type'       => 'number',
		'active_callback' => 'croccante_is_services_active',
		'priority' => 9,
    ) );
	for( $number = 1; $number < 7; $number++ ){
		/* Box Title Description */
		$wp_customize->add_setting('croccante_theme_options[_onepage_head_'.$number.'_services]', array(
			'sanitize_callback' => 'sanitize_text_field',
			'type'       => 'option',
		));
		$wp_customize->add_control(
			new Croccante_Customize_Heading(
			$wp_customize,
			'croccante_theme_options[_onepage_head_'.$number.'_services]',
			array(
				'settings'		=> 'croccante_theme_options[_onepage_head_'.$number.'_services]',
				'section'		=> 'cresta_croccante_onepage_section_services',
				'label'			=> __( 'Service number ', 'croccante' ).$number,
				'active_callback' => 'croccante_is_services_active',
			))
		);
		/* FontAwesome Icon */
		$wp_customize->add_setting('croccante_theme_options[_onepage_fontawesome_'.$number.'_services]', array(
			'default'			=> 'fa fa-bell',
			'sanitize_callback' => 'sanitize_text_field',
			'type'       => 'option',
		));
		$wp_customize->add_control(
			new Croccante_Fontawesome_Icon(
			$wp_customize,
			'croccante_theme_options[_onepage_fontawesome_'.$number.'_services]',
			array(
				'settings'		=> 'croccante_theme_options[_onepage_fontawesome_'.$number.'_services]',
				'section'		=> 'cresta_croccante_onepage_section_services',
				'label'			=> __( 'FontAwesome Icon', 'croccante' ),
				'type'       => 'icon',
				'active_callback' => 'croccante_is_services_active',
			))
		);
		/* Services Dropdown pages */
		$wp_customize->add_setting('croccante_theme_options[_onepage_choosepage_'.$number.'_services]', array(
			'default'    => false,
			'type'       => 'option',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'absint',
		) );
		$wp_customize->add_control('croccante_theme_options[_onepage_choosepage_'.$number.'_services]', array(
			'label'      => __( 'Choose the page to display', 'croccante' ),
			'description'	=> __( 'Title and content (unformatted) will be used in the box', 'croccante' ),
			'section'    => 'cresta_croccante_onepage_section_services',
			'settings'   => 'croccante_theme_options[_onepage_choosepage_'.$number.'_services]',
			'type'       => 'dropdown-pages',
			'active_callback' => 'croccante_is_services_active',
		) );
	}
	/* Services text */
	$wp_customize->add_setting('croccante_theme_options[_onepage_headtext_services]', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Croccante_Customize_Heading(
		$wp_customize,
		'croccante_theme_options[_onepage_headtext_services]',
		array(
			'settings'		=> 'croccante_theme_options[_onepage_headtext_services]',
			'section'		=> 'cresta_croccante_onepage_section_services',
			'label'			=> __( 'Services text', 'croccante' ),
			'active_callback' => 'croccante_is_services_active',
			'priority' => 15,
		))
	);
	/* Services phrase section */
	$wp_customize->add_setting('croccante_theme_options[_onepage_phrase_services]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_phrase_services]', array(
        'label'      => __( 'Phrase', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_services',
        'settings'   => 'croccante_theme_options[_onepage_phrase_services]',
        'type'       => 'text',
		'active_callback' => 'croccante_is_services_active',
		'priority' => 16,
    ) );
	/* Services textarea section */
	$wp_customize->add_setting('croccante_theme_options[_onepage_textarea_services]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'croccante_sanitize_text',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_textarea_services]', array(
        'label'      => __( 'Textarea', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_services',
        'settings'   => 'croccante_theme_options[_onepage_textarea_services]',
        'type'       => 'textarea',
		'active_callback' => 'croccante_is_services_active',
		'priority' => 17,
    ) );
	/* Services image */
	$wp_customize->add_setting('croccante_theme_options[_onepage_headimage_services]', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Croccante_Customize_Heading(
		$wp_customize,
		'croccante_theme_options[_onepage_headimage_services]',
		array(
			'settings'		=> 'croccante_theme_options[_onepage_headimage_services]',
			'section'		=> 'cresta_croccante_onepage_section_services',
			'label'			=> __( 'Services image', 'croccante' ),
			'active_callback' => 'croccante_is_services_active',
			'priority' => 18,
		)
		)
	);
	/* Upload Image Services */
	$wp_customize->add_setting('croccante_theme_options[_onepage_servimage_services]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw'
    ) );
	$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
		$wp_customize, 
		'croccante_theme_options[_onepage_servimage_services]', 
		array(
			'label'      => __( 'Upload Image', 'croccante' ),
			'description'	=> __( 'Recommended image size: 1000X600px.', 'croccante' ),
			'section'    => 'cresta_croccante_onepage_section_services',
			'settings'   => 'croccante_theme_options[_onepage_servimage_services]',
			'active_callback' => 'croccante_is_services_active',
			'priority' => 19,
		) ) 
	);
	/**
	* ################ SECTION BLOG
	*/
	/* Show Blog Section */
	$wp_customize->add_setting('croccante_theme_options[_onepage_section_blog]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'croccante_sanitize_checkbox'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_section_blog]', array(
        'label'      => __( 'Display section blog', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_blog',
        'settings'   => 'croccante_theme_options[_onepage_section_blog]',
        'type'       => 'checkbox',
		'priority' => 1,
    ) );
	/* Section ID */
	$wp_customize->add_setting('croccante_theme_options[_onepage_id_blog]', array(
        'default'    => 'blog',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_id_blog]', array(
        'label'      => __( 'Section ID name', 'croccante' ),
		'description'	=> __( 'ID for this section - if you want the user to be able to scroll down to this section.', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_blog',
        'settings'   => 'croccante_theme_options[_onepage_id_blog]',
		'active_callback' => 'croccante_is_blog_active',
        'type'       => 'text',
		'priority' => 2,
    ) );
	/* Background Image Blog */
	$wp_customize->add_setting('croccante_theme_options[_onepage_imgback_blog]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw'
    ) );
	$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
		$wp_customize, 
		'croccante_theme_options[_onepage_imgback_blog]', 
		array(
			'label'      => __( 'Background Image Section (optional)', 'croccante' ),
			'section'    => 'cresta_croccante_onepage_section_blog',
			'settings'   => 'croccante_theme_options[_onepage_imgback_blog]',
			'active_callback' => 'croccante_is_blog_active',
			'priority' => 3,
		) ) 
	);
	/* Background Color Blog */
	$wp_customize->add_setting( 'croccante_theme_options[_onepage_imgcolor_blog]', array(
		'default' => '#ffffff',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'croccante_theme_options[_onepage_imgcolor_blog]', 
		array(
			'label' => __( 'Background Color Section', 'croccante' ),
			'section' => 'cresta_croccante_onepage_section_blog',
			'settings' =>'croccante_theme_options[_onepage_imgcolor_blog]',
			'active_callback' => 'croccante_is_blog_active',
			'priority' => 4,
		) )
	);
	/* Text Color Blog */
	$wp_customize->add_setting( 'croccante_theme_options[_onepage_textcolor_blog]', array(
		'default' => '#404040',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'croccante_theme_options[_onepage_textcolor_blog]', 
		array(
			'label' => __( 'Text Color Section', 'croccante' ),
			'section' => 'cresta_croccante_onepage_section_blog',
			'settings' =>'croccante_theme_options[_onepage_textcolor_blog]',
			'active_callback' => 'croccante_is_blog_active',
			'priority' => 5,
		) )
	);
	/* Blog title section */
	$wp_customize->add_setting('croccante_theme_options[_onepage_title_blog]', array(
        'default'    => __( 'News', 'croccante' ),
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_title_blog]', array(
        'label'      => __( 'Title', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_blog',
        'settings'   => 'croccante_theme_options[_onepage_title_blog]',
        'type'       => 'text',
		'active_callback' => 'croccante_is_blog_active',
		'priority' => 6,
    ) );
	/* Blog subtitle section */
	$wp_customize->add_setting('croccante_theme_options[_onepage_subtitle_blog]', array(
        'default'    => __( 'Latest Posts', 'croccante' ),
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_subtitle_blog]', array(
        'label'      => __( 'Subtitle', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_blog',
        'settings'   => 'croccante_theme_options[_onepage_subtitle_blog]',
        'type'       => 'text',
		'active_callback' => 'croccante_is_blog_active',
		'priority' => 7,
    ) );
	/* Title left or right */
	$wp_customize->add_setting('croccante_theme_options[_onepage_positiontitle_blog]', array(
        'default'    => 'left',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'croccante_sanitize_select',
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_positiontitle_blog]', array(
        'label'      => __( 'Title and subtitle position', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_blog',
        'settings'   => 'croccante_theme_options[_onepage_positiontitle_blog]',
        'type'       => 'select',
		'active_callback' => 'croccante_is_blog_active',
		'priority' => 7,
		'choices' => array(
			'left' => __( 'Left', 'croccante'),
			'right' => __( 'Right', 'croccante'),
		),
    ) );
	/* Title animation */
	$wp_customize->add_setting('croccante_theme_options[_onepage_titleanimation_blog]', array(
        'default'    => 'noanim',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'croccante_sanitize_select',
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_titleanimation_blog]', array(
        'label'      => __( 'Title animation', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_blog',
        'settings'   => 'croccante_theme_options[_onepage_titleanimation_blog]',
        'type'       => 'select',
		'active_callback' => 'croccante_is_blog_active',
		'priority' => 7,
		'choices' => array(
			'noanim' => __( 'No', 'croccante'),
			'crocanim' => __( 'Yes', 'croccante'),
		),
    ) );
	/* Number of posts to show */
	$wp_customize->add_setting('croccante_theme_options[_onepage_noposts_blog]', array(
		'default'    => '3',
		'type'       => 'option',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'absint'
	) );
	$wp_customize->add_control('croccante_theme_options[_onepage_noposts_blog]', array(
		'label'      => __( 'Number of posts to show', 'croccante' ),
		'section'    => 'cresta_croccante_onepage_section_blog',
		'settings'   => 'croccante_theme_options[_onepage_noposts_blog]',
		'active_callback' => 'croccante_is_blog_active',
		'type'       => 'number',
		'priority' => 8,
	) );
	/* Text lenght for blog posts */
	$wp_customize->add_setting('croccante_theme_options[_onepage_lenght_blog]', array(
        'default'    => '20',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'absint',
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_lenght_blog]', array(
        'label'      => __( 'Text lenght for blog posts (number of words)', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_blog',
        'settings'   => 'croccante_theme_options[_onepage_lenght_blog]',
        'type'       => 'number',
		'active_callback' => 'croccante_is_blog_active',
		'priority' => 8,
    ) );
	/* Text Blog Button */
	$wp_customize->add_setting('croccante_theme_options[_onepage_textbutton_blog]', array(
        'default'    => __( 'Go to the blog!', 'croccante' ),
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_textbutton_blog]', array(
        'label'      => __( 'Text blog button', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_blog',
        'settings'   => 'croccante_theme_options[_onepage_textbutton_blog]',
        'type'       => 'text',
		'active_callback' => 'croccante_is_blog_active',
		'priority' => 9,
    ) );
	/* Link blog button */
	$wp_customize->add_setting('croccante_theme_options[_onepage_linkbutton_blog]', array(
        'default'    => '#',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_linkbutton_blog]', array(
        'label'      => __( 'Link Blog Button', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_blog',
        'settings'   => 'croccante_theme_options[_onepage_linkbutton_blog]',
        'type'       => 'url',
		'active_callback' => 'croccante_is_blog_active',
		'priority' => 10,
    ) );
	/**
	* ################ SECTION TEAM
	*/
	/* Show Team Section */
	$wp_customize->add_setting('croccante_theme_options[_onepage_section_team]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'croccante_sanitize_checkbox'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_section_team]', array(
        'label'      => __( 'Display section team', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_team',
        'settings'   => 'croccante_theme_options[_onepage_section_team]',
        'type'       => 'checkbox',
		'priority' => 1,
    ) );
	/* Section ID */
	$wp_customize->add_setting('croccante_theme_options[_onepage_id_team]', array(
        'default'    => 'team',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_id_team]', array(
        'label'      => __( 'Section ID name', 'croccante' ),
		'description'	=> __( 'ID for this section - if you want the user to be able to scroll down to this section.', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_team',
        'settings'   => 'croccante_theme_options[_onepage_id_team]',
		'active_callback' => 'croccante_is_team_active',
        'type'       => 'text',
		'priority' => 2,
    ) );
	/* Background Image Team */
	$wp_customize->add_setting('croccante_theme_options[_onepage_imgback_team]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw'
    ) );
	$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
		$wp_customize, 
		'croccante_theme_options[_onepage_imgback_team]', 
		array(
			'label'      => __( 'Background Image Section (optional)', 'croccante' ),
			'section'    => 'cresta_croccante_onepage_section_team',
			'settings'   => 'croccante_theme_options[_onepage_imgback_team]',
			'active_callback' => 'croccante_is_team_active',
			'priority' => 3,
		) ) 
	);
	/* Background Color Blog */
	$wp_customize->add_setting( 'croccante_theme_options[_onepage_imgcolor_team]', array(
		'default' => '#f7f7f7',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'croccante_theme_options[_onepage_imgcolor_team]', 
		array(
			'label' => __( 'Background Color Section', 'croccante' ),
			'section' => 'cresta_croccante_onepage_section_team',
			'settings' =>'croccante_theme_options[_onepage_imgcolor_team]',
			'active_callback' => 'croccante_is_team_active',
			'priority' => 4,
		) )
	);
	/* Text Color Blog */
	$wp_customize->add_setting( 'croccante_theme_options[_onepage_textcolor_team]', array(
		'default' => '#404040',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'croccante_theme_options[_onepage_textcolor_team]', 
		array(
			'label' => __( 'Text Color Section', 'croccante' ),
			'section' => 'cresta_croccante_onepage_section_team',
			'settings' =>'croccante_theme_options[_onepage_textcolor_team]',
			'active_callback' => 'croccante_is_team_active',
			'priority' => 5,
		) )
	);
	/* Team title section */
	$wp_customize->add_setting('croccante_theme_options[_onepage_title_team]', array(
        'default'    => __( 'Our Team', 'croccante' ),
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_title_team]', array(
        'label'      => __( 'Title', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_team',
        'settings'   => 'croccante_theme_options[_onepage_title_team]',
        'type'       => 'text',
		'active_callback' => 'croccante_is_team_active',
		'priority' => 6,
    ) );
	/* Team subtitle section */
	$wp_customize->add_setting('croccante_theme_options[_onepage_subtitle_team]', array(
        'default'    => __( 'Nice to meet you', 'croccante' ),
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_subtitle_team]', array(
        'label'      => __( 'Subtitle', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_team',
        'settings'   => 'croccante_theme_options[_onepage_subtitle_team]',
        'type'       => 'text',
		'active_callback' => 'croccante_is_team_active',
		'priority' => 7,
    ) );
	/* Title left or right */
	$wp_customize->add_setting('croccante_theme_options[_onepage_positiontitle_team]', array(
        'default'    => 'left',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'croccante_sanitize_select',
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_positiontitle_team]', array(
        'label'      => __( 'Title and subtitle position', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_team',
        'settings'   => 'croccante_theme_options[_onepage_positiontitle_team]',
        'type'       => 'select',
		'active_callback' => 'croccante_is_team_active',
		'priority' => 7,
		'choices' => array(
			'left' => __( 'Left', 'croccante'),
			'right' => __( 'Right', 'croccante'),
		),
    ) );
	/* Title animation */
	$wp_customize->add_setting('croccante_theme_options[_onepage_titleanimation_team]', array(
        'default'    => 'noanim',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'croccante_sanitize_select',
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_titleanimation_team]', array(
        'label'      => __( 'Title animation', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_team',
        'settings'   => 'croccante_theme_options[_onepage_titleanimation_team]',
        'type'       => 'select',
		'active_callback' => 'croccante_is_team_active',
		'priority' => 7,
		'choices' => array(
			'noanim' => __( 'No', 'croccante'),
			'crocanim' => __( 'Yes', 'croccante'),
		),
    ) );
	/* Text lenght for team */
	$wp_customize->add_setting('croccante_theme_options[_onepage_lenght_team]', array(
        'default'    => '50',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'absint',
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_lenght_team]', array(
        'label'      => __( 'Text lenght for team content (number of words)', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_team',
        'settings'   => 'croccante_theme_options[_onepage_lenght_team]',
        'type'       => 'number',
		'active_callback' => 'croccante_is_team_active',
		'priority' => 7,
    ) );
	for( $number = 1; $number < 7; $number++ ){
		/* Box Title Description */
		$wp_customize->add_setting('croccante_theme_options[_onepage_head_'.$number.'_team]', array(
			'sanitize_callback' => 'sanitize_text_field',
			'type'       => 'option',
		));
		$wp_customize->add_control(
			new Croccante_Customize_Heading(
			$wp_customize,
			'croccante_theme_options[_onepage_head_'.$number.'_team]',
			array(
				'settings'		=> 'croccante_theme_options[_onepage_head_'.$number.'_team]',
				'section'		=> 'cresta_croccante_onepage_section_team',
				'label'			=> __( 'Person number ', 'croccante' ).$number,
				'active_callback' => 'croccante_is_team_active',
			))
		);
		/* Team Dropdown pages */
		$wp_customize->add_setting('croccante_theme_options[_onepage_choosepage_'.$number.'_team]', array(
			'default'    => false,
			'type'       => 'option',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'absint',
		) );
		$wp_customize->add_control('croccante_theme_options[_onepage_choosepage_'.$number.'_team]', array(
			'label'      => __( 'Choose the page to display', 'croccante' ),
			'description'	=> __( 'Featured Image, title and content will be used in the box', 'croccante' ),
			'section'    => 'cresta_croccante_onepage_section_team',
			'settings'   => 'croccante_theme_options[_onepage_choosepage_'.$number.'_team]',
			'type'       => 'dropdown-pages',
			'active_callback' => 'croccante_is_team_active',
		) );
	}
	/**
	* ################ SECTION CONTACT
	*/
	/* Show Contact Section */
	$wp_customize->add_setting('croccante_theme_options[_onepage_section_contact]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'croccante_sanitize_checkbox'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_section_contact]', array(
        'label'      => __( 'Display section contact', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_contact',
        'settings'   => 'croccante_theme_options[_onepage_section_contact]',
        'type'       => 'checkbox',
		'priority' => 1,
    ) );
	/* Section ID */
	$wp_customize->add_setting('croccante_theme_options[_onepage_id_contact]', array(
        'default'    => 'contact',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_id_contact]', array(
        'label'      => __( 'Section ID name', 'croccante' ),
		'description'	=> __( 'ID for this section - if you want the user to be able to scroll down to this section.', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_contact',
        'settings'   => 'croccante_theme_options[_onepage_id_contact]',
		'active_callback' => 'croccante_is_contact_active',
        'type'       => 'text',
		'priority' => 2,
    ) );
	/* Background Image Contact */
	$wp_customize->add_setting('croccante_theme_options[_onepage_imgback_contact]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw'
    ) );
	$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
		$wp_customize, 
		'croccante_theme_options[_onepage_imgback_contact]', 
		array(
			'label'      => __( 'Background Image Section (optional)', 'croccante' ),
			'section'    => 'cresta_croccante_onepage_section_contact',
			'settings'   => 'croccante_theme_options[_onepage_imgback_contact]',
			'active_callback' => 'croccante_is_contact_active',
			'priority' => 3,
		) ) 
	);
	/* Background Color Contact */
	$wp_customize->add_setting( 'croccante_theme_options[_onepage_imgcolor_contact]', array(
		'default' => '#000000',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'croccante_theme_options[_onepage_imgcolor_contact]', 
		array(
			'label' => __( 'Background Color Section', 'croccante' ),
			'section' => 'cresta_croccante_onepage_section_contact',
			'settings' =>'croccante_theme_options[_onepage_imgcolor_contact]',
			'active_callback' => 'croccante_is_contact_active',
			'priority' => 4,
		) )
	);
	/* Text Color Contact */
	$wp_customize->add_setting( 'croccante_theme_options[_onepage_textcolor_contact]', array(
		'default' => '#ffffff',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'croccante_theme_options[_onepage_textcolor_contact]', 
		array(
			'label' => __( 'Text Color Section', 'croccante' ),
			'section' => 'cresta_croccante_onepage_section_contact',
			'settings' =>'croccante_theme_options[_onepage_textcolor_contact]',
			'active_callback' => 'croccante_is_contact_active',
			'priority' => 5,
		) )
	);
	/* Contact title section */
	$wp_customize->add_setting('croccante_theme_options[_onepage_title_contact]', array(
        'default'    => __( 'Contact Us', 'croccante' ),
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_title_contact]', array(
        'label'      => __( 'Title', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_contact',
        'settings'   => 'croccante_theme_options[_onepage_title_contact]',
        'type'       => 'text',
		'active_callback' => 'croccante_is_contact_active',
		'priority' => 6,
    ) );
	/* Contact subtitle section */
	$wp_customize->add_setting('croccante_theme_options[_onepage_subtitle_contact]', array(
        'default'    => __( 'Get in touch', 'croccante' ),
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_subtitle_contact]', array(
        'label'      => __( 'Subtitle', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_contact',
        'settings'   => 'croccante_theme_options[_onepage_subtitle_contact]',
        'type'       => 'text',
		'active_callback' => 'croccante_is_contact_active',
		'priority' => 7,
    ) );
	/* Title left or right */
	$wp_customize->add_setting('croccante_theme_options[_onepage_positiontitle_contact]', array(
        'default'    => 'left',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'croccante_sanitize_select',
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_positiontitle_contact]', array(
        'label'      => __( 'Title and subtitle position', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_contact',
        'settings'   => 'croccante_theme_options[_onepage_positiontitle_contact]',
        'type'       => 'select',
		'active_callback' => 'croccante_is_contact_active',
		'priority' => 7,
		'choices' => array(
			'left' => __( 'Left', 'croccante'),
			'right' => __( 'Right', 'croccante'),
		),
    ) );
	/* Title animation */
	$wp_customize->add_setting('croccante_theme_options[_onepage_titleanimation_contact]', array(
        'default'    => 'noanim',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'croccante_sanitize_select',
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_titleanimation_contact]', array(
        'label'      => __( 'Title animation', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_contact',
        'settings'   => 'croccante_theme_options[_onepage_titleanimation_contact]',
        'type'       => 'select',
		'active_callback' => 'croccante_is_contact_active',
		'priority' => 7,
		'choices' => array(
			'noanim' => __( 'No', 'croccante'),
			'crocanim' => __( 'Yes', 'croccante'),
		),
    ) );
	/* Contact text */
	$wp_customize->add_setting('croccante_theme_options[_onepage_head_contact]', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Croccante_Customize_Heading(
		$wp_customize,
		'croccante_theme_options[_onepage_head_contact]',
		array(
			'settings'		=> 'croccante_theme_options[_onepage_head_contact]',
			'section'		=> 'cresta_croccante_onepage_section_contact',
			'label'			=> __( 'Contact fields', 'croccante' ),
			'active_callback' => 'croccante_is_contact_active',
			'priority' => 8,
		))
	);
	/* Contact company additional text section */
	$wp_customize->add_setting('croccante_theme_options[_onepage_additionaltext_contact]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'croccante_sanitize_text',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_additionaltext_contact]', array(
        'label'      => __( 'Additional Text', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_contact',
        'settings'   => 'croccante_theme_options[_onepage_additionaltext_contact]',
        'type'       => 'textarea',
		'active_callback' => 'croccante_is_contact_active',
		'priority' => 9,
    ) );
	/* Contact company name section */
	$wp_customize->add_setting('croccante_theme_options[_onepage_companyname_contact]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_companyname_contact]', array(
        'label'      => __( 'Company Name', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_contact',
        'settings'   => 'croccante_theme_options[_onepage_companyname_contact]',
        'type'       => 'text',
		'active_callback' => 'croccante_is_contact_active',
		'priority' => 10,
    ) );
	/* Contact company address line 1 section */
	$wp_customize->add_setting('croccante_theme_options[_onepage_companyaddress1_contact]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_companyaddress1_contact]', array(
        'label'      => __( 'Address line 1', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_contact',
        'settings'   => 'croccante_theme_options[_onepage_companyaddress1_contact]',
        'type'       => 'text',
		'active_callback' => 'croccante_is_contact_active',
		'priority' => 11,
    ) );
	/* Contact company address line 2 section */
	$wp_customize->add_setting('croccante_theme_options[_onepage_companyaddress2_contact]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_companyaddress2_contact]', array(
        'label'      => __( 'Address line 2', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_contact',
        'settings'   => 'croccante_theme_options[_onepage_companyaddress2_contact]',
        'type'       => 'text',
		'active_callback' => 'croccante_is_contact_active',
		'priority' => 12,
    ) );
	/* Contact company address line 3 section */
	$wp_customize->add_setting('croccante_theme_options[_onepage_companyaddress3_contact]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_companyaddress3_contact]', array(
        'label'      => __( 'Address line 3', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_contact',
        'settings'   => 'croccante_theme_options[_onepage_companyaddress3_contact]',
        'type'       => 'text',
		'active_callback' => 'croccante_is_contact_active',
		'priority' => 13,
    ) );
	/* Contact company phone number section */
	$wp_customize->add_setting('croccante_theme_options[_onepage_companyphone_contact]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_companyphone_contact]', array(
        'label'      => __( 'Phone Number', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_contact',
        'settings'   => 'croccante_theme_options[_onepage_companyphone_contact]',
        'type'       => 'text',
		'active_callback' => 'croccante_is_contact_active',
		'priority' => 14,
    ) );
	/* Contact company fax number section */
	$wp_customize->add_setting('croccante_theme_options[_onepage_companyfax_contact]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_companyfax_contact]', array(
        'label'      => __( 'Fax Number', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_contact',
        'settings'   => 'croccante_theme_options[_onepage_companyfax_contact]',
        'type'       => 'text',
		'active_callback' => 'croccante_is_contact_active',
		'priority' => 15,
    ) );
	/* Contact company email address section */
	$wp_customize->add_setting('croccante_theme_options[_onepage_companyemail_contact]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_email',
		'transport' => 'postMessage'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_companyemail_contact]', array(
        'label'      => __( 'Email Address', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_contact',
        'settings'   => 'croccante_theme_options[_onepage_companyemail_contact]',
        'type'       => 'text',
		'active_callback' => 'croccante_is_contact_active',
		'priority' => 16,
    ) );
	/* Contact Form Shortcode */
	$wp_customize->add_setting('croccante_theme_options[_onepage_shortcode_contact]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field'
    ) );
	$wp_customize->add_control('croccante_theme_options[_onepage_shortcode_contact]', array(
        'label'      => __( 'Contact Form Shortcode', 'croccante' ),
		'description'	=> wp_kses_post( 'Paste the contact form shortcode. For example the Contact Form 7 plugin shortcode: <code>[contact-form-7 id="xxx" title="Contact form 1"]</code>', 'croccante' ),
        'section'    => 'cresta_croccante_onepage_section_contact',
        'settings'   => 'croccante_theme_options[_onepage_shortcode_contact]',
        'type'       => 'text',
		'active_callback' => 'croccante_is_contact_active',
		'priority' => 17,
    ) );
	/* Big Icon Contact */
	$wp_customize->add_setting('croccante_theme_options[_onepage_icon_contact]', array(
		'default'			=> 'fa fa-envelope',
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Croccante_Fontawesome_Icon(
		$wp_customize,
		'croccante_theme_options[_onepage_icon_contact]',
		array(
			'settings'		=> 'croccante_theme_options[_onepage_icon_contact]',
			'section'		=> 'cresta_croccante_onepage_section_contact',
			'label'			=> __( 'FontAwesome Icon', 'croccante' ),
			'type'       => 'icon',
			'active_callback' => 'croccante_is_contact_active',
			'priority' => 18,
		))
	);
	/**
	* ################ SECTION IMPORTANT LINK AND DOCUMENTATION
	*/
	$wp_customize->add_setting('croccante_theme_options[_documentation_link]', array(
		'default' => '',
		'type' => 'option',
		'sanitize_callback' => 'esc_attr'
	));
	
	$wp_customize->add_control(
		new Croccante_Customize_Upgrade_Control(
		$wp_customize,
		'croccante_theme_options[_documentation_link]',
		array(
			'section' => 'cresta_croccante_links',
			'settings' => 'croccante_theme_options[_documentation_link]',
		))
	);
	/**
	* ################ SELECTIVE REFRESH
	*/
	if ( ! isset( $wp_customize->selective_refresh ) ) {
		return;
	}
	$wp_customize->selective_refresh->add_partial('croccante_theme_options[_onepage_title_aboutus]', array(
      'selector' => '.croccante_action_aboutus .croccante_main_text',
      'settings' => 'croccante_theme_options[_onepage_title_aboutus]',
      'render_callback' => 'croccante_selective_refresh_title_aboutus',
    ) );
	$wp_customize->selective_refresh->add_partial('croccante_theme_options[_onepage_title_features]', array(
      'selector' => '.croccante_action_features .croccante_main_text',
      'settings' => 'croccante_theme_options[_onepage_title_features]',
      'render_callback' => 'croccante_selective_refresh_title_features',
    ) );
	$wp_customize->selective_refresh->add_partial('croccante_theme_options[_onepage_title_skills]', array(
      'selector' => '.croccante_action_skills .croccante_main_text',
      'settings' => 'croccante_theme_options[_onepage_title_skills]',
      'render_callback' => 'croccante_selective_refresh_title_skills',
    ) );
	$wp_customize->selective_refresh->add_partial('croccante_theme_options[_onepage_phrase_cta]', array(
      'selector' => '.cta_columns .ctaPhrase h3',
      'settings' => 'croccante_theme_options[_onepage_phrase_cta]',
      'render_callback' => 'croccante_selective_refresh_phrase_cta',
    ) );
	$wp_customize->selective_refresh->add_partial('croccante_theme_options[_onepage_title_services]', array(
      'selector' => '.croccante_action_services .croccante_main_text',
      'settings' => 'croccante_theme_options[_onepage_title_services]',
      'render_callback' => 'croccante_selective_refresh_title_services',
    ) );
	$wp_customize->selective_refresh->add_partial('croccante_theme_options[_onepage_textarea_services]', array(
      'selector' => '.services_columns_single .serviceContent p',
      'settings' => 'croccante_theme_options[_onepage_textarea_services]',
      'render_callback' => 'croccante_selective_refresh_textarea_services',
    ) );
	$wp_customize->selective_refresh->add_partial('croccante_theme_options[_onepage_title_blog]', array(
      'selector' => '.croccante_action_blog .croccante_main_text',
      'settings' => 'croccante_theme_options[_onepage_title_blog]',
      'render_callback' => 'croccante_selective_refresh_title_blog',
    ) );
	$wp_customize->selective_refresh->add_partial('croccante_theme_options[_onepage_title_team]', array(
      'selector' => '.croccante_action_team .croccante_main_text',
      'settings' => 'croccante_theme_options[_onepage_title_team]',
      'render_callback' => 'croccante_selective_refresh_title_team',
    ) );
	$wp_customize->selective_refresh->add_partial('croccante_theme_options[_onepage_title_contact]', array(
      'selector' => '.croccante_action_contact .croccante_main_text',
      'settings' => 'croccante_theme_options[_onepage_title_contact]',
      'render_callback' => 'croccante_selective_refresh_title_contact',
    ) );
	$wp_customize->selective_refresh->add_partial('croccante_theme_options[_onepage_additionaltext_contact]', array(
      'selector' => '.croccanteAdditionalText p',
      'settings' => 'croccante_theme_options[_onepage_additionaltext_contact]',
      'render_callback' => 'croccante_selective_refresh_additionaltext_contact',
    ) );
}
add_action( 'customize_register', 'croccante_custom_settings_register' );

/* Render Callback for selective refresh */
function croccante_selective_refresh_title_aboutus() {
	return esc_html(croccante_options('_onepage_title_aboutus'));
}
function croccante_selective_refresh_title_features() {
	return esc_html(croccante_options('_onepage_title_features'));
}
function croccante_selective_refresh_title_skills() {
	return esc_html(croccante_options('_onepage_title_skills'));
}
function croccante_selective_refresh_phrase_cta() {
	return esc_html(croccante_options('_onepage_phrase_cta'));
}
function croccante_selective_refresh_title_services() {
	return esc_html(croccante_options('_onepage_title_services'));
}
function croccante_selective_refresh_textarea_services() {
	return wp_kses(croccante_options('_onepage_textarea_services'), croccante_allowed_html());
}
function croccante_selective_refresh_title_blog() {
	return esc_html(croccante_options('_onepage_title_blog'));
}
function croccante_selective_refresh_title_team() {
	return esc_html(croccante_options('_onepage_title_team'));
}
function croccante_selective_refresh_title_contact() {
	return esc_html(croccante_options('_onepage_title_contact'));
}
function croccante_selective_refresh_additionaltext_contact() {
	return wp_kses(croccante_options('_onepage_additionaltext_contact'), croccante_allowed_html());
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function croccante_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	/* Onepage title and subtitle */
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_title_aboutus]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_subtitle_aboutus]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_title_features]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_subtitle_features]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_title_skills]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_subtitle_skills]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_title_services]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_subtitle_services]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_title_blog]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_subtitle_blog]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_title_team]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_subtitle_team]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_title_contact]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_subtitle_contact]' )->transport  = 'postMessage';
	/* Onepage slider section */
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_text_1_slider]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_text_2_slider]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_text_3_slider]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_subtext_1_slider]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_subtext_2_slider]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_subtext_3_slider]' )->transport  = 'postMessage';
	/* Onepage about us section */
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_textbutton_aboutus]' )->transport  = 'postMessage';
	/* Onepage features section */
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_boxtextbutton_1_features]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_boxtextbutton_2_features]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_boxtextbutton_3_features]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_boxtextbutton_4_features]' )->transport  = 'postMessage';
	/* Onepage CTA section */
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_phrase_cta]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_desc_cta]' )->transport  = 'postMessage';
	/* Onepage services section */
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_phrase_services]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_textarea_services]' )->transport  = 'postMessage';
	/* Onepage contact section */
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_additionaltext_contact]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_companyname_contact]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_companyaddress1_contact]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_companyaddress2_contact]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_companyaddress3_contact]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_companyphone_contact]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_companyfax_contact]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_companyemail_contact]' )->transport  = 'postMessage';
	/* Onepage slider color and background */
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_textcolor_slider]' )->transport  = 'postMessage';
	/* Onepage about us color and background */
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_imgcolor_aboutus]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_textcolor_aboutus]' )->transport  = 'postMessage';
	/* Onepage features color and background */
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_imgcolor_features]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_textcolor_features]' )->transport  = 'postMessage';
	/* Onepage skills color and background */
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_imgcolor_skills]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_textcolor_skills]' )->transport  = 'postMessage';
	/* Onepage cta color and background */
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_imgcolor_cta]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_textcolor_cta]' )->transport  = 'postMessage';
	/* Onepage services color and background */
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_imgcolor_services]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_textcolor_services]' )->transport  = 'postMessage';
	/* Onepage blog color and background */
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_imgcolor_blog]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_textcolor_blog]' )->transport  = 'postMessage';
	/* Onepage team color and background */
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_imgcolor_team]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_textcolor_team]' )->transport  = 'postMessage';
	/* Onepage contact color and background */
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_imgcolor_contact]' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'croccante_theme_options[_onepage_textcolor_contact]' )->transport  = 'postMessage';
}
add_action( 'customize_register', 'croccante_customize_register' );

/* Custom Class */
if( class_exists( 'WP_Customize_Control' ) ):
	class Croccante_Customize_Upgrade_Control extends WP_Customize_Control {
        public function render_content() {  ?>
        	<p class="croccante-custom-title">
        		<span class="customize-control-title">
					<h3 style="text-align:center;"><div class="dashicons dashicons-megaphone"></div> <?php esc_html_e('Thank you for using Croccante WordPress Theme', 'croccante'); ?></h3>
        		</span>
        	</p>
			<p style="text-align:center;" class="croccante-custom-button">
				<a style="margin: 10px;display: block;" target="_blank" href="<?php echo esc_url(admin_url('themes.php?page=croccante-welcome&tab=documentation')); ?>" class="button button-secondary">
					<?php esc_html_e('Theme Documentation', 'croccante'); ?>
				</a>
				<a style="margin: 10px;display: block;" target="_blank" href="http://crestaproject.com/demo/croccante/" class="button button-secondary">
					<?php esc_html_e('Watch the demo', 'croccante'); ?>
				</a>
				<a style="margin: 10px;display: block;" target="_blank" href="http://crestaproject.com/demo/croccante-pro/" class="button button-secondary">
					<?php esc_html_e('Watch the PRO Version demo', 'croccante'); ?>
				</a>
				<a style="margin: 10px;display: block;" target="_blank" href="https://crestaproject.com/downloads/croccante/" class="button button-secondary">
					<?php esc_html_e('More info about Croccante theme', 'croccante'); ?>
				</a>
			</p>
			<?php
        }
    }
	class Croccante_Customize_Heading extends WP_Customize_Control {
		public $type = 'heading';

		public function render_content() {
			if ( !empty( $this->label ) ) : ?>
				<h3 class="croccante-accordion-section-title"><?php echo esc_html( $this->label ); ?></h3>
			<?php endif;
			if($this->description){ ?>
				<span class="description customize-control-description">
				<?php echo wp_kses_post($this->description); ?>
				</span>
			<?php }
		}
	}
	class Croccante_Info_Text extends WP_Customize_Control{
		public function render_content(){
		?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php if($this->description){ ?>
				<span class="description customize-control-description">
				<?php echo wp_kses_post($this->description); ?>
				</span>
			<?php }
		}
	}
	class Croccante_Fontawesome_Icon extends WP_Customize_Control{
		public $type = 'icon';
		public function render_content(){
			?>
				<label>
					<span class="customize-control-title">
					<?php echo esc_html( $this->label ); ?>
					</span>
					<?php if($this->description){ ?>
					<span class="description customize-control-description">
						<?php echo wp_kses_post($this->description); ?>
					</span>
					<?php } ?>
					<div class="croccante-selected-icon">
						<i class="fa <?php echo esc_attr($this->value()); ?>"></i>
						<span><i class="fa fa-angle-down"></i></span>
					</div>
					<ul class="croccante-icon-list clearfix">
						<?php
						$croccante_font_awesome_icon_array = croccante_font_awesome_icon_array();
						foreach ($croccante_font_awesome_icon_array as $croccante_font_awesome_icon) {
							$icon_class = $this->value() == $croccante_font_awesome_icon ? 'icon-active' : '';
							echo '<li class='.esc_attr($icon_class).'><i class="'.esc_attr($croccante_font_awesome_icon).'"></i></li>';
						}
						?>
					</ul>
					<input type="hidden" value="<?php $this->value(); ?>" <?php $this->link(); ?> />
				</label>
			<?php
		}
	}
endif;

function croccante_is_one_page() {
	if (!is_page_template('template-onepage.php')) {
		return false;
	}
	return true;
}

function croccante_is_slider_active() {
	$showSlider = croccante_options('_onepage_section_slider', '1');
	if ($showSlider == 1) {
		return true;
	}
	return false;
}

function croccante_is_aboutus_active() {
	$showAbout = croccante_options('_onepage_section_aboutus', '');
	if ($showAbout == 1) {
		return true;
	}
	return false;
}

function croccante_is_features_active() {
	$showFeatures = croccante_options('_onepage_section_features', '');
	if ($showFeatures == 1) {
		return true;
	}
	return false;
}

function croccante_is_skills_active() {
	$showSkills = croccante_options('_onepage_section_skills', '');
	if ($showSkills == 1) {
		return true;
	}
	return false;
}

function croccante_is_cta_active() {
	$showCta = croccante_options('_onepage_section_cta', '');
	if ($showCta == 1) {
		return true;
	}
	return false;
}

function croccante_is_services_active() {
	$showServices = croccante_options('_onepage_section_services', '');
	if ($showServices == 1) {
		return true;
	}
	return false;
}

function croccante_is_blog_active() {
	$showBlog = croccante_options('_onepage_section_blog', '');
	if ($showBlog == 1) {
		return true;
	}
	return false;
}

function croccante_is_team_active() {
	$showTeam = croccante_options('_onepage_section_team', '');
	if ($showTeam == 1) {
		return true;
	}
	return false;
}

function croccante_is_contact_active() {
	$showContact = croccante_options('_onepage_section_contact', '');
	if ($showContact == 1) {
		return true;
	}
	return false;
}

function croccante_is_sectionmap_active() {
	$showSectionmap = croccante_options('_onepage_settings_sectionmap', '');
	if ($showSectionmap == 1) {
		return true;
	}
	return false;
}

function croccante_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {
		return 1;
	} else {
		return '';
	}
}

function croccante_sanitize_text( $input ) {
	return wp_kses($input, croccante_allowed_html());
}

function croccante_sanitize_select( $input, $setting ) {
	$input = sanitize_key( $input );
	$choices = $setting->manager->get_control( $setting->id )->choices;
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

if( ! function_exists('croccante_font_awesome_icon_array')){
	function croccante_font_awesome_icon_array(){
		return array("fa fa-500px","fa fa-address-book","fa fa-address-book-o","fa fa-address-card","fa fa-address-card-o","fa fa-adjust","fa fa-adn","fa fa-align-center","fa fa-align-justify","fa fa-align-left","fa fa-align-right","fa fa-amazon","fa fa-ambulance","fa fa-american-sign-language-interpreting","fa fa-anchor","fa fa-android","fa fa-angellist","fa fa-angle-double-down","fa fa-angle-double-left","fa fa-angle-double-right","fa fa-angle-double-up","fa fa-angle-down","fa fa-angle-left","fa fa-angle-right","fa fa-angle-up","fa fa-apple","fa fa-archive","fa fa-area-chart","fa fa-arrow-circle-down","fa fa-arrow-circle-left","fa fa-arrow-circle-o-down","fa fa-arrow-circle-o-left","fa fa-arrow-circle-o-right","fa fa-arrow-circle-o-up","fa fa-arrow-circle-right","fa fa-arrow-circle-up","fa fa-arrow-down","fa fa-arrow-left","fa fa-arrow-right","fa fa-arrow-up","fa fa-arrows","fa fa-arrows-alt","fa fa-arrows-h","fa fa-arrows-v","fa fa-assistive-listening-systems","fa fa-asterisk","fa fa-at","fa fa-audio-description","fa fa-backward","fa fa-balance-scale","fa fa-ban","fa fa-bandcamp","fa fa-bar-chart","fa fa-barcode","fa fa-bars","fa fa-bath","fa fa-battery-empty","fa fa-battery-full","fa fa-battery-half","fa fa-battery-quarter","fa fa-battery-three-quarters","fa fa-bed","fa fa-beer","fa fa-behance","fa fa-behance-square","fa fa-bell","fa fa-bell-o","fa fa-bell-slash","fa fa-bell-slash-o","fa fa-bicycle","fa fa-binoculars","fa fa-birthday-cake","fa fa-bitbucket","fa fa-bitbucket-square","fa fa-black-tie","fa fa-blind","fa fa-bluetooth","fa fa-bluetooth-b","fa fa-bold","fa fa-bolt","fa fa-bomb","fa fa-book","fa fa-bookmark","fa fa-bookmark-o","fa fa-braille","fa fa-briefcase","fa fa-btc","fa fa-bug","fa fa-building","fa fa-building-o","fa fa-bullhorn","fa fa-bullseye","fa fa-bus","fa fa-buysellads","fa fa-calculator","fa fa-calendar","fa fa-calendar-check-o","fa fa-calendar-minus-o","fa fa-calendar-o","fa fa-calendar-plus-o","fa fa-calendar-times-o","fa fa-camera","fa fa-camera-retro","fa fa-car","fa fa-caret-down","fa fa-caret-left","fa fa-caret-right","fa fa-caret-square-o-down","fa fa-caret-square-o-left","fa fa-caret-square-o-right","fa fa-caret-square-o-up","fa fa-caret-up","fa fa-cart-arrow-down","fa fa-cart-plus","fa fa-cc","fa fa-cc-amex","fa fa-cc-diners-club","fa fa-cc-discover","fa fa-cc-jcb","fa fa-cc-mastercard","fa fa-cc-paypal","fa fa-cc-stripe","fa fa-cc-visa","fa fa-certificate","fa fa-chain-broken","fa fa-check","fa fa-check-circle","fa fa-check-circle-o","fa fa-check-square","fa fa-check-square-o","fa fa-chevron-circle-down","fa fa-chevron-circle-left","fa fa-chevron-circle-right","fa fa-chevron-circle-up","fa fa-chevron-down","fa fa-chevron-left","fa fa-chevron-right","fa fa-chevron-up","fa fa-child","fa fa-chrome","fa fa-circle","fa fa-circle-o","fa fa-circle-o-notch","fa fa-circle-thin","fa fa-clipboard","fa fa-clock-o","fa fa-clone","fa fa-cloud","fa fa-cloud-download","fa fa-cloud-upload","fa fa-code","fa fa-code-fork","fa fa-codepen","fa fa-codiepie","fa fa-coffee","fa fa-cog","fa fa-cogs","fa fa-columns","fa fa-comment","fa fa-comment-o","fa fa-commenting","fa fa-commenting-o","fa fa-comments","fa fa-comments-o","fa fa-compass","fa fa-compress","fa fa-connectdevelop","fa fa-contao","fa fa-copyright","fa fa-creative-commons","fa fa-credit-card","fa fa-credit-card-alt","fa fa-crop","fa fa-crosshairs","fa fa-css3","fa fa-cube","fa fa-cubes","fa fa-cutlery","fa fa-dashcube","fa fa-database","fa fa-deaf","fa fa-delicious","fa fa-desktop","fa fa-deviantart","fa fa-diamond","fa fa-digg","fa fa-dot-circle-o","fa fa-download","fa fa-dribbble","fa fa-dropbox","fa fa-drupal","fa fa-edge","fa fa-eercast","fa fa-eject","fa fa-ellipsis-h","fa fa-ellipsis-v","fa fa-empire","fa fa-envelope","fa fa-envelope-o","fa fa-envelope-open","fa fa-envelope-open-o","fa fa-envelope-square","fa fa-envira","fa fa-eraser","fa fa-etsy","fa fa-eur","fa fa-exchange","fa fa-exclamation","fa fa-exclamation-circle","fa fa-exclamation-triangle","fa fa-expand","fa fa-expeditedssl","fa fa-external-link","fa fa-external-link-square","fa fa-eye","fa fa-eye-slash","fa fa-eyedropper","fa fa-facebook","fa fa-facebook-official","fa fa-facebook-square","fa fa-fast-backward","fa fa-fast-forward","fa fa-fax","fa fa-female","fa fa-fighter-jet","fa fa-file","fa fa-file-archive-o","fa fa-file-audio-o","fa fa-file-code-o","fa fa-file-excel-o","fa fa-file-image-o","fa fa-file-o","fa fa-file-pdf-o","fa fa-file-powerpoint-o","fa fa-file-text","fa fa-file-text-o","fa fa-file-video-o","fa fa-file-word-o","fa fa-files-o","fa fa-film","fa fa-filter","fa fa-fire","fa fa-fire-extinguisher","fa fa-firefox","fa fa-first-order","fa fa-flag","fa fa-flag-checkered","fa fa-flag-o","fa fa-flask","fa fa-flickr","fa fa-floppy-o","fa fa-folder","fa fa-folder-o","fa fa-folder-open","fa fa-folder-open-o","fa fa-font","fa fa-font-awesome","fa fa-fonticons","fa fa-fort-awesome","fa fa-forumbee","fa fa-forward","fa fa-foursquare","fa fa-free-code-camp","fa fa-frown-o","fa fa-futbol-o","fa fa-gamepad","fa fa-gavel","fa fa-gbp","fa fa-genderless","fa fa-get-pocket","fa fa-gg","fa fa-gg-circle","fa fa-gift","fa fa-git","fa fa-git-square","fa fa-github","fa fa-github-alt","fa fa-github-square","fa fa-gitlab","fa fa-glass","fa fa-glide","fa fa-glide-g","fa fa-globe","fa fa-google","fa fa-google-plus","fa fa-google-plus-official","fa fa-google-plus-square","fa fa-google-wallet","fa fa-graduation-cap","fa fa-gratipay","fa fa-grav","fa fa-h-square","fa fa-hacker-news","fa fa-hand-lizard-o","fa fa-hand-o-down","fa fa-hand-o-left","fa fa-hand-o-right","fa fa-hand-o-up","fa fa-hand-paper-o","fa fa-hand-peace-o","fa fa-hand-pointer-o","fa fa-hand-rock-o","fa fa-hand-scissors-o","fa fa-hand-spock-o","fa fa-handshake-o","fa fa-hashtag","fa fa-hdd-o","fa fa-header","fa fa-headphones","fa fa-heart","fa fa-heart-o","fa fa-heartbeat","fa fa-history","fa fa-home","fa fa-hospital-o","fa fa-hourglass","fa fa-hourglass-end","fa fa-hourglass-half","fa fa-hourglass-o","fa fa-hourglass-start","fa fa-houzz","fa fa-html5","fa fa-i-cursor","fa fa-id-badge","fa fa-id-card","fa fa-id-card-o","fa fa-ils","fa fa-imdb","fa fa-inbox","fa fa-indent","fa fa-industry","fa fa-info","fa fa-info-circle","fa fa-inr","fa fa-instagram","fa fa-internet-explorer","fa fa-ioxhost","fa fa-italic","fa fa-joomla","fa fa-jpy","fa fa-jsfiddle","fa fa-key","fa fa-keyboard-o","fa fa-krw","fa fa-language","fa fa-laptop","fa fa-lastfm","fa fa-lastfm-square","fa fa-leaf","fa fa-leanpub","fa fa-lemon-o","fa fa-level-down","fa fa-level-up","fa fa-life-ring","fa fa-lightbulb-o","fa fa-line-chart","fa fa-link","fa fa-linkedin","fa fa-linkedin-square","fa fa-linode","fa fa-linux","fa fa-list","fa fa-list-alt","fa fa-list-ol","fa fa-list-ul","fa fa-location-arrow","fa fa-lock","fa fa-long-arrow-down","fa fa-long-arrow-left","fa fa-long-arrow-right","fa fa-long-arrow-up","fa fa-low-vision","fa fa-magic","fa fa-magnet","fa fa-male","fa fa-map","fa fa-map-marker","fa fa-map-o","fa fa-map-pin","fa fa-map-signs","fa fa-mars","fa fa-mars-double","fa fa-mars-stroke","fa fa-mars-stroke-h","fa fa-mars-stroke-v","fa fa-maxcdn","fa fa-meanpath","fa fa-medium","fa fa-medkit","fa fa-meetup","fa fa-meh-o","fa fa-mercury","fa fa-microchip","fa fa-microphone","fa fa-microphone-slash","fa fa-minus","fa fa-minus-circle","fa fa-minus-square","fa fa-minus-square-o","fa fa-mixcloud","fa fa-mobile","fa fa-modx","fa fa-money","fa fa-moon-o","fa fa-motorcycle","fa fa-mouse-pointer","fa fa-music","fa fa-neuter","fa fa-newspaper-o","fa fa-object-group","fa fa-object-ungroup","fa fa-odnoklassniki","fa fa-odnoklassniki-square","fa fa-opencart","fa fa-openid","fa fa-opera","fa fa-optin-monster","fa fa-outdent","fa fa-pagelines","fa fa-paint-brush","fa fa-paper-plane","fa fa-paper-plane-o","fa fa-paperclip","fa fa-paragraph","fa fa-pause","fa fa-pause-circle","fa fa-pause-circle-o","fa fa-paw","fa fa-paypal","fa fa-pencil","fa fa-pencil-square","fa fa-pencil-square-o","fa fa-percent","fa fa-phone","fa fa-phone-square","fa fa-picture-o","fa fa-pie-chart","fa fa-pied-piper","fa fa-pied-piper-alt","fa fa-pied-piper-pp","fa fa-pinterest","fa fa-pinterest-p","fa fa-pinterest-square","fa fa-plane","fa fa-play","fa fa-play-circle","fa fa-play-circle-o","fa fa-plug","fa fa-plus","fa fa-plus-circle","fa fa-plus-square","fa fa-plus-square-o","fa fa-podcast","fa fa-power-off","fa fa-print","fa fa-product-hunt","fa fa-puzzle-piece","fa fa-qq","fa fa-qrcode","fa fa-question","fa fa-question-circle","fa fa-question-circle-o","fa fa-quora","fa fa-quote-left","fa fa-quote-right","fa fa-random","fa fa-ravelry","fa fa-rebel","fa fa-recycle","fa fa-reddit","fa fa-reddit-alien","fa fa-reddit-square","fa fa-refresh","fa fa-registered","fa fa-renren","fa fa-repeat","fa fa-reply","fa fa-reply-all","fa fa-retweet","fa fa-road","fa fa-rocket","fa fa-rss","fa fa-rss-square","fa fa-rub","fa fa-safari","fa fa-scissors","fa fa-scribd","fa fa-search","fa fa-search-minus","fa fa-search-plus","fa fa-sellsy","fa fa-server","fa fa-share","fa fa-share-alt","fa fa-share-alt-square","fa fa-share-square","fa fa-share-square-o","fa fa-shield","fa fa-ship","fa fa-shirtsinbulk","fa fa-shopping-bag","fa fa-shopping-basket","fa fa-shopping-cart","fa fa-shower","fa fa-sign-in","fa fa-sign-language","fa fa-sign-out","fa fa-signal","fa fa-simplybuilt","fa fa-sitemap","fa fa-skyatlas","fa fa-skype","fa fa-slack","fa fa-sliders","fa fa-slideshare","fa fa-smile-o","fa fa-snapchat","fa fa-snapchat-ghost","fa fa-snapchat-square","fa fa-snowflake-o","fa fa-sort","fa fa-sort-alpha-asc","fa fa-sort-alpha-desc","fa fa-sort-amount-asc","fa fa-sort-amount-desc","fa fa-sort-asc","fa fa-sort-desc","fa fa-sort-numeric-asc","fa fa-sort-numeric-desc","fa fa-soundcloud","fa fa-space-shuttle","fa fa-spinner","fa fa-spoon","fa fa-spotify","fa fa-square","fa fa-square-o","fa fa-stack-exchange","fa fa-stack-overflow","fa fa-star","fa fa-star-half","fa fa-star-half-o","fa fa-star-o","fa fa-steam","fa fa-steam-square","fa fa-step-backward","fa fa-step-forward","fa fa-stethoscope","fa fa-sticky-note","fa fa-sticky-note-o","fa fa-stop","fa fa-stop-circle","fa fa-stop-circle-o","fa fa-street-view","fa fa-strikethrough","fa fa-stumbleupon","fa fa-stumbleupon-circle","fa fa-subscript","fa fa-subway","fa fa-suitcase","fa fa-sun-o","fa fa-superpowers","fa fa-superscript","fa fa-table","fa fa-tablet","fa fa-tachometer","fa fa-tag","fa fa-tags","fa fa-tasks","fa fa-taxi","fa fa-telegram","fa fa-television","fa fa-tencent-weibo","fa fa-terminal","fa fa-text-height","fa fa-text-width","fa fa-th","fa fa-th-large","fa fa-th-list","fa fa-themeisle","fa fa-thermometer-empty","fa fa-thermometer-full","fa fa-thermometer-half","fa fa-thermometer-quarter","fa fa-thermometer-three-quarters","fa fa-thumb-tack","fa fa-thumbs-down","fa fa-thumbs-o-down","fa fa-thumbs-o-up","fa fa-thumbs-up","fa fa-ticket","fa fa-times","fa fa-times-circle","fa fa-times-circle-o","fa fa-tint","fa fa-toggle-off","fa fa-toggle-on","fa fa-trademark","fa fa-train","fa fa-transgender","fa fa-transgender-alt","fa fa-trash","fa fa-trash-o","fa fa-tree","fa fa-trello","fa fa-tripadvisor","fa fa-trophy","fa fa-truck","fa fa-try","fa fa-tty","fa fa-tumblr","fa fa-tumblr-square","fa fa-twitch","fa fa-twitter","fa fa-twitter-square","fa fa-umbrella","fa fa-underline","fa fa-undo","fa fa-universal-access","fa fa-university","fa fa-unlock","fa fa-unlock-alt","fa fa-upload","fa fa-usb","fa fa-usd","fa fa-user","fa fa-user-circle","fa fa-user-circle-o","fa fa-user-md","fa fa-user-o","fa fa-user-plus","fa fa-user-secret","fa fa-user-times","fa fa-users","fa fa-venus","fa fa-venus-double","fa fa-venus-mars","fa fa-viacoin","fa fa-viadeo","fa fa-viadeo-square","fa fa-video-camera","fa fa-vimeo","fa fa-vimeo-square","fa fa-vine","fa fa-vk","fa fa-volume-control-phone","fa fa-volume-down","fa fa-volume-off","fa fa-volume-up","fa fa-weibo","fa fa-weixin","fa fa-whatsapp","fa fa-wheelchair","fa fa-wheelchair-alt","fa fa-wifi","fa fa-wikipedia-w","fa fa-window-close","fa fa-window-close-o","fa fa-window-maximize","fa fa-window-minimize","fa fa-window-restore","fa fa-windows","fa fa-wordpress","fa fa-wpbeginner","fa fa-wpexplorer","fa fa-wpforms","fa fa-wrench","fa fa-xing","fa fa-xing-square","fa fa-y-combinator","fa fa-yahoo","fa fa-yelp","fa fa-yoast","fa fa-youtube","fa fa-youtube-play","fa fa-youtube-square");
	}
}

if( ! function_exists('croccante_options')){
	function croccante_options($name, $default = false) {
		$options = ( get_option( 'croccante_theme_options' ) ) ? get_option( 'croccante_theme_options' ) : null;
		// return the option if it exists
		if ( isset( $options[ $name ] ) ) {
			return apply_filters( "croccante_theme_options_{$name}", $options[ $name ] );
		}
		// return default if nothing else
		return apply_filters( "croccante_theme_options_{$name}", $default );
	}
}

if( ! function_exists('croccante_allowed_html')){
	function croccante_allowed_html() {
		$allowed_tags = array(
			'a' => array(
				'class' => array(),
				'id'    => array(),
				'href'  => array(),
				'rel'   => array(),
				'title' => array(),
				'target' => array(),
			),
			'abbr' => array(
				'title' => array(),
			),
			'b' => array(),
			'blockquote' => array(
				'cite'  => array(),
			),
			'cite' => array(
				'title' => array(),
			),
			'code' => array(),
			'del' => array(
				'datetime' => array(),
				'title' => array(),
			),
			'dd' => array(),
			'div' => array(
				'class' => array(),
				'title' => array(),
				'style' => array(),
			),
			'dl' => array(),
			'dt' => array(),
			'em' => array(),
			'h1' => array(),
			'h2' => array(),
			'h3' => array(),
			'h4' => array(),
			'h5' => array(),
			'h6' => array(),
			'i' => array(),
			'br' => array(),
			'img' => array(
				'alt'    => array(),
				'class'  => array(),
				'height' => array(),
				'src'    => array(),
				'width'  => array(),
			),
			'li' => array(
				'class' => array(),
			),
			'ol' => array(
				'class' => array(),
			),
			'p' => array(
				'class' => array(),
			),
			'q' => array(
				'cite' => array(),
				'title' => array(),
			),
			'span' => array(
				'class' => array(),
				'title' => array(),
				'style' => array(),
			),
			'strike' => array(),
			'strong' => array(),
			'ul' => array(
				'class' => array(),
			),
		);
		return $allowed_tags;
	}
}

if( ! function_exists('croccante_show_social_network')){
	function croccante_show_social_network() {
		$openLinks = croccante_options('_social_open_links', '_self');
		$facebookURL = croccante_options('_facebookurl', '');
		$twitterURL = croccante_options('_twitterurl', '');
		$googleplusURL = croccante_options('_googleplusurl', '');
		$linkedinURL = croccante_options('_linkedinurl', '');
		$instagramURL = croccante_options('_instagramurl', '');
		$youtubeURL = croccante_options('_youtubeurl', '');
		$pinterestURL = croccante_options('_pinteresturl', '');
		$tumblrURL = croccante_options('_tumblrurl', '');
		$flickrURL = croccante_options('_flickrurl', '');
		$vkURL = croccante_options('_vkurl', '');
		$xingURL = croccante_options('_xingurl', '');
		$redditURL = croccante_options('_redditurl', '');
		?>
			<?php if ($facebookURL) : ?>
				<a class="croccante-social" href="<?php echo esc_url($facebookURL); ?>" target="<?php echo esc_attr($openLinks); ?>" title="<?php esc_attr_e( 'Facebook', 'croccante' ); ?>"><i class="fa fa-facebook spaceLeftRight"><span class="screen-reader-text"><?php esc_html_e( 'Facebook', 'croccante' ); ?></span></i></a>
			<?php endif; ?>
			<?php if ($twitterURL) : ?>
				<a class="croccante-social" href="<?php echo esc_url($twitterURL); ?>" target="<?php echo esc_attr($openLinks); ?>" title="<?php esc_attr_e( 'Twitter', 'croccante' ); ?>"><i class="fa fa-twitter spaceLeftRight"><span class="screen-reader-text"><?php esc_html_e( 'Twitter', 'croccante' ); ?></span></i></a>
			<?php endif; ?>
			<?php if ($googleplusURL) : ?>
				<a class="croccante-social" href="<?php echo esc_url($googleplusURL); ?>" target="<?php echo esc_attr($openLinks); ?>" title="<?php esc_attr_e( 'Google Plus', 'croccante' ); ?>"><i class="fa fa-google-plus spaceLeftRight"><span class="screen-reader-text"><?php esc_html_e( 'Google Plus', 'croccante' ); ?></span></i></a>
			<?php endif; ?>
			<?php if ($linkedinURL) : ?>
				<a class="croccante-social" href="<?php echo esc_url($linkedinURL); ?>" target="<?php echo esc_attr($openLinks); ?>" title="<?php esc_attr_e( 'Linkedin', 'croccante' ); ?>"><i class="fa fa-linkedin spaceLeftRight"><span class="screen-reader-text"><?php esc_html_e( 'Linkedin', 'croccante' ); ?></span></i></a>
			<?php endif; ?>
			<?php if ($instagramURL) : ?>
				<a class="croccante-social" href="<?php echo esc_url($instagramURL); ?>" target="<?php echo esc_attr($openLinks); ?>" title="<?php esc_attr_e( 'Instagram', 'croccante' ); ?>"><i class="fa fa-instagram spaceLeftRight"><span class="screen-reader-text"><?php esc_html_e( 'Instagram', 'croccante' ); ?></span></i></a>
			<?php endif; ?>
			<?php if ($youtubeURL) : ?>
				<a class="croccante-social" href="<?php echo esc_url($youtubeURL); ?>" target="<?php echo esc_attr($openLinks); ?>" title="<?php esc_attr_e( 'YouTube', 'croccante' ); ?>"><i class="fa fa-youtube spaceLeftRight"><span class="screen-reader-text"><?php esc_html_e( 'YouTube', 'croccante' ); ?></span></i></a>
			<?php endif; ?>
			<?php if ($pinterestURL) : ?>
				<a class="croccante-social" href="<?php echo esc_url($pinterestURL); ?>" target="<?php echo esc_attr($openLinks); ?>" title="<?php esc_attr_e( 'Pinterest', 'croccante' ); ?>"><i class="fa fa-pinterest spaceLeftRight"><span class="screen-reader-text"><?php esc_html_e( 'Pinterest', 'croccante' ); ?></span></i></a>
			<?php endif; ?>
			<?php if ($tumblrURL) : ?>
				<a class="croccante-social" href="<?php echo esc_url($tumblrURL); ?>" target="<?php echo esc_attr($openLinks); ?>" title="<?php esc_attr_e( 'Tumblr', 'croccante' ); ?>"><i class="fa fa-tumblr spaceLeftRight"><span class="screen-reader-text"><?php esc_html_e( 'Tumblr', 'croccante' ); ?></span></i></a>
			<?php endif; ?>
			<?php if ($flickrURL) : ?>
				<a class="croccante-social" href="<?php echo esc_url($flickrURL); ?>" target="<?php echo esc_attr($openLinks); ?>" title="<?php esc_attr_e( 'Flickr', 'croccante' ); ?>"><i class="fa fa-flickr spaceLeftRight"><span class="screen-reader-text"><?php esc_html_e( 'Flickr', 'croccante' ); ?></span></i></a>
			<?php endif; ?>
			<?php if ($vkURL) : ?>
				<a class="croccante-social" href="<?php echo esc_url($vkURL); ?>" target="<?php echo esc_attr($openLinks); ?>" title="<?php esc_attr_e( 'VK', 'croccante' ); ?>"><i class="fa fa-vk spaceLeftRight"><span class="screen-reader-text"><?php esc_html_e( 'VK', 'croccante' ); ?></span></i></a>
			<?php endif; ?>
			<?php if ($xingURL) : ?>
				<a class="croccante-social" href="<?php echo esc_url($xingURL); ?>" target="<?php echo esc_attr($openLinks); ?>" title="<?php esc_attr_e( 'Xing', 'croccante' ); ?>"><i class="fa fa-xing spaceLeftRight"><span class="screen-reader-text"><?php esc_html_e( 'Xing', 'croccante' ); ?></span></i></a>
			<?php endif; ?>
			<?php if ($redditURL) : ?>
				<a class="croccante-social" href="<?php echo esc_url($redditURL); ?>" target="<?php echo esc_attr($openLinks); ?>" title="<?php esc_attr_e( 'Reddit', 'croccante' ); ?>"><i class="fa fa-reddit-alien spaceLeftRight"><span class="screen-reader-text"><?php esc_html_e( 'Reddit', 'croccante' ); ?></span></i></a>
			<?php endif; ?>
		<?php
	}
}

/**
 * Add Custom CSS to Header 
 */
function croccante_custom_css_styles() {
	echo '<style type="text/css">';
	$mainBorderBackgroundColor = croccante_options('_mainborder_background_color', '#ffffff');
	$mainBorderTextColor = croccante_options('_mainborder_text_color', '#242423');
	$mainBorderLinkColor = croccante_options('_mainborder_link_color', '#5BC0EB');
	$contentBackgroundColor = croccante_options('_content_background_color', '#f4f4f4');
	$contentSecondaryBackgroundColor = croccante_options('_content_secondarybackground_color', '#ececec');
	$contentTextColor = croccante_options('_content_text_color', '#404040');
	$contentLinkColor = croccante_options('_content_link_color', '#5BC0EB');
	$contentBorderColor = croccante_options('_content_border_color', '#c9c9c9');
	$sidebarBackgroundColor = croccante_options('_sidebar_background_color', '#ffffff');
	$sidebarTextColor = croccante_options('_sidebar_text_color', '#404040');
	$sidebarLinkColor = croccante_options('_sidebar_link_color', '#5BC0EB');
	$footerBackgroundColor = croccante_options('_footer_background_color', '#000000');
	$footerTextColor = croccante_options('_footer_text_color', '#ffffff');
	$footerLinkColor = croccante_options('_footer_link_color', '#9b9b9b');
		/* Main Border Link Color */
		?>
		.main-navigation .current_page_item > a,
		.main-navigation .current-menu-item > a,
		.main-navigation .current_page_ancestor > a,
		.main-navigation .current-menu-ancestor > a,
		.main-navigation > div > ul li:hover > a,
		.main-navigation > div > ul li.focus > a,
		.site-copy-down .site-info a:hover,
		.site-copy-down .site-info a:focus,
		.site-copy-down .site-info a:active,
		footer.site-footer .site-social .croccante-social:hover,
		footer.site-footer .site-social .croccante-social:focus,
		footer.site-footer .site-social .croccante-social:active {
			color: <?php echo esc_html($mainBorderLinkColor); ?>;
		}
		.menu-toggle:hover,
		.menu-toggle:focus,
		.menu-toggle:active,
		header.site-header .crestaMenuButton {
			background-color: <?php echo esc_html($mainBorderLinkColor); ?>;
		}
		<?php
		/* Content Link Color */
		?>
		button:hover,
		input[type="button"]:hover,
		input[type="reset"]:hover,
		input[type="submit"]:hover,
		button:focus,
		input[type="button"]:focus,
		input[type="reset"]:focus,
		input[type="submit"]:focus,
		button:active,
		input[type="button"]:active,
		input[type="reset"]:active,
		input[type="submit"]:active,
		.croccanteButton a,
		.read-more a:hover,
		.read-more a:focus,
		.read-more a:active,
		a.more-link:hover,
		a.more-link:focus,
		a.more-link:active,
		.contact_columns button,
		.contact_columns input[type="button"],
		.contact_columns input[type="reset"],
		.contact_columns input[type="submit"],
		#wp-calendar > caption,
		.tagcloud a:hover,
		.tagcloud a:focus,
		.tagcloud a:active,
		.navigation.pagination .nav-links a:hover,
		.navigation.pagination .nav-links a:focus,
		.navigation.pagination .nav-links a:active,
		.page-links > a:hover,
		.page-links > a:focus,
		.page-links > a:active,
		.woocommerce-pagination > ul.page-numbers li a:hover,
		.woocommerce-pagination > ul.page-numbers li a:focus,
		.woocommerce-pagination > ul.page-numbers li a:active,
		.navigation.pagination .nav-links span.current,
		.page-links > .page-links-number,
		.woocommerce-pagination > ul.page-numbers li span,
		.content-area .onsale,
		.woocommerce .wooImage .button,
		.woocommerce .wooImage .added_to_cart,
		.woocommerce-error li a,
		.woocommerce-message a,
		.return-to-shop a,
		.wc-proceed-to-checkout .button.checkout-button,
		.widget_shopping_cart p.buttons a,
		.woocommerce .wishlist_table td.product-add-to-cart a,
		.woocommerce .content-area .woocommerce-tabs .tabs li.active a,
		.widget_price_filter .ui-slider .ui-slider-range,
		.widget_price_filter .ui-slider .ui-slider-handle {
			background-color: <?php echo esc_html($contentLinkColor); ?>;
		}
		a,
		a:visited,
		a:hover,
		a:focus,
		a:active,
		.woocommerce ul.products > li .price,
		.woocommerce div.product .summary .price {
			color: <?php echo esc_html($contentLinkColor); ?>;
		}
		#wp-calendar tbody td#today,
		.woocommerce ul.products > li h2:after {
			border-color: <?php echo esc_html($contentLinkColor); ?>;
		}
		<?php
		/* Sidebar Link Color */
		?>
		#tertiary.widget-area a {
			color: <?php echo esc_html($sidebarLinkColor); ?>;
		}
		<?php
		/* Footer Link Color */
		?>
		.footerArea a {
			color: <?php echo esc_html($footerLinkColor); ?>;
		}
		<?php
		/* Main Border Text Color */
		?>
		header.site-header,
		.site-copy-down,
		header.site-header a,
		.site-copy-down a,
		.post-navigation .nav-previous a,
		.post-navigation .nav-next a,
		ul.croccante_sectionmap li span.text,
		#toTop,
		header.site-header .crestaMenuButton a:hover,
		header.site-header .crestaMenuButton a:active,
		header.site-header .crestaMenuButton a:focus {
			color: <?php echo esc_html($mainBorderTextColor); ?>;
		}
		.menu-toggle,
		.icon-search:before,
		.icon-search:after,
		#push-nav span,
		ul.croccante_sectionmap li a:hover span.box,
		ul.croccante_sectionmap li.current-section a span.box {
			background-color: <?php echo esc_html($mainBorderTextColor); ?>;
		}
		.icon-search span,
		ul.croccante_sectionmap li a span.box,
		ul.croccante_sectionmap:before {
			border-color: <?php echo esc_html($mainBorderTextColor); ?>;
		}
		<?php
		/* Main Border Background Color */
		?>
		header.site-header,
		.site-copy-down,
		.border-fixed,
		.onepage_header.crocanim .crocaniminside,
		ul.croccante_sectionmap li,
		ul.croccante_sectionmap li a span.box,
		ul.croccante_sectionmap li span.text,
		.main-navigation ul ul a {
			background: <?php echo esc_html($mainBorderBackgroundColor); ?>;
		}
		.menu-toggle,
		header.site-header .crestaMenuButton a {
			color: <?php echo esc_html($mainBorderBackgroundColor); ?>;
		}
		@media all and (max-width: 1024px) {
			.main-navigation.toggled .nav-menu {
				background-color: <?php echo esc_html($mainBorderBackgroundColor); ?>;
			}
		}
		@media all and (max-width: 950px) {
			#toTop {
				background-color: <?php echo esc_html($mainBorderBackgroundColor); ?>;
			}
		}
		<?php
		/* Content Background Color */
		?>
		body,
		.croccanteLoader {
			background: <?php echo esc_html($contentBackgroundColor); ?>;
		}
		button,
		input[type="button"],
		input[type="reset"],
		input[type="submit"],
		.read-more a,
		.croccanteButton a,
		a.more-link,
		#wp-calendar > caption,
		.tagcloud a,
		.navigation.pagination .nav-links a,
		.navigation.pagination .nav-links span.current,
		.page-links > a,
		.page-links > .page-links-number,
		.woocommerce-pagination > ul.page-numbers li a,
		.woocommerce-pagination > ul.page-numbers li span,
		.content-area .onsale,
		.woocommerce .wooImage .button,
		.woocommerce .wooImage .added_to_cart,
		.woocommerce-error li a,
		.woocommerce-message a,
		.return-to-shop a,
		.wc-proceed-to-checkout .button.checkout-button,
		.widget_shopping_cart p.buttons a,
		.woocommerce .wishlist_table td.product-add-to-cart a,
		.woocommerce .content-area .woocommerce-tabs .tabs li.active a,
		.woocommerce ul.products > li:hover .wooImage .button,
		.woocommerce ul.products > li:hover .wooImage .added_to_cart,
		.woocommerce-error li a:hover,
		.woocommerce-message a:hover,
		.return-to-shop a:hover,
		.wc-proceed-to-checkout .button.checkout-button:hover,
		.widget_shopping_cart p.buttons a:hover,
		.widget_price_filter .price_slider_amount .button,
		.woocommerce div.product form.cart .button {
			color: <?php echo esc_html($contentBackgroundColor); ?>;
		}
		.entry-featuredImg-border:before,
		.entry-featuredImg-border:after {
			border-color: <?php echo esc_html($contentBackgroundColor); ?>;
		}
		<?php
		/* Content Secondary Background Color */
		?>
		input[type="text"],
		input[type="email"],
		input[type="url"],
		input[type="password"],
		input[type="search"],
		input[type="number"],
		input[type="tel"],
		input[type="range"],
		input[type="date"],
		input[type="month"],
		input[type="week"],
		input[type="time"],
		input[type="datetime"],
		input[type="datetime-local"],
		input[type="color"],
		textarea,
		select,
		#wp-calendar th,
		.tags-links a,
		header.page-header,
		.sticky,
		#comments ol .pingback,
		#comments ol article,
		.wp-caption .wp-caption-text,
		.woocommerce .content-area .woocommerce-tabs .tabs,
		.woocommerce .content-area .images figure div a,
		.woocommerce-message,
		.woocommerce-info,
		.woocommerce-error,
		.woocommerce table.shop_attributes tr,
		.woocommerce table.shop_attributes tr th,
		.woocommerce-page .entry-content table thead th,
		.woocommerce-page .entry-content table tr:nth-child(even),
		#payment .payment_methods li .payment_box {
			background-color: <?php echo esc_html($contentSecondaryBackgroundColor); ?>;
		}
		#wp-calendar tbody td {
			border-color: <?php echo esc_html($contentSecondaryBackgroundColor); ?>;
		}
		<?php
		/* Content Text Color */
		?>
		body,
		button,
		input,
		select,
		textarea,
		input[type="text"],
		input[type="email"],
		input[type="url"],
		input[type="password"],
		input[type="search"],
		input[type="number"],
		input[type="tel"],
		input[type="range"],
		input[type="date"],
		input[type="month"],
		input[type="week"],
		input[type="time"],
		input[type="datetime"],
		input[type="datetime-local"],
		input[type="color"],
		textarea,
		select,
		header.entry-header .entry-title a, .entry-meta a,
		.tags-links a {
			color: <?php echo esc_html($contentTextColor); ?>;
		}
		::-webkit-input-placeholder {
			color: <?php echo esc_html($contentTextColor); ?>;
		}
		::-moz-placeholder {
			color: <?php echo esc_html($contentTextColor); ?>;
		}
		:-ms-input-placeholder {
			color: <?php echo esc_html($contentTextColor); ?>;
		}
		:-moz-placeholder {
			color: <?php echo esc_html($contentTextColor); ?>;
		}
		button,
		input[type="button"],
		input[type="reset"],
		input[type="submit"],
		.read-more a,
		a.more-link,
		.croccanteButton a:hover,
		.croccanteButton a:focus,
		.croccanteButton a:active,
		.contact_columns button:hover,
		.contact_columns button:focus,
		.contact_columns input[type="button"]:hover,
		.contact_columns input[type="button"]:focus,
		.contact_columns input[type="reset"]:hover,
		.contact_columns input[type="reset"]:focus,
		.contact_columns input[type="submit"]:hover,
		.contact_columns input[type="submit"]:focus,
		.tagcloud a,
		.navigation.pagination .nav-links a,
		.page-links > a,
		.woocommerce-pagination > ul.page-numbers li a,
		.entry-featuredImg,
		.nano > .nano-pane > .nano-slider,
		.woocommerce ul.products > li:hover .wooImage .button,
		.woocommerce ul.products > li:hover .wooImage .added_to_cart,
		.woocommerce-error li a:hover,
		.woocommerce-message a:hover,
		.return-to-shop a:hover,
		.wc-proceed-to-checkout .button.checkout-button:hover,
		.widget_shopping_cart p.buttons a:hover {
			background-color: <?php echo esc_html($contentTextColor); ?>;
		}
		input[type="text"]:focus,
		input[type="email"]:focus,
		input[type="url"]:focus,
		input[type="password"]:focus,
		input[type="search"]:focus,
		input[type="number"]:focus,
		input[type="tel"]:focus,
		input[type="range"]:focus,
		input[type="date"]:focus,
		input[type="month"]:focus,
		input[type="week"]:focus,
		input[type="time"]:focus,
		input[type="datetime"]:focus,
		input[type="datetime-local"]:focus,
		input[type="color"]:focus,
		textarea:focus,
		select:focus,
		.tags-links a:hover,
		.tags-links a:focus,
		.tags-links a:active {
			border-color: <?php echo esc_html($contentTextColor); ?>;
		}
		.cLoader1 {
			border-color: <?php echo esc_html($contentTextColor); ?> transparent transparent;
		}
		.woocommerce ul.products > li .price {
			color: <?php echo esc_html($contentTextColor); ?> !important;
		}
		<?php list($r, $g, $b) = sscanf($contentTextColor, '#%02x%02x%02x'); ?>
		.nano > .nano-pane {
			background-color: rgba(<?php echo esc_html($r).', '.esc_html($g).', '.esc_html($b); ?>,0.15);
		}
		.nano > .nano-pane > .nano-slider {
			background-color: rgba(<?php echo esc_html($r).', '.esc_html($g).', '.esc_html($b); ?>,0.3);
		}
		@media all and (max-width: 767px) {
			.post-navigation .nav-previous a, .post-navigation .nav-next a {
				color: <?php echo esc_html($contentTextColor); ?>;
			}
		}
		<?php
		/* Content Border Color */
		?>
		hr,
		header.page-header .archive-description:before,
		.hentry:after,
		.woocommerce .woocommerce-tabs:after,
		.widget_price_filter .price_slider_wrapper .ui-widget-content {
			background-color: <?php echo esc_html($contentBorderColor); ?>;
		}
		.star-rating:before {
			color: <?php echo esc_html($contentBorderColor); ?>;
		}
		.widget-title h3,
		aside ul li,
		aside ul.menu li a {
			border-bottom-color: <?php echo esc_html($contentBorderColor); ?>;
		}
		aside ul.menu .indicatorBar,
		.hentry,
		body.woocommerce form.cart,
		.woocommerce .product_meta,
		.woocommerce .single_variation,
		.woocommerce .woocommerce-tabs,
		.woocommerce #reviews #comments ol.commentlist li .comment-text,
		.woocommerce p.stars a.star-1,
		.woocommerce p.stars a.star-2,
		.woocommerce p.stars a.star-3,
		.woocommerce p.stars a.star-4,
		.single-product div.product .woocommerce-product-rating,
		.woocommerce-page .entry-content table,
		.woocommerce-page .entry-content table thead th,
		.woocommerce-page .entry-content table tbody td,
		.woocommerce-page .entry-content table td,
		.woocommerce-page .entry-content table th,
		#order_review,
		#order_review_heading,
		#payment,
		#payment .payment_methods li,
		.widget_shopping_cart p.total {
			border-color: <?php echo esc_html($contentBorderColor); ?>;
		}
		<?php
		/* Sidebar Background Color */
		?>
		#tertiary.widget-area {
			background: <?php echo esc_html($sidebarBackgroundColor); ?>;
		}
		#tertiary.widget-area .tagcloud a {
			color: <?php echo esc_html($sidebarBackgroundColor); ?>;
		}
		<?php
		/* Sidebar Text Color */
		?>
		#tertiary.widget-area {
			color: <?php echo esc_html($sidebarTextColor); ?>;
		}
		<?php
		/* Footer Background Color */
		?>
		.footerArea {
			background-color: <?php echo esc_html($footerBackgroundColor); ?>;
		}
		<?php
		/* Footer Text Color */
		?>
		.footerArea {
			color: <?php echo esc_html($footerTextColor); ?>;
		}
		<?php
	if (is_page_template('template-onepage.php')) {
		$showSlider = croccante_options('_onepage_section_slider', '1');
		$showAboutus = croccante_options('_onepage_section_aboutus', '');
		$showFeatures = croccante_options('_onepage_section_features', '');
		$showSkills = croccante_options('_onepage_section_skills', '');
		$showCta = croccante_options('_onepage_section_cta', '');
		$showServices = croccante_options('_onepage_section_services', '');
		$showBlog = croccante_options('_onepage_section_blog', '');
		$showTeam = croccante_options('_onepage_section_team', '');
		$showContact = croccante_options('_onepage_section_contact', '');
		if ($showSlider == 1) {
			$sliderColorBack = croccante_options('_onepage_imgcolor_slider', '#404040');
			$sliderColorText = croccante_options('_onepage_textcolor_slider', '#ffffff');
			?>
			<?php if (!empty($sliderColorBack) ) : ?>
				<?php list($r, $g, $b) = sscanf($sliderColorBack, '#%02x%02x%02x'); ?>
				.flexslider .slides > li .flexText {
					background-color: rgba(<?php echo esc_html($r).', '.esc_html($g).', '.esc_html($b); ?>,0.4);
				}
			<?php endif; ?>
			<?php if (!empty($sliderColorText) ) : ?>
				.flexslider .slides > li .flexText .inside, .flex-direction-nav a {
					color: <?php echo esc_html($sliderColorText); ?>;
				}
				.scrollDownCroccante, .flex-direction-nav a {
					border-color: <?php echo esc_html($sliderColorText); ?>;
				}
				.scrollDownCroccante .inside {
					background-color: <?php echo esc_html($sliderColorText); ?>;
				}
			<?php endif; ?>
			<?php
		}
		if ($showAboutus == 1) {
			$aboutusImageBack = croccante_options('_onepage_imgback_aboutus');
			$aboutusColorBack = croccante_options('_onepage_imgcolor_aboutus', '#ffffff');
			$aboutusColorText = croccante_options('_onepage_textcolor_aboutus', '#404040');
			?>
			<?php if (!empty($aboutusImageBack) ) : ?>
				.croccante_aboutus_background {
					background-image: url(<?php echo esc_url($aboutusImageBack); ?>);
				}
			<?php else: ?>
				.croccante_aboutus_color {
					opacity : 1;
				}
			<?php endif; ?>
			<?php if (!empty($aboutusColorBack) ) : ?>
				.croccante_aboutus_color {
					background-color: <?php echo esc_html($aboutusColorBack); ?>;
				}
			<?php endif; ?>
			<?php if (!empty($aboutusColorText) ) : ?>
				section.croccante_aboutus {
					color: <?php echo esc_html($aboutusColorText); ?>;
				}
			<?php endif; ?>
		<?php
		}
		if ($showFeatures == 1) {
			$featuresImageBack = croccante_options('_onepage_imgback_features');
			$featuresColorBack = croccante_options('_onepage_imgcolor_features', '#404040');
			$featuresColorText = croccante_options('_onepage_textcolor_features', '#ffffff');
			?>
				<?php if (!empty($featuresImageBack) ) : ?>
					.croccante_features_background {
						background-image: url(<?php echo esc_url($featuresImageBack); ?>);
					}
				<?php else: ?>
					.croccante_features_color  {
						opacity : 1;
					}
				<?php endif; ?>
				<?php if (!empty($featuresColorBack) ) : ?>
					.croccante_features_color  {
						background-color: <?php echo esc_html($featuresColorBack); ?>;
					}
					.featuresIcon {
						background: <?php echo esc_html($featuresColorBack); ?>;
					}
					.features_columns_single:hover .featuresIcon {
						color: <?php echo esc_html($featuresColorBack); ?>;
					}
				<?php endif; ?>
				<?php if (!empty($featuresColorText) ) : ?>
					section.croccante_features {
						color: <?php echo esc_html($featuresColorText); ?>;
					}
					.featuresIcon {
						color: <?php echo esc_html($featuresColorText); ?>;
						border-color: <?php echo esc_html($featuresColorText); ?>;
					}
					.features_columns_single:hover .featuresIcon {
						background: <?php echo esc_html($featuresColorText); ?>;
					}
				<?php endif; ?>
			<?php
		}
		if ($showSkills == 1) {
			$skillsImageBack = croccante_options('_onepage_imgback_skills');
			$skillsColorBack = croccante_options('_onepage_imgcolor_skills', '#ffffff');
			$skillsColorText = croccante_options('_onepage_textcolor_skills', '#404040');
			?>
				<?php if (!empty($skillsImageBack) ) : ?>
					.croccante_skills_background {
						background-image: url(<?php echo esc_url($skillsImageBack); ?>);
					}
				<?php else: ?>
					.croccante_skills_color  {
						opacity : 1;
					}
				<?php endif; ?>
				<?php if (!empty($skillsColorBack) ) : ?>
					.croccante_skills_color {
						background-color: <?php echo esc_html($skillsColorBack); ?>;
					}
				<?php endif; ?>
				<?php if (!empty($skillsColorText) ) : ?>
					section.croccante_skills {
						color: <?php echo esc_html($skillsColorText); ?>;
					}
					.skillBottom .skillBar, .skillBottom .skillRealBar, .skillBottom .skillRealBarCyrcle {
						background: <?php echo esc_html($skillsColorText); ?>;
					}
				<?php endif; ?>
			<?php
		}
		if ($showCta == 1) {
			$ctaImageBack = croccante_options('_onepage_imgback_cta');
			$ctaColorBack = croccante_options('_onepage_imgcolor_cta', '#404040');
			$ctaColorText = croccante_options('_onepage_textcolor_cta', '#ffffff');
			?>
				<?php if (!empty($ctaImageBack) ) : ?>
					.croccante_cta_background {
						background-image: url(<?php echo esc_url($ctaImageBack); ?>);
					}
				<?php else: ?>
					.croccante_cta_color {
						opacity : 1;
					}
				<?php endif; ?>
				<?php if (!empty($ctaColorBack) ) : ?>
					.croccante_cta_color, .cta_columns .ctaIcon {
						background-color: <?php echo esc_html($ctaColorBack); ?>;
					}
					section.croccante_cta:hover .cta_columns .ctaIcon {
						color: <?php echo esc_html($ctaColorBack); ?>;
					}
				<?php endif; ?>
				<?php if (!empty($ctaColorText) ) : ?>
					section.croccante_cta, .cta_columns .ctaIcon {
						color: <?php echo esc_html($ctaColorText); ?>;
					}
					section.croccante_cta:hover .cta_columns .ctaIcon {
						background-color: <?php echo esc_html($ctaColorText); ?>;
					}
					.cta_columns .ctaIcon {
						border-color: <?php echo esc_html($ctaColorText); ?>;
					}
				<?php endif; ?>
			<?php
		}
		if ($showServices == 1) {
			$servicesImageBack = croccante_options('_onepage_imgback_services');
			$servicesColorBack = croccante_options('_onepage_imgcolor_services', '#ffffff');
			$servicesColorText = croccante_options('_onepage_textcolor_services', '#404040');
			?>
				<?php if (!empty($servicesImageBack) ) : ?>
					.croccante_services_background {
						background-image: url(<?php echo esc_url($servicesImageBack); ?>);
					}
				<?php else: ?>
					.croccante_services_color {
						opacity : 1;
					}
				<?php endif; ?>
				<?php if (!empty($servicesColorBack) ) : ?>
					.croccante_services_color, .serviceIcon {
						background-color: <?php echo esc_html($servicesColorBack); ?>;
					}
					.services_columns_single .serviceContent, .singleService:hover .serviceIcon {
						color: <?php echo esc_html($servicesColorBack); ?>;
					}
				<?php endif; ?>
				<?php if (!empty($servicesColorText) ) : ?>
					section.croccante_services, .serviceIcon {
						color: <?php echo esc_html($servicesColorText); ?>;
					}
					.serviceIcon {
						border-color: <?php echo esc_html($servicesColorText); ?>;
					}
					.services_columns_single.two .serviceColumnSingleColor, .singleService:hover .serviceIcon {
						background-color: <?php echo esc_html($servicesColorText); ?>;
					}
				<?php endif; ?>
			<?php
		}
		if ($showBlog == 1) {
			$blogImageBack = croccante_options('_onepage_imgback_blog');
			$blogColorBack = croccante_options('_onepage_imgcolor_blog', '#ffffff');
			$blogColorText = croccante_options('_onepage_textcolor_blog', '#404040');
			?>
				<?php if (!empty($blogImageBack) ) : ?>
					.croccante_blog_background {
						background-image: url(<?php echo esc_url($blogImageBack); ?>);
					}
				<?php else: ?>
					.croccante_blog_color {
						opacity : 1;
					}
				<?php endif; ?>
				<?php if (!empty($blogColorBack) ) : ?>
					.croccante_blog_color {
						background-color: <?php echo esc_html($blogColorBack); ?>;
					}
				<?php endif; ?>
				<?php if (!empty($blogColorText) ) : ?>
					section.croccante_blog, section.croccante_blog .entry-meta a {
						color: <?php echo esc_html($blogColorText); ?>;
					}
				<?php endif; ?>
			<?php
		}
		if ($showTeam == 1) {
			$teamImageBack = croccante_options('_onepage_imgback_team');
			$teamColorBack = croccante_options('_onepage_imgcolor_team', '#f7f7f7');
			$teamColorText = croccante_options('_onepage_textcolor_team', '#404040');
			?>
				<?php if (!empty($teamImageBack) ) : ?>
					.croccante_team_background {
						background-image: url(<?php echo esc_url($teamImageBack); ?>);
					}
				<?php else: ?>
					.croccante_team_color {
						opacity : 1;
					}
				<?php endif; ?>
				<?php if (!empty($teamColorBack) ) : ?>
					.croccante_team_color {
						background-color: <?php echo esc_html($teamColorBack); ?>;
					}
				<?php endif; ?>
				<?php if (!empty($teamColorText) ) : ?>
					section.croccante_team {
						color: <?php echo esc_html($teamColorText); ?>;
					}
				<?php endif; ?>
			<?php
		}
		if ($showContact == 1) {
			$contactImageBack = croccante_options('_onepage_imgback_contact');
			$contactColorBack = croccante_options('_onepage_imgcolor_contact', '#000000');
			$contactColorText = croccante_options('_onepage_textcolor_contact', '#ffffff');
			?>
				<?php if (!empty($contactImageBack) ) : ?>
					.croccante_contact_background {
						background-image: url(<?php echo esc_url($contactImageBack); ?>);
					}
				<?php else: ?>
					.croccante_contact_color {
						opacity : 1;
					}
				<?php endif; ?>
				<?php if (!empty($contactColorBack) ) : ?>
					.croccante_contact_color {
						background-color: <?php echo esc_html($contactColorBack); ?>;
					}
					.croccanteCompanyAddress1Icon,
					.croccanteCompanyPhoneIcon,
					.croccanteCompanyFaxIcon,
					.croccanteCompanyEmailIcon {
						color: <?php echo esc_html($contactColorBack); ?>;
					}
				<?php endif; ?>
				<?php if (!empty($contactColorText) ) : ?>
					section.croccante_contact,
					.contact_columns .croccanteContactForm input:not([type="submit"]),
					.contact_columns .croccanteContactForm textarea {
						color: <?php echo esc_html($contactColorText); ?>;
						border-color: <?php echo esc_html($contactColorText); ?>;
					}
					.croccanteCompanyAddress1Icon,
					.croccanteCompanyPhoneIcon,
					.croccanteCompanyFaxIcon,
					.croccanteCompanyEmailIcon {
						background: <?php echo esc_html($contactColorText); ?>;
					}
				<?php endif; ?>
			<?php
		}
	}
	echo '</style>';
}
add_action('wp_head', 'croccante_custom_css_styles');
