<?php

use App\Controllers\Web\ResultsController;

/**
 * @param array $columns
 *
 * @return mixed
 */
function app_add_custom_columns_for_result_post_type( $columns ) {
	$temp_date_column = $columns['date'];
	unset( $columns['date'] );
	$columns['type']  = __( 'Result type', 'run' );
	$columns['is_pb'] = __( 'Is personal best?', 'run' );
	$columns['date']  = $temp_date_column;

	return $columns;
}

/**
 * @param string $column_name
 * @param integer $post_id
 */
function app_fill_custom_columns_for_result_post_type( $column_name, $post_id ) {
	switch ( $column_name ) {
		case 'type':
			$result_types = ResultsController::get_result_types();
			$type         = get_post_meta( $post_id, '_crb_result_type', 1 );
			echo $result_types[ $type ];
			break;
		case 'is_pb':
			if ( get_post_meta( $post_id, '_crb_result_is_pb', 1 ) ) {
				echo 'PB';
			}
	}
}

/**
 * @param string $post_type
 */
function app_add_filter_by_type_for_result_post_type( $post_type ) {
	if ( $post_type == 'result' ) {
		$result_types  = [ '-1' => __( 'All result types', 'run' ) ];
		$result_types  = $result_types + ResultsController::get_result_types();
		$selected_type = isset( $_GET['result_type'] ) ? $_GET['result_type'] : '-1';
		\WPEmerge\render( 'templates/admin/filter-results-by-type.twig', [
			'types'    => $result_types,
			'selected' => $selected_type,
		] );
	}
}

/**
 * @param WP_Query $query
 */
function app_add_filter_by_type_handler_for_result_post_type( $query ) {
	if ( ! is_admin() ) {
		return;
	}

	$current_screen = get_current_screen();
	if ( $current_screen->id != 'edit-result' || $current_screen->post_type != 'result' || empty( $current_screen->post_type ) ) {
		return;
	}

	if ( isset( $_GET['result_type'] ) && $_GET['result_type'] != '-1' ) {
		$query->set( 'meta_query', [
			[
				'key'   => '_crb_result_type',
				'value' => $_GET['result_type']
			],
		] );
	}
}

/**
 *
 */
function app_switch_locale_for_admin_panel() {
	switch_to_locale( 'en_US' );
}
