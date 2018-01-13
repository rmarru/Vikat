<?php
/**
 * Croccante Admin Class.
 * @author  CrestaProject
 * @package Croccante
 * @since   1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'Croccante_Admin' ) ) :
/**
 * Croccante_Admin Class.
 */
class Croccante_Admin {
	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'wp_loaded', array( __CLASS__, 'hide_notices' ) );
		add_action( 'load-themes.php', array( $this, 'admin_notice' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
	}
	/**
	 * Add admin menu.
	 */
	public function admin_menu() {
		$theme = wp_get_theme( get_template() );
		global $croccante_adminpage;
		$croccante_adminpage = add_theme_page( esc_html__( 'About', 'croccante' ) . ' ' . $theme->display( 'Name' ), esc_html__( 'About', 'croccante' ) . ' ' . $theme->display( 'Name' ), 'activate_plugins', 'croccante-welcome', array( $this, 'welcome_screen' ) );
	}
	/**
	 * Enqueue styles.
	 */
	public function enqueue_admin_scripts() {
		global $croccante_adminpage;
		$screen = get_current_screen();
		if ( $screen->id != $croccante_adminpage ) {
			return;
		}
		wp_enqueue_style( 'croccante-welcome', get_template_directory_uri() . '/inc/admin/welcome.css', array(), '1.0' );
		wp_enqueue_script( 'croccante-admin-panel', get_template_directory_uri() . '/inc/admin/admin-panel.js', array('jquery'), '1.0', true );
	}
	/**
	 * Add admin notice.
	 */
	public function admin_notice() {
		global $pagenow;
		wp_enqueue_style( 'croccante-message', get_template_directory_uri() . '/inc/admin/message.css', array(), '1.0' );
		// Let's bail on theme activation.
		if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
			update_option( 'croccante_admin_notice_welcome', 1 );
		// No option? Let run the notice wizard again..
		} elseif( ! get_option( 'croccante_admin_notice_welcome' ) ) {
			add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
		}
	}
	/**
	 * Hide a notice if the GET variable is set.
	 */
	public static function hide_notices() {
		if ( isset( $_GET['croccante-hide-notice'] ) && isset( $_GET['_croccante_notice_nonce'] ) ) {
			if ( ! wp_verify_nonce( sanitize_key($_GET['_croccante_notice_nonce'] ), 'croccante_hide_notices_nonce' ) ) {
				wp_die( esc_html__( 'Action failed. Please refresh the page and retry.', 'croccante' ) );
			}
			if ( ! current_user_can( 'manage_options' ) ) {
				wp_die( esc_html__( 'Cheatin&#8217; huh?', 'croccante' ) );
			}
			$hide_notice = sanitize_text_field( wp_unslash($_GET['croccante-hide-notice'] ));
			update_option( 'croccante_admin_notice_' . $hide_notice, 1 );
		}
	}
	/**
	 * Show welcome notice.
	 */
	public function welcome_notice() {
		?>
		<div id="message" class="updated cresta-message">
			<a class="cresta-message-close notice-dismiss" href="<?php echo esc_url( wp_nonce_url( remove_query_arg( array( 'activated' ), add_query_arg( 'croccante-hide-notice', 'welcome' ) ), 'croccante_hide_notices_nonce', '_croccante_notice_nonce' ) ); ?>"><?php esc_html_e( 'Dismiss', 'croccante' ); ?></a>
			<p>
			<?php
			/* translators: 1: start option panel link, 2: end option panel link */
			printf( esc_html__( 'Welcome! Thank you for choosing Croccante theme! To fully take advantage of the best our theme can offer and read the documentation please make sure you visit our %1$swelcome page%2$s.', 'croccante' ), '<a href="' . esc_url( admin_url( 'themes.php?page=croccante-welcome' ) ) . '">', '</a>' );
			?>
			</p>
			<p class="submit">
				<a class="button-secondary" href="<?php echo esc_url( admin_url( 'themes.php?page=croccante-welcome' ) ); ?>"><?php esc_html_e( 'Get started with Croccante', 'croccante' ); ?></a>
			</p>
		</div>
		<?php
	}
	/**
	 * Intro text/links shown to all about pages.
	 *
	 * @access private
	 */
	private function intro() {
		$theme = wp_get_theme( get_template() );
		?>
		<div class="cresta-theme-info">
			<h1>
				<?php esc_html_e('About', 'croccante'); ?>
				<?php echo esc_html($theme->get( 'Name' )) ." ". esc_html($theme->get( 'Version' )); ?>
			</h1>
			<div class="welcome-description-wrap">
				<div class="about-text"><?php echo esc_html($theme->display( 'Description' )); ?>
				<p class="cresta-actions">
					<a href="<?php echo esc_url( apply_filters( 'croccante_pro_theme_url', 'https://crestaproject.com/downloads/croccante/' ) ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Theme Info', 'croccante' ); ?></a>

					<a href="<?php echo esc_url( apply_filters( 'croccante_pro_theme_url', 'https://crestaproject.com/demo/croccante/' ) ); ?>" class="button button-secondary docs" target="_blank"><?php esc_html_e( 'View Demo', 'croccante' ); ?></a>
					
					<a href="<?php echo esc_url( apply_filters( 'croccante_pro_theme_url', 'https://crestaproject.com/demo/croccante-pro/' ) ); ?>" class="button button-primary docs" target="_blank"><?php esc_html_e( 'View PRO version Demo', 'croccante' ); ?></a>
					
					<a href="<?php echo esc_url( apply_filters( 'croccante_pro_theme_url', 'https://wordpress.org/support/theme/croccante/reviews/' ) ); ?>" class="button button-secondary docs" target="_blank"><?php esc_html_e( 'Rate this theme', 'croccante' ); ?></a>
				</p>
				</div>
				<div class="cresta-screenshot">
					<img src="<?php echo esc_url( get_template_directory_uri() ) . '/screenshot.png'; ?>" />
				</div>
			</div>
		</div>
		<h2 class="nav-tab-wrapper">
			<a class="nav-tab <?php if ( empty( $_GET['tab'] ) && isset( $_GET['page'] ) && $_GET['page'] == 'croccante-welcome' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'croccante-welcome' ), 'themes.php' ) ) ); ?>">
				<?php echo esc_html($theme->display( 'Name' )); ?>
			</a>
			<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'free_vs_pro' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'croccante-welcome', 'tab' => 'free_vs_pro' ), 'themes.php' ) ) ); ?>">
				<?php esc_html_e( 'Free Vs PRO', 'croccante' ); ?>
			</a>
			<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'documentation' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'croccante-welcome', 'tab' => 'documentation' ), 'themes.php' ) ) ); ?>">
				<?php esc_html_e( 'Documentation', 'croccante' ); ?>
			</a>
			<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'changelog' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'croccante-welcome', 'tab' => 'changelog' ), 'themes.php' ) ) ); ?>">
				<?php esc_html_e( 'Changelog', 'croccante' ); ?>
			</a>
		</h2>
		<?php
	}
	/**
	 * Welcome screen page.
	 */
	public function welcome_screen() {
		$current_tab = empty( $_GET['tab'] ) ? 'about' : sanitize_title( wp_unslash($_GET['tab']) );
		// Look for a {$current_tab}_screen method.
		if ( is_callable( array( $this, $current_tab . '_screen' ) ) ) {
			return $this->{ $current_tab . '_screen' }();
		}
		// Fallback to about screen.
		return $this->about_screen();
	}
	/**
	 * Output the about screen.
	 */
	public function about_screen() {
		$theme = wp_get_theme( get_template() );
		?>
		<div class="wrap about-wrap">
			<?php $this->intro(); ?>
			<div class="changelog point-releases">
				<div class="under-the-hood two-col">
					<div class="col">
						<h3><?php esc_html_e( 'Theme Customizer', 'croccante' ); ?></h3>
						<p><?php esc_html_e( 'All Theme Options are available via Customize screen.', 'croccante' ) ?></p>
						<p><a href="<?php echo esc_url(admin_url( 'customize.php' )); ?>" class="button button-secondary"><?php esc_html_e( 'Customize', 'croccante' ); ?></a></p>
					</div>
					<div class="col">
						<h3><?php esc_html_e( 'Got theme support question?', 'croccante' ); ?></h3>
						<p><?php esc_html_e( 'Please put it in our support forum.', 'croccante' ) ?></p>
						<p><a target="_blank" href="<?php echo esc_url( 'https://wordpress.org/support/theme/croccante/' ); ?>" class="button button-secondary"><?php esc_html_e( 'Support', 'croccante' ); ?></a></p>
					</div>
					<div class="col">
						<h3><?php esc_html_e( 'Need more features?', 'croccante'); ?></h3>
						<p><?php esc_html_e( 'Upgrade to PRO version for more exciting features.', 'croccante' ) ?></p>
						<p><a target="_blank" href="<?php echo esc_url( 'https://crestaproject.com/downloads/croccante/' ); ?>" class="button button-secondary"><?php esc_html_e( 'Info about PRO version', 'croccante' ); ?></a></p>
					</div>
					<div class="col">
						<h3>
							<?php
							esc_html_e( 'Translate', 'croccante' );
							echo ' ' . esc_html($theme->display( 'Name' ));
							?>
						</h3>
						<p><?php esc_html_e( 'Click below to translate this theme into your own language.', 'croccante' ) ?></p>
						<p>
							<a target="_blank" href="<?php echo esc_url( 'http://translate.wordpress.org/projects/wp-themes/croccante/' ); ?>" class="button button-secondary">
								<?php
								esc_html_e( 'Translate', 'croccante' );
								echo ' ' . esc_html($theme->display( 'Name' ));
								?>
							</a>
						</p>
					</div>
				</div>
			</div>
			<div class="return-to-dashboard cresta">
				<?php if ( current_user_can( 'update_core' ) && isset( $_GET['updated'] ) ) : ?>
					<a href="<?php echo esc_url( self_admin_url( 'update-core.php' ) ); ?>">
						<?php is_multisite() ? esc_html_e( 'Return to Updates', 'croccante' ) : esc_html_e( 'Return to Dashboard &rarr; Updates', 'croccante' ); ?>
					</a> |
				<?php endif; ?>
				<a href="<?php echo esc_url( self_admin_url() ); ?>"><?php is_blog_admin() ? esc_html_e( 'Go to Dashboard &rarr; Home', 'croccante' ) : esc_html_e( 'Go to Dashboard', 'croccante' ); ?></a>
			</div>
		</div>
		<?php
	}
	/**
	 * Output the changelog screen.
	 */
	public function changelog_screen() {
		global $wp_filesystem;
		?>
		<div class="wrap about-wrap">
			<?php $this->intro(); ?>
			<p class="about-description"><?php esc_html_e( 'View changelog below:', 'croccante' ); ?></p>
			<?php
				$changelog_file = apply_filters( 'croccante_changelog_file', get_template_directory() . '/readme.txt' );

				// Check if the changelog file exists and is readable.
				if ( $changelog_file && is_readable( $changelog_file ) ) {
					WP_Filesystem();
					$changelog = $wp_filesystem->get_contents( $changelog_file );
					$changelog_list = $this->parse_changelog( $changelog );

					echo wp_kses_post( $changelog_list );
				}
			?>
		</div>
		<?php
	}
	/**
	 * Parse changelog from readme file.
	 * @param  string $content
	 * @return string
	 */
	private function parse_changelog( $content ) {
		$matches   = null;
		$regexp    = '~==\s*Changelog\s*==(.*)($)~Uis';
		$changelog = '';
		if ( preg_match( $regexp, $content, $matches ) ) {
			$changes = explode( '\r\n', trim( $matches[1] ) );

			$changelog .= '<pre class="changelog">';

			foreach ( $changes as $index => $line ) {
				$changelog .= wp_kses_post( preg_replace( '~(=\s*Version\s*(\d+(?:\.\d+)+)\s*=|$)~Uis', '<span class="title">${1}</span>', $line ) );
			}

			$changelog .= '</pre>';
		}
		return wp_kses_post( $changelog );
	}
	/**
	 * Output the documentation screen.
	 */
	public function documentation_screen() {
		?>
		<div class="wrap about-wrap">
			<?php $this->intro(); ?>
			<p class="about-description"><?php esc_html_e( 'Croccante WordPress Theme Documentation', 'croccante' ); ?></p>
			<div class="option-panel-toggle">
				<div class="singleToggle">
					<span class="dashicons dashicons-arrow-right"></span><div class="toggleTitle"><?php esc_html_e( 'How to set the "one page" template in the home page', 'croccante' ); ?></div>
					<div class="toggleText">
						<ul>
							<li>
								<div class="croccanteDocText">
									<?php esc_html_e( 'Watch the video to set the onepage template on the home page, or read the step-by-step instructions below.', 'croccante' ); ?>
								</div>
								<div class="croccanteDocImage">
									<iframe width="560" height="315" src="https://www.youtube.com/embed/zsRSF8u0OYM" frameborder="0" allowfullscreen></iframe>
								</div>
							</li>
							<li>
								<div class="croccanteDocText">
									<?php esc_html_e( '1) Create a new page and name it as you like (eg. My Home Page). In the "Page Attributes" section choose the template called "One Page Website" and save the page.', 'croccante' ); ?>
								</div>
								<div class="croccanteDocImage">
									<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/images/croccante-documentation-1.png'; ?>" />
								</div>
							</li>
							<li>
								<div class="croccanteDocText">
									<?php esc_html_e( '2) Go in your WordPress Dashboard under "Settings-> Reading". Set the "Front page displays" on "Static Page" and choose the page you previously created as Front page (eg. My Home Page).', 'croccante' ); ?>
								</div>
								<div class="croccanteDocImage">
									<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/images/croccante-documentation-2.png'; ?>" />
								</div>
							</li>
							<li>
								<div class="croccanteDocText">
									<?php esc_html_e( '3) Perfect! Now you can go in your WordPress Dashboard under "Appearance-> Customize" and you\'ll see the section called "Croccante Onepage" in which you can customize the home page.', 'croccante' ); ?>
								</div>
								<div class="croccanteDocImage">
									<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/images/croccante-documentation-3.jpg'; ?>" />
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="option-panel-toggle">
				<div class="singleToggle">
					<span class="dashicons dashicons-arrow-right"></span><div class="toggleTitle"><?php esc_html_e( 'One Page: how to scroll to section using the menu', 'croccante' ); ?></div>
					<div class="toggleText">
						<ul>
							<li>
								<div class="croccanteDocText">
									<?php esc_html_e( '1) Go to your WordPress Dashboard under "Appearance-> Customize-> Croccante Onepage" and choose one section (eg. Features) and add a section ID (eg. features) for this section. Save the options.', 'croccante' ); ?>
								</div>
								<div class="croccanteDocImage">
									<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/images/croccante-documentation-4.jpg'; ?>" />
								</div>
							</li>
							<li>
								<div class="croccanteDocText">
									<?php esc_html_e( '2) Now go to your WordPress Dashboard under "Appearance-> Menus" and create a new custom link with the URL of your home page followed the ID created for the section (eg. yoursite.com/#features). Add this custom link to your menu and save the options.', 'croccante' ); ?>
								</div>
								<div class="croccanteDocImage">
									<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/images/croccante-documentation-5.jpg'; ?>" />
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="option-panel-toggle">
				<div class="singleToggle">
					<span class="dashicons dashicons-arrow-right"></span><div class="toggleTitle"><?php esc_html_e( 'One Page: how to set "About Us" section, "Features" section, "Services" section and "Team" section', 'croccante' ); ?></div>
					<div class="toggleText">
						<ul>
							<li>
								<div class="croccanteDocText">
									<?php esc_html_e( 'Watch the video to set the "About Us" section, or read the step-by-step instructions below.', 'croccante' ); ?>
								</div>
								<div class="croccanteDocImage">
									<iframe width="560" height="315" src="https://www.youtube.com/embed/vC5qwUFAXEk" frameborder="0" allowfullscreen></iframe>
								</div>
							</li>
							<li>
								<div class="croccanteDocText">
									<?php esc_html_e( '1) These sections (About Us, Features, Services and Team) work in the same way and with the same procedure. To insert the content create a new page, and insert the title, content and featured image. The featured image is only valid for the "About Us" and "Team" section but is not mandatory.', 'croccante' ); ?>
								</div>
								<div class="croccanteDocImage">
									<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/images/croccante-documentation-10.png'; ?>" />
								</div>
							</li>
							<li>
								<div class="croccanteDocText">
									<?php esc_html_e( '2) Now go to "Appearance-> Customize-> Croccante Onepage" and choose the section you want to edit (About Us, Features or Services). Find the option called "Choose the page to display" and search the page you just created.', 'croccante' ); ?>
								</div>
								<div class="croccanteDocImage">
									<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/images/croccante-documentation-11.png'; ?>" />
								</div>
							</li>
							<li>
								<div class="croccanteDocText">
									<?php esc_html_e( '3) Now the section will show the content of the page previously created and the layout will be like the example image. The "Features", "Services" and "Team" sections work in the same way but will have a different layout.', 'croccante' ); ?>
								</div>
								<div class="croccanteDocImage">
									<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/images/croccante-documentation-12.jpg'; ?>" />
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="option-panel-toggle">
				<div class="singleToggle">
					<span class="dashicons dashicons-arrow-right"></span><div class="toggleTitle"><?php esc_html_e( 'One Page: how to re-order sections', 'croccante' ); ?></div>
					<div class="toggleText">
						<ul>
							<li>
								<div class="croccanteDocText">
									<?php esc_html_e( 'Re-order sections is available in Croccante PRO version. With this feature you can choose the position of each section using drag and drop. Click on the button below for more information:', 'croccante' ); ?>
									<br/><a href="<?php echo esc_url( apply_filters( 'croccante_pro_theme_url', 'https://crestaproject.com/downloads/croccante/' ) ); ?>" class="button button-primary" target="_blank"><?php esc_html_e( 'More Info About PRO Version', 'croccante' ); ?></a>
								</div>
								<div class="croccanteDocImage">
									<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/images/croccante-documentation-13.png'; ?>" />
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="option-panel-toggle">
				<div class="singleToggle">
					<span class="dashicons dashicons-arrow-right"></span><div class="toggleTitle"><?php esc_html_e( 'How to add social icons', 'croccante' ); ?></div>
					<div class="toggleText">
						<ul>
							<li>
								<div class="croccanteDocText">
									<?php esc_html_e( 'Go to your WordPress Dashboard under "Appearance-> Customize-> Croccante Theme Options-> Social Network". Here you can choose which social network to show, social icons will be displayed in the footer.', 'croccante' ); ?>
								</div>
								<div class="croccanteDocImage">
									<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/images/croccante-documentation-6.jpg'; ?>" />
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="option-panel-toggle">
				<div class="singleToggle">
					<span class="dashicons dashicons-arrow-right"></span><div class="toggleTitle"><?php esc_html_e( 'How to add custom logo', 'croccante' ); ?></div>
					<div class="toggleText">
						<ul>
							<li>
								<div class="croccanteDocText">
									<?php esc_html_e( 'Go to your WordPress Dashboard under "Appearance-> Customize-> Site Identity". Here you can upload your custom logo (size 250x55px).', 'croccante' ); ?>
								</div>
								<div class="croccanteDocImage">
									<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/images/croccante-documentation-7.jpg'; ?>" />
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="option-panel-toggle">
				<div class="singleToggle">
					<span class="dashicons dashicons-arrow-right"></span><div class="toggleTitle"><?php esc_html_e( 'How to change theme colors', 'croccante' ); ?></div>
					<div class="toggleText">
						<ul>
							<li>
								<div class="croccanteDocText">
									<?php esc_html_e( 'Go to your WordPress Dashboard under "Appearance-> Customize-> Croccante Theme Options-> Theme Colors". Here you can change the theme colors according to sections of the site (borders, content, push sidebar and footer).', 'croccante' ); ?>
								</div>
								<div class="croccanteDocImage">
									<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/images/croccante-documentation-8.jpg'; ?>" />
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="option-panel-toggle">
				<div class="singleToggle">
					<span class="dashicons dashicons-arrow-right"></span><div class="toggleTitle"><?php esc_html_e( 'How to display page loader', 'croccante' ); ?></div>
					<div class="toggleText">
						<ul>
							<li>
								<div class="croccanteDocText">
									<?php esc_html_e( 'Go to your WordPress Dashboard under "Appearance-> Customize-> Croccante Theme Options-> General Settings", find the option called "Display page loader" and check it. The background will be the same of "Content background color" and the loader icon the same color of "Link color".', 'croccante' ); ?>
								</div>
								<div class="croccanteDocImage">
									<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/images/croccante-documentation-9.jpg'; ?>" />
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="option-panel-toggle">
				<div class="singleToggle">
					<span class="dashicons dashicons-arrow-right"></span><div class="toggleTitle"><?php esc_html_e( 'How to highlight a menu item', 'croccante' ); ?></div>
					<div class="toggleText">
						<ul>
							<li>
								<div class="croccanteDocText">
									<?php esc_html_e( 'If you need to emphasize a menu item (call to action, donate button, etc..) just go to your WordPress Dashboard under "Appearance-> Menus". Create a new "Custom Links" and drag it into the menu. Expand the entry and in the "CSS Classes" section write: crestaMenuButton', 'croccante' ); ?>
								</div>
								<div class="croccanteDocImage">
									<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/images/croccante-documentation-14.png'; ?>" />
								</div>
							</li>
							<li>
								<div class="croccanteDocText">
									<?php esc_html_e( 'This will be the result (the colors change according to the ones chosen).', 'croccante' ); ?>
								</div>
								<div class="croccanteDocImage">
									<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/images/croccante-documentation-15.png'; ?>" />
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
	/**
	 * Output the free vs pro screen.
	 */
	public function free_vs_pro_screen() {
		?>
		<div class="wrap about-wrap">
			<?php $this->intro(); ?>
			<p class="about-description"><?php esc_html_e( 'Upgrade to PRO version for more exciting features.', 'croccante' ); ?></p>
			<table>
				<thead>
					<tr>
						<th class="table-feature-title"><h3><?php esc_html_e('Features', 'croccante'); ?></h3></th>
						<th><h3><?php esc_html_e('Croccante', 'croccante'); ?></h3></th>
						<th><h3><?php esc_html_e('Croccante PRO', 'croccante'); ?></h3></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><h3><?php esc_html_e('Theme Options made with the WP Customizer', 'croccante'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Responsive Design', 'croccante'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Logo Upload', 'croccante'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Unlimited Text and Background Color', 'croccante'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Choose Social Icons', 'croccante'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span> <?php esc_html_e('+ more social buttons', 'croccante'); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('WooCommerce Compatibility', 'croccante'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('WPML Multilingual ready', 'croccante'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('RTL Support', 'croccante'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Sidebar and Footer Widgets', 'croccante'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Loading Page', 'croccante'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span> <?php esc_html_e('1 loader', 'croccante'); ?></td>
						<td><span class="dashicons dashicons-yes"></span> <?php esc_html_e('7 loaders', 'croccante'); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('One Page Template', 'croccante'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span> <?php esc_html_e('+ more sections', 'croccante'); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('One Page additional sections', 'croccante'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span> <?php esc_html_e('Portfolio, Google Map, Numbers, Newsletter, Clients, Testimonials, Video and more...', 'croccante'); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('One Page Section Reorder', 'croccante'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('One Page Template scroll animations', 'croccante'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('One Page choose Slider Height', 'croccante'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Portfolio Template', 'croccante'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Parallax Effect', 'croccante'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Google Fonts switcher', 'croccante'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Manage sidebar position', 'croccante'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Sticky Sidebar', 'croccante'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Post views counter', 'croccante'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('6 Shortcodes', 'croccante'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('9 Exclusive Widgets', 'croccante'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Related Posts Box', 'croccante'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Information About Author Box', 'croccante'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('PowerTip, LightBox, Custom Copyright Text and much more...', 'croccante'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td class="btn-wrapper">
							<a href="<?php echo esc_url( apply_filters( 'croccante_pro_theme_url', 'https://crestaproject.com/demo/croccante-pro/' ) ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'View PRO version demo', 'croccante' ); ?></a>
							<a href="<?php echo esc_url( apply_filters( 'croccante_pro_theme_url', 'https://crestaproject.com/downloads/croccante/' ) ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Get Croccante PRO', 'croccante' ); ?></a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<?php
	}
}
endif;
return new Croccante_Admin();