<?php
/**
 * The push sidebar.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package croccante
 */
 
if ( ! is_active_sidebar( 'sidebar-push' ) ) {
	return;
}
?>
<div class="opacityBox"></div>
<aside id="tertiary" class="widget-area nano">
	<div class="nano-content"><?php dynamic_sidebar( 'sidebar-push' ); ?></div>
</aside><!-- #secondary -->