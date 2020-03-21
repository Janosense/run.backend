<?php
/**
 * Bootstrap Carbon Fields.
 */
function app_bootstrap_carbon_fields() {
	\Carbon_Fields\Carbon_Fields::boot();
}

/**
 * Bootstrap Carbon Fields container definitions.
 */
function app_bootstrap_carbon_fields_register_fields() {
	require_once APP_APP_SETUP_DIR . 'carbon-fields' . DIRECTORY_SEPARATOR . 'post-type-result.php';
	require_once APP_APP_SETUP_DIR . 'carbon-fields' . DIRECTORY_SEPARATOR . 'post-type-event.php';
	require_once APP_APP_SETUP_DIR . 'carbon-fields' . DIRECTORY_SEPARATOR . 'theme-option-personal-best.php';
	require_once APP_APP_SETUP_DIR . 'carbon-fields' . DIRECTORY_SEPARATOR . 'theme-option-shoes.php';
	require_once APP_APP_SETUP_DIR . 'carbon-fields' . DIRECTORY_SEPARATOR . 'page-about.php';
}
