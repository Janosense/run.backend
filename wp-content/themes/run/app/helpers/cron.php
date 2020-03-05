<?php

/**
 * @param array $schedules
 *
 * @return mixed
 */
function app_cron_add_four_times_daily_schedule( $schedules ) {
	$schedules['fourtimesdaily'] = array(
		'interval' => HOUR_IN_SECONDS * 6,
		'display'  => __( 'Four times a day', 'run' ),
	);

	return $schedules;
}

/**
 *
 */
function app_first_activate_cron_strava_refresh_tokens() {
	if ( ! wp_next_scheduled( 'cron_strava_refresh_tokens_event' ) ) {
		$timestamp = (int) get_option( 'strava_private_access_token_expires_at' ) - 200;
		wp_schedule_single_event( $timestamp, 'cron_strava_refresh_tokens_event' );
	}
}
