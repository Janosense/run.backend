<?php
/**
 * Web Routes.
 */

use WPEmerge\Facades\Route;

//$routes = [
//	'/'         => 'templates/front-page.twig',
//	'/calendar' => 'templates/calendar.twig',
//	'/results'  => 'templates/results.twig',
//	'/history'  => 'templates/history.twig',
//];
//
//foreach ($routes as $url => $template) {
//	global $template;
//	Route::get()->url( $url )->handle( function () {
//		return \WPEmerge\view( $template );
//	} );
//}

Route::get()->where( 'post_type', 'post' )->handle(function () {
	return \WPEmerge\view( 'templates/post.twig' );
} );

Route::get()->url( '/' )->handle( function () {
	return \WPEmerge\view( 'templates/front-page.twig' );
} );

Route::get()->url( '/calendar' )->handle( function () {
	return \WPEmerge\view( 'templates/calendar.twig' );
} );

Route::get()->url( '/results' )->handle( function () {
	return \WPEmerge\view( 'templates/results.twig' );
} );

Route::get()->url( '/history' )->handle( function () {
	return \WPEmerge\view( 'templates/history.twig' );
} );

Route::get()->url( '/articles' )->handle( function () {
	return \WPEmerge\view( 'templates/articles.twig' );
} );

Route::get()->url( '/about' )->handle( function () {
	return \WPEmerge\view( 'templates/about.twig' );
} );



