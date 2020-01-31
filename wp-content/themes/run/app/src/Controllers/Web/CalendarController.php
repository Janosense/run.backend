<?php


namespace App\Controllers\Web;


class CalendarController {
	public function index( $request, $view ) {
		return \WPEmerge\view( 'templates/calendar.twig' );
	}
}
