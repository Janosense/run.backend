<?php


namespace App\Controllers\Web;


class StravaController {

	static $api_base = 'https://www.strava.com/api/v3/';
	static $api_endpoints = [
		'athlete' => 'athlete',
	];

	static public function get_shoes() {
		$url          = self::$api_base . self::$api_endpoints['athlete'];
		$access_token = get_option( 'strava_access_token' );
		$args         = [
			'timeout'     => 45,
			'redirection' => 5,
			'headers'     => [
				'Authorization' => 'Bearer ' . $access_token,
			],
		];

		$response = wp_remote_get( $url, $args );
		$shoes    = [];

		if ( ! is_wp_error( $response ) && $response['response']['code'] == 200 ) {
			$response_body = json_decode( $response['body'], true );
			if ( isset( $response_body['shoes'] ) && ! empty( $response_body['shoes'] ) ) {
				foreach ( $response_body['shoes'] as $shoe ) {
					$shoes[] = [
						'name'     => $shoe['name'],
						'distance' => $shoe['distance'],
					];
				}
			}
		}

		return $shoes;
	}
}
