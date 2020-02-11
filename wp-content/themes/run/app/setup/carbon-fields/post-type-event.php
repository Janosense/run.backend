<?php

use App\Controllers\Web\CalendarController;
use Carbon_Fields\Container;
use Carbon_Fields\Field;

$event_states = CalendarController::get_event_states();
$event_types  = CalendarController::get_event_types();
$fields       = [
	Field::make( 'select', 'crb_event_state', __( 'Event state', 'run' ) )->set_options( $event_states ),
	Field::make( 'date', 'crb_event_date', __( 'Date', 'run' ) )->set_input_format( 'd.m.Y', 'd.m.Y' ),
	Field::make( 'select', 'crb_event_type', __( 'Type', 'run' ) )->set_options( $event_types ),
	Field::make( 'text', 'crb_event_organizer', __( 'Organizer', 'run' ) ),
	Field::make( 'text', 'crb_event_distance', __( 'Distance', 'run' ) ),
	Field::make( 'text', 'crb_event_place', __( 'Place', 'run' ) ),
	Field::make( 'text', 'crb_event_bib', __( 'Race number', 'run' ) ),
	Field::make( 'text', 'crb_event_url', __( 'Event official page', 'run' ) ),

];

Container::make( 'post_meta', 'event_data', __( 'Event data', 'run' ) )
         ->where( 'post_type', '=', 'event' )
         ->add_fields( $fields )
         ->set_classes( 'carbon_fields_container_event_data' );
