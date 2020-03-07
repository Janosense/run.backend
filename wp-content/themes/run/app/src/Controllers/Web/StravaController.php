<?php


namespace App\Controllers\Web;


class StravaController {

	static $api_base = 'https://www.strava.com/api/v3/';
	static $api_endpoints = [
		'athlete' => 'athlete',
	];

	/**
	 * @return array
	 */
	static public function get_shoes_data() {
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
				foreach ( $response_body['shoes'] as $pair ) {
					$shoes[] = [
						'id'       => $pair['id'],
						'name'     => $pair['name'],
						'distance' => $pair['distance'],
					];
				}
			}
		}

		return $shoes;
	}
}
