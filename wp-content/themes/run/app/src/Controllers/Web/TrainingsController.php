<?php


namespace App\Controllers\Web;


class TrainingsController {


	/**
	 * @return mixed|void
	 */
	public static function get_activities_list() {
		return get_option( 'strava_activities_list' );
	}


	/**
	 *
	 */
	public static function update_activities_list_data() {
		$activities_list_data = StravaController::get_activities_list_data( 10 );
		if ( ! empty( $activities_list_data ) && ! is_wp_error( $activities_list_data ) ) {
			$data = self::prepare_activities_list_data( $activities_list_data );
			update_option( 'strava_activities_list', $data );
		}
	}

	/**
	 * @param array $data
	 *
	 * @return array
	 */
	private static function prepare_activities_list_data( $data ) {
		$prepared_data = [];

		if ( ! empty( $data ) && ! is_wp_error( $data ) ) {

			foreach ( $data as $activity ) {
				$activity_data = StravaController::get_activity_data( $activity['id'] );

				if ( $activity_data['type'] == 'Run' ) {
					$moving_time = gmdate( "H:i:s", $activity_data['moving_time'] );
					$pace        = gmdate( "i:s", $activity_data['moving_time'] / ( $activity_data['distance'] / 1000 ) );
					$distance    = round( $activity_data['distance'] / 1000, 2 );
					$date        = date_format( date_create( $activity_data['start_date'] ), 'd.m.Y' );

					$prepared_data[] = [
						'id'                   => $activity['id'],
						'name'                 => $activity_data['name'],
						'date'                 => $date,
						'description'          => $activity_data['description'],
						'distance'             => $distance,
						'calories'             => $activity_data['calories'],
						'average_heartrate'    => $activity_data['average_heartrate'],
						'average_cadence'      => $activity_data['average_cadence'],
						'total_elevation_gain' => $activity_data['total_elevation_gain'],
						'moving_time'          => $moving_time,
						'pace'                 => $pace,
						'shoes'                => $activity_data['gear']['name']
					];
				}
			}
		}

		return $prepared_data;
	}
}
