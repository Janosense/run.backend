<?php


namespace App\Controllers\Web;

use Carbon_Fields\Container\Post_Meta_Container;


class ResultsController {
	/**
	 * @param \WPEmerge\Requests\Request $request
	 * @param string $view
	 *
	 * @return \WPEmerge\View\ViewInterface
	 */
	public function index( $request, $view ) {
		$data    = [];
		$results = $this->get_results();
		if ( ! empty( $results ) ) {
			$data = $this->prepare_results_data( $results, true );
		}

		return \WPEmerge\view( 'templates/results.twig' )
			->with( [
				'results' => $data,
			] );
	}

	/**
	 * @param int $items_count
	 *
	 * @return int[]|\WP_Post[]
	 *
	 */
	private function get_results( $items_count = - 1 ) {
		return get_posts( [
			'numberposts' => $items_count,
			'post_type'   => 'result'
		] );
	}

	/**
	 * @param \WP_Post[] $results
	 * @param boolean $sort
	 *
	 * @return array
	 */
	private function prepare_results_data( $results, $sort = true ) {
		$data = [];
		foreach ( $results as $result ) {
			$meta_fields = get_post_meta( $result->ID );
			$time        = str_replace( "00:", "", $meta_fields['_crb_result_time'][0] );
			$event_date  = date_format( date_create( $meta_fields['_crb_result_event_date'][0] ), 'd.m.Y' );

			$data[] = [
				'ID'            => $result->ID,
				'title'         => $result->post_title,
				'is_pb'         => $meta_fields['_crb_result_is_pb'][0],
				'distance'      => $meta_fields['_crb_result_distance'][0],
				'event_date'    => $event_date,
				'time'          => $time,
				'pace'          => $meta_fields['_crb_result_pace'][0],
				'diff'          => $meta_fields['_crb_result_time_diff'][0],
				'type'          => $meta_fields['_crb_result_type'][0],
				'event_place'   => $meta_fields['_crb_result_event_place'][0],
				'organizer'     => $meta_fields['_crb_result_event_organizer'][0],
				'place_overall' => $meta_fields['_crb_result_place_overall'][0],
				'place_gender'  => $meta_fields['_crb_result_place_gender'][0],
				'place_age'     => $meta_fields['_crb_result_place_age'][0],
				'description'   => $meta_fields['_crb_result_description'][0],
				'category'      => $meta_fields['_crb_result_distance_category'][0],
			];
		}

		if ( $sort == true ) {
			$data = $this->sort_results( $data );
			$data = $this->prepare_group_data( $data );
		}

		return $data;
	}

	/**
	 * @param array $results
	 *
	 * @return array
	 */
	private function sort_results( $results ) {
		$data = $this->sort_results_by_type( $results );
		$data = $this->sort_results_type_by_year( $data );

		return $data;
	}

	/**
	 * @param array $results
	 *
	 * @return array
	 */
	private function sort_results_by_type( $results ) {
		$data = [];
		foreach ( $results as $result ) {
			$data[ $result['type'] ][] = $result;
		}

		return $data;
	}

	/**
	 * @param array $results
	 *
	 * @return array
	 */
	private function sort_results_type_by_year( $results ) {
		$data = [];
		foreach ( $results as $type => $type_results ) {
			$sorted_type = [];
			foreach ( $type_results as $result ) {
				$timestamp                      = strtotime( $result['event_date'] );
				$date                           = getdate( $timestamp );
				$sorted_type[ $date['year'] ][] = $result;
			}

			uksort( $sorted_type, function ( $key_1, $key_2 ) {
				return $key_2 <=> $key_1;
			} );

			$data[ $type ] = $sorted_type;
		}

		return $data;
	}

	/**
	 * @param array $results
	 *
	 * @return array
	 */
	private function prepare_group_data( $results ) {
		$prepared_data = [];
		$result_types  = $this->get_result_types();

		foreach ( $result_types as $result_type_key => $result_type_value ) {
			$prepared_data[ $result_type_key ] = [];
		}

		foreach ( $results as $type => $years ) {
			$prepared_data[ $type ] = [
				'title' => $result_types[ $type ],
				'key'   => $type,
				'count' => $this->get_events_count_by_type( $type, $results ),
				'years' => $years,
				'pb'    => $this->get_personal_best_result_data( $years ),
			];
		}

		foreach ( $prepared_data as $group => $data ) {
			if ( empty( $data ) ) {
				unset( $prepared_data[ $group ] );
			}
		}

		return $prepared_data;
	}

