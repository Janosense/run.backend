<?php
/**
 * Web Routes.
 *
 * @link https://docs.wpemerge.com/#/framework/routing/methods
 *
 * @package WPEmergeTheme
 * @throws \WPEmerge\Exceptions\Exception
 */

use WPEmerge\Facades\Route;

$routes = require APP_APP_DIR . 'routes.php';

foreach ( $routes['web'] as $route ) {
	if ( ! isset( $route['condition'] ) && empty( $route['condition'] ) ) {
		throw new Exception( 'Route \'condition\' field is empty or not defined' );
	}

	switch ( $route['condition'] ) {
		case 'url':
			Route::get()->url( $route['url'] )->handle( $route['handle'] );
			break;
		case 'where':
			Route::get()->where( $route['field'], $route['value'] )->handle( $route['handle'] );
			break;
	}
}



