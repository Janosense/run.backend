<?php


namespace App\Controllers\Web;

class StatisticsController {

	/**
	 *
	 */
	public static function update_statistics() {
		self::update_shoes_data();
	}

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
			'crb_pb_1'             => __( '1 km', 'run' ),
			'crb_pb_1m'            => __( '1 mile', 'run' ),
			'crb_pb_5'             => __( '5 km', 'run' ),
			'crb_pb_10'            => __( '10 km', 'run' ),
			'crb_pb_half_marathon' => __( 'Half marathon', 'run' ),
			'crb_pb_marathon'      => __( 'Marathon', 'run' )
		];
	}

	public static function get_shoes() {
		return carbon_get_theme_option( 'crb_shoes' );
	}

	/**
	 *
	 */
	public static function update_shoes_data() {
		$current_shoes_data = self::get_shoes();
		$updated_shoes_data = StravaController::get_shoes_data();
		$shoes_brands       = self::get_shoes_brands();
		$not_used_shoes     = [];
		$used_shoes         = [];

		if ( ! empty( $current_shoes_data ) ) {
			foreach ( $current_shoes_data as $pair ) {
				if ( $pair['used'] == 0 ) {
					$not_used_shoes[] = $pair;
				}
			}
			unset( $pair );
		}

		if ( ! empty( $updated_shoes_data ) ) {
			foreach ( $updated_shoes_data as $pair ) {
				$distance  = round( $pair['distance'] / 1000, 1 );
				$pair_name = self::parse_pair_name( $shoes_brands, $pair['name'] );

				$used_shoes[] = [
					'id'       => $pair['id'],
					'brand'    => $pair_name['brand'],
					'model'    => $pair_name['model'],
					'distance' => $distance,
					'used'     => '1',
				];
			}
			unset( $pair );
		}

		carbon_set_theme_option( 'crb_shoes', array_merge( $used_shoes, $not_used_shoes ) );
	}

	/**
	 * @return array
	 */
	private static function get_shoes_brands() {
		return [
			'HOKA ONE ONE',
			'New Balance',
			'Asics',
			'Saucony',
		];
	}

	/**
	 * @param array $brands
	 * @param string $pair_full_name
	 *
	 * @return array
	 */
	private static function parse_pair_name( $brands, $pair_full_name ) {
		foreach ( $brands as $brand ) {
			if ( strripos( $pair_full_name, $brand ) !== false ) {
				return [
					'brand' => $brand,
					'model' => str_replace( $brand . ' ', '', $pair_full_name ),
				];
			}
		}

		return [];
	}
}
