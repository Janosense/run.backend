<?php

use App\Controllers\Web\ResultsController;

/**
 * Assets
 */
add_action( 'admin_enqueue_scripts', 'app_action_admin_enqueue_assets' );

/**
 * Register taxonomies
 */
add_action( 'init', 'app_register_taxonomies' );

/**
 * Register post types
 */
add_action( 'init', 'app_register_post_types' );

/**
 * Carbon Fields
 */
add_action( 'after_setup_theme', 'app_bootstrap_carbon_fields', 100 );
add_action( 'carbon_fields_register_fields', 'app_bootstrap_carbon_fields_register_fields' );

/**
 * Custom actions
 */
add_action( 'publish_result', [ ResultsController::class, 'set_personal_best_result' ], 10, 2 );
