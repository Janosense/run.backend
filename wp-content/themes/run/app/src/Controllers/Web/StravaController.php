<?php


namespace App\Controllers\Web;


class StravaController {

	static private $api_base = 'https://www.strava.com/api/v3/';
	static private $api_endpoints = [
		'athlete'       => 'athlete',
		'athlete_stats' => '/athletes/{id}/stats',
	];

	/**
	 * @return array
	 */
	static public function get_shoes_data() {
		$access_token = get_option( 'strava_access_token' );
		$url          = self::$api_base . self::$api_endpoints['athlete'];
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

	/**
	 *
	 */
	static public function get_athlete_stats_data() {
		$athlete_id   = get_option( 'strava_athlete_id' );
		$access_token = get_option( 'strava_access_token' );
		$url          = self::$api_base . str_replace( '{id}', $athlete_id, self::$api_endpoints['athlete_stats'] );
		$args         = [
			'timeout'     => 45,
			'redirection' => 5,
			'headers'     => [
				'Authorization' => 'Bearer ' . $access_token,
			],
		];

		$response        = wp_remote_get( $url, $args );
		$stats_data = [];

		if ( ! is_wp_error( $response ) && $response['response']['code'] == 200 ) {
			$response_body = json_decode( $response['body'], true );

			if ( isset( $response_body['recent_run_totals'] ) && ! empty( $response_body['recent_run_totals'] ) ) {
				$stats_data['recent_run_totals'] = $response_body['recent_run_totals'];
			}

			if ( isset( $response_body['ytd_run_totals'] ) && ! empty( $response_body['ytd_run_totals'] ) ) {
				$stats_data['ytd_run_totals'] = $response_body['ytd_run_totals'];
			}

			if ( isset( $response_body['all_run_totals'] ) && ! empty( $response_body['all_run_totals'] ) ) {
				$stats_data['all_run_totals'] = $response_body['all_run_totals'];
			}

			foreach ( $stats_data as $key => $value ) {
				$stats_data[ $key ]['distance'] = round( $value['distance'] / 1000, 0 );
				unset( $stats_data[ $key ]['moving_time'] );
				unset( $stats_data[ $key ]['elapsed_time'] );
			}
		}

		return $stats_data;
	}
}
