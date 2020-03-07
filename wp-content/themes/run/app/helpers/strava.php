<?php

function app_strava_set_tokens() {
	// Client ID
	if ( ! get_option( 'strava_client_id' ) ) {
		add_option( 'strava_client_id', '41719' );
	}

	// Client secret
	if ( ! get_option( 'strava_client_secret' ) ) {
		add_option( 'strava_client_secret', 'fcb2e8b415a431f1dcef4e054b2365522f605fc2' );
	}

	// Private refresh token
	if ( ! get_option( 'strava_refresh_token' ) ) {
		add_option( 'strava_refresh_token', 'c4ef1383b399371f03642f78bbae179d34c42d3d' );
	}

	// Private access token
	if ( ! get_option( 'strava_access_token' ) ) {
		add_option( 'strava_access_token', 'e97b1796f47bb45b7ab951b86e968ec1124c5678' );
	}

	// Private access token expired at
	if ( ! get_option( 'strava_access_token_expires_at' ) ) {
		add_option( 'strava_access_token_expires_at', '1583470086' );
	}
}

/**
 *
 */
function app_strava_refresh_tokens() {
	$url  = 'https://www.strava.com/oauth/token';
	$args = [
		'timeout'     => 45,
		'redirection' => 5,
		'blocking'    => true,
		'headers'     => [],
		'body'        => [
			'client_id'     => get_option( 'strava_client_id' ),
			'client_secret' => get_option( 'strava_client_secret' ),
			'grant_type'    => 'refresh_token',
			'refresh_token' => get_option( 'strava_private_refresh_token' ),
		],
		'cookies'     => []
	];

	$response = wp_remote_post( $url, $args );

	if ( ! is_wp_error( $response ) && $response['response']['code'] == 200 ) {
		$response_body = json_decode( $response['body'], true );

		if ( isset( $response_body['access_token'] ) ) {
			update_option( 'strava_access_token', $response_body['access_token'] );
		}

		if ( isset( $response_body['refresh_token'] ) ) {
			update_option( 'strava_refresh_token', $response_body['refresh_token'] );
		}

		if ( isset( $response_body['expires_at'] ) ) {
			update_option( 'strava_access_token_expires_at', $response_body['expires_at'] );
		}
	} else {
		if ( ! wp_next_scheduled( 'cron_strava_refresh_tokens_event' ) ) {
			wp_schedule_single_event( time() + 600, 'cron_strava_refresh_tokens_event' );
		}
	}
}
