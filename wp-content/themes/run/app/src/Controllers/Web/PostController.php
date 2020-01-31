<?php


namespace App\Controllers\Web;


class PostController {
	public function index( $request, $view ) {
		return \WPEmerge\view( 'templates/post.twig' );
	}
}
