<?php
/**
 * Web Routes.
 */

use WPEmerge\Facades\Route;

Route::get()->url( '/' )->handle( function() {
	return \WPEmerge\output( 'Hello World!' );
} );
