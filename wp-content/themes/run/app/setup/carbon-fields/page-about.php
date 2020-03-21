<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

define( 'ABOUT_PAGE_ID', 46 );

Container::make( 'post_meta', 'goals', __( 'My goals', 'run' ) )
         ->where( 'post_id', '=', ABOUT_PAGE_ID )
         ->add_fields( [
	         Field::make( 'complex', 'crb_goals', __( 'Goals', 'run' ) )
	              ->set_layout( 'tabbed-vertical' )
	              ->setup_labels( [
		              'plural_name'   => 'Goals',
		              'singular_name' => 'Goal',
	              ] )
	              ->add_fields( [
		              Field::make( 'text', 'crb_goal_title', __( 'Goal title', 'run' ) ),
		              Field::make( 'textarea', 'crb_goal_description', __( 'Goal description', 'run' ) ),
		              Field::make( 'select', 'crb_goal_state', __( 'Goal status', 'run' ) )
		                   ->set_options( [
			                   'scheduled' => __( 'Scheduled', 'run' ),
			                   'completed' => __( 'Completed', 'run' ),
		                   ] )
	              ] )
	              ->set_header_template(
						'<% if (crb_goal_title) { %>
							<%- crb_goal_title %>
						<% } %>'
	              ),
         ] );


