<?php


namespace App\Controllers\Web;

use App\Controllers\Web\StravaController;


class StatisticsController {

	/**
	 * @return array
	 */
	public static function get_personal_best_results() {
		$results = [];
		$fields  = self::get_personal_best_fields();

		foreach ( $fields as $field_key => $field_title ) {
			$results[ $field_key ] = [
				'title' => $field_title,
				'value' => carbon_get_theme_option( $field_key ),
			];
		}

		return $results;
	}

	/**
	 * @return array
	 */
	public static function get_personal_best_fields() {
		return [
			'crb_pb_1'           => __( '1 km', 'run' ),
			'crb_pb_1m'         => __( '1 mile', 'run' ),
			'crb_pb_5'           => __( '5 km', 'run' ),
			'crb_pb_10'          => __( '10 km', 'run' ),
			'crb_pb_half_marathon' => __( 'Half marathon', 'run' ),
			'crb_pb_marathon'      => __( 'Marathon', 'run' )
		];
	}
}
