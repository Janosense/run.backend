<?php


namespace App\Controllers\Web;


class ResultsController {
	public function index( $request, $view ) {
		return \WPEmerge\view( 'templates/results.twig' );
	}
}
