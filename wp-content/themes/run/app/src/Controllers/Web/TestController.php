<?php


namespace App\Controllers\Web;

use \WPEmerge\Facades\WPEmerge;


class TestController {


	/**
	 * @param WPEmerge $request
	 * @param $view
	 *
	 * @return \WPEmerge\View\ViewInterface
	 */
	public function index( $request, $view ) {
		// $request is a WP Emerge class which represents the current request
		// made to the server.
		// $view is the view file that WordPress is trying to load for the
		// current request.

		if ( $request->get( 'cta' ) === '0' ) {
			return \WPEmerge\view( $view );
		}

		$skip_url = add_query_arg( 'cta', '0', $request->getUrl() );

		return \WPEmerge\view( 'templates/template-cta.php' )
			->with( 'skip_url', $skip_url );
	}
}
