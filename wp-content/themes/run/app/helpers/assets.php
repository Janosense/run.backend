<?php
/**
 * Asset helpers.
 *
 * @package WPEmergeTheme
 */

use WPEmergeTheme\Facades\Assets;


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
	wp_enqueue_style( 'admin-custom-styles', APP_THEME_DIR_URI . 'dist/styles/admin.css', [], $theme_version);
}
