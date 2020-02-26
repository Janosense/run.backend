<?php

use WPEmerge\Facades\WPEmerge;

/**
 * Constant definitions.
 */
define( 'APP_APP_DIR_NAME', 'app' );
define( 'APP_APP_HELPERS_DIR_NAME', 'helpers' );
define( 'APP_APP_ROUTES_DIR_NAME', 'routes' );
define( 'APP_APP_SETUP_DIR_NAME', 'setup' );
define( 'APP_DIST_DIR_NAME', 'dist' );
define( 'APP_RESOURCES_DIR_NAME', 'source' );
define( 'APP_THEME_DIR_NAME', 'theme' );
define( 'APP_VENDOR_DIR_NAME', 'vendor' );

define( 'APP_DIR', dirname( __DIR__ ) . DIRECTORY_SEPARATOR );
define( 'APP_APP_DIR', APP_DIR . APP_APP_DIR_NAME . DIRECTORY_SEPARATOR );
define( 'APP_APP_HELPERS_DIR', APP_APP_DIR . APP_APP_HELPERS_DIR_NAME . DIRECTORY_SEPARATOR );
define( 'APP_APP_ROUTES_DIR', APP_APP_DIR . APP_APP_ROUTES_DIR_NAME . DIRECTORY_SEPARATOR );
define( 'APP_APP_SETUP_DIR', APP_APP_DIR . APP_APP_SETUP_DIR_NAME . DIRECTORY_SEPARATOR );
define( 'APP_THEME_DIR', APP_DIR . APP_THEME_DIR_NAME . DIRECTORY_SEPARATOR );
define( 'APP_THEME_DIST_DIR', APP_DIR . APP_THEME_DIR_NAME . DIRECTORY_SEPARATOR . APP_DIST_DIR_NAME . DIRECTORY_SEPARATOR );
define( 'APP_THEME_RESOURCES_DIR', APP_DIR . APP_THEME_DIR_NAME . DIRECTORY_SEPARATOR . APP_RESOURCES_DIR_NAME . DIRECTORY_SEPARATOR );
define( 'APP_VENDOR_DIR', APP_DIR . APP_VENDOR_DIR_NAME . DIRECTORY_SEPARATOR );
define( 'APP_THEME_DIR_URI', get_template_directory_uri() . DIRECTORY_SEPARATOR );


/**
 * Load composer dependencies.
 */
if ( file_exists( APP_VENDOR_DIR . 'autoload.php' ) ) {
	require_once APP_VENDOR_DIR . 'autoload.php';
}

/**
 * Load theme text domain
 */
add_action( 'after_setup_theme', function () {
	load_theme_textdomain( 'run', APP_DIR . 'languages' );
} );

/**
 * Bootstrap WP Emerge.
 */
add_action( 'after_setup_theme', function () {
	WPEmerge::bootstrap( require APP_APP_DIR . 'config.php' );
} );

/**
 * Load helpers.
 */
require_once APP_APP_DIR . 'helpers.php';

/**
 * Register hooks.
 */
require_once APP_APP_DIR . 'hooks.php';
