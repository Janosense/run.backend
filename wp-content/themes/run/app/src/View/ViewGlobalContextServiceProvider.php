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
		$is_admin      = current_user_can( 'manage_options' );
		$site_title    = get_bloginfo( 'name' );

		View::addGlobals( [
			'routes'        => $routes,
			'theme_version' => $theme_version,
			'is_admin'      => $is_admin,
			'site_title'    => $site_title,
		] );
	}
}
