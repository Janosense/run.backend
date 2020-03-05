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
	if ( ! get_option( 'strava_private_refresh_token' ) ) {
		add_option( 'strava_private_refresh_token', 'c4ef1383b399371f03642f78bbae179d34c42d3d' );
	}

	// Public refresh token
	if ( ! get_option( 'strava_public_refresh_token' ) ) {
		add_option( 'strava_public_refresh_token', '97fbb144d884113d1982f0c878b37198670dff98' );
	}

	// Private access token
	if ( ! get_option( 'strava_private_access_token' ) ) {
		add_option( 'strava_private_access_token', '5a41af6f30c35a3312cb73e6ca75c3eeb27dbeff' );
	}

	// Public access token
	if ( ! get_option( 'strava_public_access_token' ) ) {
		add_option( 'strava_public_access_token', '8db7383e76ab314770fd520f3debb1e8b47f7ffb' );
	}

	// Private access token expired at
	if ( ! get_option( 'strava_private_access_token_expires_at' ) ) {
		add_option( 'strava_private_access_token_expires_at', '1583470086' );
	}
}


function app_strava_refresh_tokens() {
	$url  = 'https://www.strava.com/oauth/token';
	$args = [
		'timeout'     => 45,
		'redirection' => 5,
		'blocking'    => true,
		'headers'     => [],
		'body'        => [
			'client_id'     => '41719',
			'client_secret' => 'fcb2e8b415a431f1dcef4e054b2365522f605fc2',
			'grant_type'    => 'refresh_token',
			'refresh_token' => get_option( 'strava_private_refresh_token' ),
		],
		'cookies'     => []
	];

	$response = wp_remote_post( $url, $args );
	if ( ! is_wp_error( $response ) ) {
		$response_body = json_decode( $response['body'] );

		if ( isset( $response_body->access_token ) ) {
			update_option( 'strava_private_access_token', $response_body->access_token );
		}

		if ( isset( $response_body->refresh_token ) ) {
			update_option( 'strava_private_refresh_token', $response_body->refresh_token );
		}

		if ( isset( $response_body->expires_at ) ) {
			update_option( 'strava_private_access_token_expires_at', $response_body->expires_at );
		}

		if ( ! wp_next_scheduled( 'cron_strava_refresh_tokens_event' ) ) {
			$timestamp = (int) get_option( 'strava_private_access_token_expires_at' ) - 200;
			wp_schedule_single_event( $timestamp, 'cron_strava_refresh_tokens_event' );
		}
	}
}
