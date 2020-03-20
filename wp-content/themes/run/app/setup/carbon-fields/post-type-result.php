<?php

use App\Controllers\Web\ResultsController;
use Carbon_Fields\Container;
use Carbon_Fields\Field;

$result_types = ResultsController::get_result_types();
$fields       = [
	Field::make( 'hidden', 'crb_result_is_pb', __( 'Result is Personal Best?', 'run' ) ),
	Field::make( 'text', 'crb_result_distance', __( 'Distance', 'run' ) )->set_width( 50 ),
	Field::make( 'date', 'crb_result_event_date', __( 'Date', 'run' ) )->set_input_format( 'd.m.Y', 'd.m.Y' )
	     ->set_width( 50 ),
	Field::make( 'text', 'crb_result_time', __( 'Result time', 'run' ) )->set_width( 33 )
	     ->set_attribute( 'placeholder', '00:00:00.00' ),
	Field::make( 'text', 'crb_result_pace', __( 'Average pace', 'run' ) )->set_width( 33 ),
	Field::make( 'text', 'crb_result_time_diff', __( 'Difference with PB', 'run' ) )->set_width( 33 ),
	Field::make( 'select', 'crb_result_type', __( 'Result type' ) )
	     ->set_options( $result_types )
	     ->set_width( 33 ),
	Field::make( 'text', 'crb_result_event_place', __( 'Place of event', 'run' ) )->set_width( 33 ),
	Field::make( 'text', 'crb_result_event_organizer', __( 'Organizer', 'run' ) )->set_width( 33 ),
	Field::make( 'text', 'crb_result_place_overall', __( 'Place overall', 'run' ) )
	     ->set_width( 33 )
	     ->set_default_value( '--/--' ),
	Field::make( 'text', 'crb_result_place_gender', __( 'Place gender', 'run' ) )
	     ->set_width( 33 )
	     ->set_default_value( '--/--' ),
	Field::make( 'text', 'crb_result_place_age', __( 'Place age', 'run' ) )
	     ->set_width( 33 )
	     ->set_default_value( '--/--' ),
	Field::make( 'textarea', 'crb_result_description', __( 'Description', 'run' ) ),
	Field::make( 'text', 'crb_result_distance_category', __( 'Category', 'run' ) )
	     ->set_help_text( __( 'Optional, for OCR events' ) ),
];

Container::make( 'post_meta', 'result_data', __( 'Result data', 'run' ) )
         ->where( 'post_type', '=', 'result' )
         ->add_fields( $fields )
         ->set_classes( 'carbon_fields_container_result_data' );
