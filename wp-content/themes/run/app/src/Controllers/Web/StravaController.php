<?php


namespace App\Controllers\Web;


class StravaController {

	static private $api_base = 'https://www.strava.com/api/v3/';
	static private $api_endpoints = [
		'athlete'            => 'athlete',
		'athlete_stats'      => 'athletes/{id}/stats',
		'athlete_activities' => 'athlete/activities',
		'activity'           => 'activities/{id}/',
	];

	/**
	 * @return array|\WP_Error
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

			return $shoes;
		}

		return new \WP_Error( $response['response']['code'], $response['response']['message'] );
	}


	/**
	 * @return array|\WP_Error
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

		$response   = wp_remote_get( $url, $args );
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

			return $stats_data;
		}

		return new \WP_Error( $response['response']['code'], $response['response']['message'] );
	}


	/**
	 * @param int $items_count
	 *
	 * @return array|\WP_Error
	 */
	public static function get_activities_list_data( $items_count = 7 ) {
		$access_token = get_option( 'strava_access_token' );
		$url          = self::$api_base . self::$api_endpoints['athlete_activities'];
		$args         = [
			'timeout'     => 45,
			'redirection' => 5,
			'headers'     => [
				'Authorization' => 'Bearer ' . $access_token,
			],
			'body'        => [
				'per_page' => $items_count
			]
		];

		$response = wp_remote_get( $url, $args );

		if ( ! is_wp_error( $response ) && $response['response']['code'] == 200 ) {
			return json_decode( $response['body'], true );
		}

		return new \WP_Error( $response['response']['code'], $response['response']['message'] );
	}


	/**
	 * @param int $id
	 *
	 * @return mixed|\WP_Error
	 */
	public static function get_activity_data( $id ) {
		$access_token = get_option( 'strava_access_token' );
		$url          = self::$api_base . str_replace( '{id}', $id, self::$api_endpoints['activity'] );
		$args         = [
			'timeout'     => 45,
			'redirection' => 5,
			'headers'     => [
				'Authorization' => 'Bearer ' . $access_token,
			],
		];

		$response = wp_remote_get( $url, $args );

		if ( ! is_wp_error( $response ) && $response['response']['code'] == 200 ) {
			return json_decode( $response['body'], true );
		}

		return new \WP_Error( $response['response']['code'], $response['response']['message'] );
	}

	/**
	 * Updated all Strava data
	 */
	static public function update_data() {
		// Statistics
		StatisticsController::update_shoes_data();
		StatisticsController::update_athlete_stats_data();

		// Trainings
		TrainingsController::update_activities_list_data();
	}

	/**
	 * @param \WPEmerge\Requests\Request $request
	 * @param string $view
	 *
	 * @return \Psr\Http\Message\ResponseInterface
	 */
	static public function manual_update_data( $request, $view ) {
		if ( $request->get( 'access_code' ) === APP_ACCESS_CODE && current_user_can( 'manage_options' ) ) {
			self::update_data();

			return \WPEmerge\redirect()->to( home_url( '/' ) );
		} else {

			return \WPEmerge\output( 'Access denied.' );
		}
	}

	/**
	 * @param $request
	 * @param $view
	 */
	static public function get_all_activities( $request, $view ) {
		$access_token = get_option( 'strava_access_token' );
		$url          = self::$api_base . self::$api_endpoints['athlete_activities'] . '?per_page=100&page=' . $request->get( 'page1' );
		$args         = [
			'timeout'     => 45,
			'redirection' => 5,
			'headers'     => [
				'Authorization' => 'Bearer ' . $access_token,
			],
		];

		$response = wp_remote_get( $url, $args );
		$data     = [];
		if ( ! is_wp_error( $response ) ) {
			$data = json_decode( $response['body'], true );

			foreach ( $data as $activity ) {
				if ( isset( $activity['type'] ) && $activity['type'] == 'Run' ) {
					$activity_date = date_create( $activity['start_date_local'] );
					$post_date     = date_format( $activity_date, 'Y-m-d H:i:s' );

					$post_data = [
						'post_title'  => $activity['name'],
						'post_type'   => 'training',
						'post_status' => 'publish',
						'post_date'   => $post_date,
					];

					$post_id = wp_insert_post( wp_slash( $post_data ) );

					add_post_meta( $post_id, 'id', $activity['id'], true );
					add_post_meta( $post_id, 'start_date_local', $activity['start_date_local'], true );
					add_post_meta( $post_id, 'start_date_timestamp', date_timestamp_get( $activity_date ), true );
					add_post_meta( $post_id, 'distance', $activity['distance'], true );
					add_post_meta( $post_id, 'moving_time', $activity['moving_time'], true );
					add_post_meta( $post_id, 'elapsed_time', $activity['elapsed_time'], true );
					add_post_meta( $post_id, 'total_elevation_gain', $activity['total_elevation_gain'], true );
					add_post_meta( $post_id, 'average_heartrate', $activity['average_heartrate'], true );
					add_post_meta( $post_id, 'average_cadence', $activity['average_cadence'], true );
					add_post_meta( $post_id, 'gear_id', $activity['gear_id'], true );

					$pace = $activity['moving_time'] / $activity['distance'] * 1000;
					$pace = ( ( $pace / 60 ) % 60 ) . ':' . str_pad( round( ( ( $pace / 60 ) - ( $pace / 60 ) % 60 ) * 0.6, 2 ) * 100, 2, "0", STR_PAD_LEFT );
					add_post_meta( $post_id, 'pace', $pace, true );
				}
			}
		}

		return \WPEmerge\output( count( $data ) );
	}
}
