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
use App\Controllers\Web\StravaController;

/**
 * Main routes
 */
$routes = require APP_APP_SETUP_DIR . 'routes.php';

foreach ( $routes['web'] as $route ) {
	if ( ! isset( $route['condition'] ) && empty( $route['condition'] ) ) {
		throw new Exception( 'Route \'condition\' field is empty or not defined' );
	}

	switch ( $route['condition'] ) {
		case 'url':
			if ( isset( $route['match'] ) ) {
				Route::get()->url( $route['url'], $route['match'] )->handle( $route['handle'] );
			} else {
				Route::get()->url( $route['url'] )->handle( $route['handle'] );
			}
			break;
		case 'where':
			Route::get()->where( $route['field'], $route['value'] )->handle( $route['handle'] );
			break;
	}
}

/**
 * Auxiliary routes
 */

// Route for manual strava statistics update
Route::get()->url( '/update_strava_data/' )->handle( StravaController::class . '@manual_update_data' );



