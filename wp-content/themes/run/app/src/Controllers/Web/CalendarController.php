<?php


namespace App\Controllers\Web;


class CalendarController {

	/**
	 * @param \WPEmerge\Requests\Request $request
	 * @param string $view
	 *
	 * @return \WPEmerge\View\ViewInterface
	 */
	public function index( $request, $view ) {
		$data   = [];
		$events = $this->get_events();

		if ( ! empty( $events ) ) {
			$data = $this->prepare_events_data( $events );
		}

		return \WPEmerge\view( 'templates/calendar.twig' )->with( [
			'events' => $data,
		] );
	}

	/**
	 * @param \WP_Post[] $events
	 *
	 * @return array
	 */
	private function prepare_events_data( $events ) {
		$data        = [];
		$event_types = self::get_event_types();
		foreach ( $events as $event ) {
			$meta_fields = get_post_meta( $event->ID );
			$date        = date_format( date_create( $meta_fields['_crb_event_date'][0] ), 'd.m.Y' );

			$data[] = [
				'ID'        => $event->ID,
				'title'     => $event->post_title,
				'state'     => $meta_fields['_crb_event_state'][0],
				'date'      => $date,
				'type'      => $event_types[ $meta_fields['_crb_event_type'][0] ],
				'organizer' => $meta_fields['_crb_event_organizer'][0],
				'distance'  => $meta_fields['_crb_event_distance'][0],
				'place'     => $meta_fields['_crb_event_place'][0],
				'bib'       => $meta_fields['_crb_event_bib'][0],
				'url'       => $meta_fields['_crb_event_url'][0],
			];
		}

		$data = $this->sort_events_by_state( $data );
		$data = $this->sort_events_by_date( $data );
		$data = $this->prepare_states_data( $data );

		return $data;
	}

	/**
	 * @param array $data
	 *
	 * @return array
	 */
	private function prepare_states_data( $data ) {
		$prepared_data = [];
		$event_states  = self::get_event_states();
		foreach ( $data as $state => $events ) {
			$prepared_data[ $state ] = [
				'title'  => $event_states[ $state ],
				'type'   => $state,
				'events' => $events,
			];
		}

		return $prepared_data;
	}

	private function get_events() {
		return get_posts( [
			'numberposts' => - 1,
			'post_type'   => 'event',
		] );
	}

	/**
	 * @param array $data
	 *
	 * @return array
	 */
	private function sort_events_by_state( $data ) {
		$sorted_data = [];
		foreach ( $data as $event ) {
			$sorted_data[ $event['state'] ][] = $event;
		}

		return $sorted_data;
	}

	/**
	 * @param array $data
	 *
	 * @return array
	 */
	private function sort_events_by_date( $data ) {
		foreach ( $data as $state => $events ) {
			usort( $data[ $state ], function ( $event_1, $event_2 ) {
				return ( strtotime( $event_1['date'] ) <=> strtotime( $event_2['date'] ) );
			} );
		}

		return $data;
	}

	/**
	 * @return array
	 */
	public static function get_event_types() {
		return [
			'road'  => __( 'Road', 'run' ),
			'trail' => __( 'Trail', 'run' ),
			'ocr'   => __( 'OCR', 'run' ),
		];
	}

	/**
	 * @return array
	 */
	public static function get_event_states() {
		return [
			'scheduled'  => __( 'Scheduled', 'run' ),
			'registered' => __( 'Registered', 'run' ),
		];
	}

	/**
	 * @param int $items_count
	 *
	 * @return array
	 */
	public function get_upcoming_events( $items_count ) {
		$data   = [];
		$events = $this->get_events();

		if ( ! empty( $events ) ) {
			$data = $this->prepare_events_data( $events );
			$data = $this->prepare_upcoming_events_data( $data, $items_count );
		}

		return $data;
	}

	/**
	 * @param array $data
	 * @param int $items_count
	 *
	 * @return array
	 */
	private function prepare_upcoming_events_data( $data, $items_count ) {
		foreach ( $data as $state => $state_data ) {
			$data[ $state ]['events'] = array_slice( $state_data['events'], 0, $items_count );

			foreach ( $state_data['events'] as $key => $event ) {
				$data[ $state ]['events'][ $key ]['date'] = substr( $event['date'], 0, - 5 );
			}
		}

		return $data;
	}
}
