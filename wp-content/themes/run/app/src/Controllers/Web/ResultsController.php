<?php


namespace App\Controllers\Web;


class ResultsController {
	/**
	 * @param \WPEmerge\Requests\Request $request
	 * @param string $view
	 *
	 * @return \WPEmerge\View\ViewInterface
	 */
	public function index( $request, $view ) {
		$results = $this->get_results();
		if ( ! empty( $results ) ) {
			$data = $this->prepare_results_data( $results );
		}

		return \WPEmerge\view( 'templates/results.twig' )
			->with( [
				'results' => $data,
			] );
	}

	/**
	 * @return int[]|\WP_Post[]
	 */
	private function get_results() {
		$results = get_posts( [
			'numberposts' => - 1,
			'post_type'   => 'result'
		] );

		return $results;
	}

	/**
	 * @param \WP_Post[] $results
	 *
	 * @return array
	 */
	private function prepare_results_data( $results ) {
		$data = [];
		foreach ( $results as $result ) {
			$meta_fields = get_post_meta( $result->ID );
			$data[]      = [
				'ID'            => $result->ID,
				'title'         => $result->post_title,
				'is_pb'         => $meta_fields['_crb_result_is_pb'][0],
				'distance'      => $meta_fields['_crb_result_distance'][0],
				'event_date'    => $meta_fields['_crb_result_event_date'][0],
				'time'          => $meta_fields['_crb_result_time'][0],
				'pace'          => $meta_fields['_crb_result_pace'][0],
				'diff'          => $meta_fields['_crb_result_time_diff'][0],
				'type'          => $meta_fields['_crb_result_type'][0],
				'event_place'   => $meta_fields['_crb_result_event_place'][0],
				'place_overall' => $meta_fields['_crb_result_place_overall'][0],
				'place_gender'  => $meta_fields['_crb_result_place_gender'][0],
				'place_age'     => $meta_fields['_crb_result_place_age'][0],
				'description'   => $meta_fields['_crb_result_description'][0],
				'category'      => $meta_fields['_crb_result_distance_category'][0],
			];
		}

		$sorted_data   = $this->sort_results( $data );
		$prepared_data = $this->prepare_group_data( $sorted_data );

		return $prepared_data;
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

		foreach ( $results as $type => $years ) {
			$prepared_data[ $type ] = [
				'title' => $result_types[ $type ],
				'key'   => $type,
				'count' => $this->get_events_count_by_type( $type, $results ),
				'years' => $years,
				'pb'    => $this->get_personal_best_result_data( $years ),
			];
		}

		return $prepared_data;
	}

	/**
	 * @return array
	 */
	public static function get_result_types() {
		return [
			'marathon'      => __( 'Marathon', 'run' ),
			'half-marathon' => __( 'Half-Marathon', 'run' ),
			'10'            => __( '10km', 'run' ),
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
	 */
	public static function set_personal_best_result( $post_id, $post ) {
		//...
	}
}
