<?php


namespace App\Controllers\Web;


class HistoryController {
	/**
	 * @param $request
	 * @param $view
	 *
	 * @return \WPEmerge\View\ViewInterface
	 */
	public function index( $request, $view ) {
		return \WPEmerge\view( 'templates/history.twig' );
	}
}
