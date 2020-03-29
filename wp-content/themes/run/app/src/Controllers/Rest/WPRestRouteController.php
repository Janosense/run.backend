<?php

namespace App\Controllers\Rest;

use WP_REST_Controller;

class WPRestRouteController extends WP_REST_Controller {
	function __construct() {
		$this->namespace = 'run-app/v1';
		$this->rest_base = 'route';
	}

	public function register_routes() {
		register_rest_route( $this->namespace, "/$this->rest_base", [
			[
				'methods'  => 'GET',
				'callback' => [ $this, 'get_route_data' ],
				'args'     => [
					'post_id'  => [
						'type'     => 'integer',
						'required' => true,
					],
					'meta_key' => [
						'type'     => 'string',
						'required' => true,
					],
				]
			],
		] );
	}


	/**
	 * @param \WP_REST_Request $request
	 *
	 * @return \WP_Error
	 */
	public function get_route_data( $request ) {
		$request_params = $request->get_params();
		$route_data     = get_post_meta( $request_params['post_id'], $request_params['meta_key'] );
		if ( ! empty( $route_data ) ) {
			wp_send_json( $route_data );
		}

		return new \WP_Error();
	}
}
