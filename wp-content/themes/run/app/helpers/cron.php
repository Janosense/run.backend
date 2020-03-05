<?php

function app_cron_add_four_times_daily_schedule( $schedules ) {
	$schedules['fourtimesdaily'] = array(
		'interval' => HOUR_IN_SECONDS * 6,
		'display'  => __( 'Four times a day', 'run' ),
	);

	return $schedules;
}


function app_activate_cron_strava_refresh_tokens() {
	if ( ! wp_next_scheduled( 'cron_four_times_daily_event' ) ) {
		wp_schedule_event( 1583451103, 'fourtimesdaily', 'cron_four_times_daily_event' );
	}
}
