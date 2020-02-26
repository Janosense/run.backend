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
 * Admin panel actions
 */
add_action( 'init', 'app_switch_locale_for_admin_panel' );
add_filter( 'manage_result_posts_columns', 'app_add_custom_columns_for_result_post_type', 4 );
add_action( 'manage_result_posts_custom_column', 'app_fill_custom_columns_for_result_post_type', 5, 2 );
add_action( 'restrict_manage_posts', 'app_add_filter_by_type_for_result_post_type', 10, 1 );
add_action( 'pre_get_posts', 'app_add_filter_by_type_handler_for_result_post_type', 10, 1 );

/**
 * Custom actions
 */
add_action( 'carbon_fields_post_meta_container_saved', [
	ResultsController::class,
	'set_personal_best_result'
], 10, 2 );
