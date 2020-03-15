<?php

namespace App\View;

use WPEmerge\Facades\View;
use WPEmerge\ServiceProviders\ServiceProviderInterface;

class ViewGlobalContextServiceProvider implements ServiceProviderInterface {
	/**
	 * {@inheritDoc}
	 */
	public function register( $container ) {
	}

	/**
	 * {@inheritDoc}
	 */
	public function bootstrap( $container ) {
		$routes        = require APP_APP_SETUP_DIR . 'routes.php';
		$theme_version = wp_get_theme()->get( 'Version' );

		View::addGlobals( [
			'routes'        => $routes,
			'theme_version' => $theme_version,
		] );
	}
}
