<?php
/**
 * Web Routes.
 */

use WPEmerge\Facades\Route;

//Route::get()->url( '/' )->handle( function() {
//	return \WPEmerge\output( 'Hello World!' );
//} );

Route::get()->url( '/' )->handle(function($request) {
	\WPEmerge\render('templates/template-cta.php', ['skip_url' => add_query_arg( 'cta', '1', $request->getUrl())]);
});

Route::get()->url( '/test' )->handle( 'TestController@index' );
