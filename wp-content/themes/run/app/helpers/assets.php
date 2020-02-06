<?php
/**
 * Asset helpers.
 *
 * @package WPEmergeTheme
 */


/**
 * Enqueue admin assets.
 *
 * @return void
 */
function app_action_admin_enqueue_assets() {
	$theme_version = wp_get_theme()->get( 'Version' );

	/**
	 * Enqueue styles.
	 */
	wp_enqueue_style( 'admin-custom-styles', APP_THEME_DIR_URI . 'dist/styles/admin.css', [], $theme_version );
	wp_enqueue_script( 'admin-imask', APP_THEME_DIR_URI . 'dist/scripts/admin.js', [], $theme_version, true );
}
