<?php


namespace App\Controllers\Web;


class ArticlesController {
	public function index( $request, $view ) {
		return \WPEmerge\view( 'templates/articles.twig' );
	}
}
