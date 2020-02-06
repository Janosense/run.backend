<?php


namespace App\Controllers\Web;


class FrontPageController {
	/**
	 * @param \WPEmerge\Requests\Request $request
	 * @param string $view
	 *
	 * @return \WPEmerge\View\ViewInterface
	 */
	public function index( $request, $view ) {
		return \WPEmerge\view( 'templates/front-page.twig' );
	}
}
