<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package croccante
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php if(croccante_options('_show_loader', '0') == 1 ) : ?>
	<div class="croccanteLoader">
		<?php croccante_loadingPage(); ?>
	</div>
<?php endif; ?>
<div class="border-fixed border-left"></div>
<div class="border-fixed border-right"></div>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'croccante' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="mainLogo">
			<div class="croccanteSubHeader">
				<div class="site-branding">
					<?php
					if ( function_exists( 'the_custom_logo' ) ) : ?>
						<div class="croccanteLogo" itemscope itemtype="http://schema.org/Organization">
							<?php the_custom_logo(); ?>
						</div>
					<?php endif; ?>
					<div class="croccanteTitleText">
						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php else : ?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php
						endif;

						$description = get_bloginfo( 'description', 'display' );
						if ( $description || is_customize_preview() ) : ?>
							<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
						<?php
						endif; ?>
					</div>
				</div><!-- .site-branding -->
			</div><!-- .miseSubHeader -->
		</div><!-- .mainLogo -->
		<?php if ( is_active_sidebar( 'sidebar-push' ) ) : ?>
			<div id="push-nav"><span></span><span></span><span></span><span></span></div>
		<?php endif; ?>
		<?php $showSearchButton = croccante_options('_search_button', '1');
		if ($showSearchButton) : ?>
			<div class="icon-search"><span></span></div>
		<?php endif; ?>
		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><i class="fa fa-lg fa-bars spaceRight" aria-hidden="true"></i><?php esc_html_e( 'Menu', 'croccante' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu' ) ); ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