	/**
	 * @return array
	 */
	public static function get_result_types() {
		return [
			'marathon'      => __( 'Marathon', 'run' ),
			'half_marathon' => __( 'Half marathon', 'run' ),
			'10'            => __( '10 km', 'run' ),
			'trail'         => __( 'Trail', 'run' ),
			'ocr'           => __( 'OCR', 'run' ),
			'other'         => __( 'Other', 'run' ),
		];
	}

	/**
	 * @param array $years
	 *
	 * @return array
	 */
	private function get_personal_best_result_data( $years ) {
		foreach ( $years as $results ) {
			foreach ( $results as $result ) {
				if ( $result['is_pb'] == true ) {
					return [
						'time'        => $result['time'],
						'event_title' => $result['title'],
						'event_date'  => $result['event_date'],
					];
				}
			}
		}

		return [];
	}

	/**
	 * @param string $type
	 * @param array $results
	 *
	 * @return integer
	 */
	private function get_events_count_by_type( $type, $results ) {
		$count = 0;
		foreach ( $results[ $type ] as $year ) {
			$count += count( $year );
		}

		return $count;
	}

	/**
	 *
	 * Fire on result post object added/updated
	 *
	 * @param int $post_id
	 * @param Post_Meta_Container $container
	 */
	public static function set_personal_best_result( $post_id, $container ) {
		if ( $container->id == 'carbon_fields_container_result_data' ) {
			$pb_result_id        = $post_id;
			$current_result_type = carbon_get_post_meta( $post_id, 'crb_result_type' );

			if ( $current_result_type != 'ocr' && $current_result_type != 'trail' ) {
				$pb_result_time            = carbon_get_post_meta( $post_id, 'crb_result_time' );
				$pb_result_time_in_seconds = self::convert_time_to_seconds( $pb_result_time );
				$results                   = get_posts( [
					'numberposts' => - 1,
					'post_type'   => 'result',
					'meta_query'  => [
						[
							'key'   => '_crb_result_type',
							'value' => $current_result_type,
						]
					]
				] );

				foreach ( $results as $result ) {
					update_post_meta( $result->ID, '_crb_result_is_pb', 0 );
					$result_time            = carbon_get_post_meta( $result->ID, 'crb_result_time' );
					$result_time_in_seconds = self::convert_time_to_seconds( $result_time );

					if ( $result_time_in_seconds < $pb_result_time_in_seconds ) {
						$pb_result_id              = $result->ID;
						$pb_result_time            = $result_time;
						$pb_result_time_in_seconds = self::convert_time_to_seconds( $pb_result_time );
					}
				}

				update_post_meta( $pb_result_id, '_crb_result_is_pb', 1 );
				update_option( '_crb_pb_' . $current_result_type, str_replace( "00:", "", $pb_result_time ) );
			}
		}
	}

	/**
	 * @param string $time
	 *
	 * @return int|\WP_Error
	 */
	private static function convert_time_to_seconds( $time ) {
		$seconds       = 0;
		$time_exploded = explode( ':', $time );
		if ( count( $time_exploded ) != 3 ) {
			return new \WP_Error();
		}

		$seconds += (int) $time_exploded[0] * 60 * 60;
		$seconds += (int) $time_exploded[1] * 60;
		$seconds += (float) $time_exploded[2];

		return $seconds;
	}

	/**
	 * @param int $items_count
	 *
	 * @return array
	 */
	public function get_last_results( $items_count = 5 ) {
		$data    = [];
		$results = $this->get_results();

		if ( ! empty( $results ) ) {
			$data = $this->prepare_results_data( $results, false );
			$data = $this->sort_results_by_event_date( $data );
		}

		return array_slice( $data, 0, $items_count );
	}

	/**
	 * @param array $results
	 *
	 * @return array
	 */
	private function sort_results_by_event_date( $results ) {
		usort( $results, function ( $result_1, $result_2 ) {
			return ( strtotime( $result_2['event_date'] ) <=> strtotime( $result_1['event_date'] ) );
		} );

		return $results;
	}
}
