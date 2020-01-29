<?php

use WPEmerge\Facades\WPEmerge;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Twig\TwigFilter;

/**
 * Constant definitions.
 */
define( 'APP_APP_DIR_NAME', 'app' );
define( 'APP_APP_HELPERS_DIR_NAME', 'helpers' );
define( 'APP_APP_ROUTES_DIR_NAME', 'routes' );
define( 'APP_APP_SETUP_DIR_NAME', 'setup' );
define( 'APP_DIST_DIR_NAME', 'dist' );
define( 'APP_RESOURCES_DIR_NAME', 'resources' );
define( 'APP_THEME_DIR_NAME', 'theme' );
define( 'APP_VENDOR_DIR_NAME', 'vendor' );

define( 'APP_DIR', dirname( __DIR__ ) . DIRECTORY_SEPARATOR );
define( 'APP_APP_DIR', APP_DIR . APP_APP_DIR_NAME . DIRECTORY_SEPARATOR );
define( 'APP_APP_HELPERS_DIR', APP_APP_DIR . APP_APP_HELPERS_DIR_NAME . DIRECTORY_SEPARATOR );
define( 'APP_APP_ROUTES_DIR', APP_APP_DIR . APP_APP_ROUTES_DIR_NAME . DIRECTORY_SEPARATOR );
define( 'APP_APP_SETUP_DIR', APP_APP_DIR . APP_APP_SETUP_DIR_NAME . DIRECTORY_SEPARATOR );
define( 'APP_DIST_DIR', APP_DIR . APP_DIST_DIR_NAME . DIRECTORY_SEPARATOR );
define( 'APP_RESOURCES_DIR', APP_DIR . APP_RESOURCES_DIR_NAME . DIRECTORY_SEPARATOR );
define( 'APP_THEME_DIR', APP_DIR . APP_THEME_DIR_NAME . DIRECTORY_SEPARATOR );
define( 'APP_VENDOR_DIR', APP_DIR . APP_VENDOR_DIR_NAME . DIRECTORY_SEPARATOR );


/**
 * Load composer dependencies.
 */
if ( file_exists( APP_VENDOR_DIR . 'autoload.php' ) ) {
	require_once APP_VENDOR_DIR . 'autoload.php';
}

/**
 * Bootstrap WP Emerge.
 */
add_action( 'after_setup_theme', function () {
	WPEmerge::bootstrap( require APP_APP_DIR . 'config.php' );

	$myfilter = new TwigFilter( 'myfilter', function( $string ) {
		return call_user_func( $string );
	} );

// WPEmerge::resolve() used for brevity's sake - use a Service Provider instead.
	$twig = WPEmerge::resolve( WPEMERGETWIG_VIEW_TWIG_VIEW_ENGINE_KEY );
	$twig->environment()->addFilter( $myfilter );
} );


//class AppExtension extends AbstractExtension
//{
//	public function getFunctions()
//	{
//		return [
//			new TwigFunction('function', array(&$this, 'exec_function')),
//		];
//	}
//}
