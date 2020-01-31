<?php


namespace App\Controllers\Web;


class AboutController {
	public function index( $request, $view ) {
		return \WPEmerge\view( 'templates/about.twig' );
	}
}
