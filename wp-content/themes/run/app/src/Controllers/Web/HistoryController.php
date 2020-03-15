<?php

namespace App\Controllers\Web;


class HistoryController {
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
			$data = $this->prepare_results_data( $results );
		}

		return \WPEmerge\view( 'templates/history.twig' )->with( [
			'data' => $data
		] );
	}

	/**
	 * @return \WP_Post[]
	 */
	private function get_results() {
		return get_posts( [
			'numberposts' => - 1,
			'post_type'   => 'result'
		] );
	}

	private function prepare_results_data( $results ) {
		$data = [];
		foreach ( $results as $result ) {
			$meta_fields = get_post_meta( $result->ID );
			$event_date  = date_format( date_create( $meta_fields['_crb_result_event_date'][0] ), 'd.m.Y' );
			$time        = str_replace( "00:", "", $meta_fields['_crb_result_time'][0] );

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

		$data = $this->sort_results_by_year( $data );

		return $data;
	}

	/**
	 * @param array $results
	 *
	 * @return array
	 */
	private function sort_results_by_year( $results ) {
		$data = [];
		usort( $results, function ( $result_1, $result_2 ) {
			return ( strtotime( $result_2['event_date'] ) <=> strtotime( $result_1['event_date'] ) );
		} );

		foreach ( $results as $result ) {
			$timestamp               = strtotime( $result['event_date'] );
			$date                    = getdate( $timestamp );
			$data[ $date['year'] ][] = $result;
		}

		return $data;
	}
}
