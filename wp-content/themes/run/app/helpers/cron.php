<?php
/**
 * @param $schedules
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
 * @param $schedules
 *
 * @return mixed
 */
function app_cron_add_every_two_hours_daily_schedule( $schedules ) {
	$schedules['everytwohoursdaily'] = [
		'interval' => HOUR_IN_SECONDS * 2,
		'display'  => __( 'Twelve times a day', 'run' ),
	];

	return $schedules;
}

/**
 *
 */
function app_activate_cron_four_times_daily_event() {
	if ( ! wp_next_scheduled( 'cron_four_times_daily_event' ) ) {
		wp_schedule_event( time() + 90, 'fourtimesdaily', 'cron_four_times_daily_event' );
	}
}

/**
 *
 */
function app_activate_cron_twelve_times_daily_event() {
	if ( ! wp_next_scheduled( 'cron_twelve_times_daily_event' ) ) {
		wp_schedule_event( time() + 60, 'everytwohoursdaily', 'cron_twelve_times_daily_event' );
	}
}
