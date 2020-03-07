<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;


Container::make( 'theme_options', __( 'My shoes', 'run' ) )
         ->set_page_file( 'shoes' )
         ->set_icon( 'dashicons-buddicons-activity' )
         ->add_fields( [
	         Field::make( 'complex', 'crb_shoes', __( 'Shoes', 'run' ) )
	              ->set_layout( 'tabbed-vertical' )
	              ->setup_labels( [
		              'plural_name'   => 'Shoes',
		              'singular_name' => 'Shoes',
	              ] )
	              ->add_fields( [
		              Field::make( 'text', 'id', __( 'Shoes id', 'run' ) ),
		              Field::make( 'text', 'brand', __( 'Brand', 'run' ) ),
		              Field::make( 'text', 'model', __( 'Model', 'run' ) ),
		              Field::make( 'text', 'distance', __( 'Distance', 'run' ) ),
		              Field::make( 'select', 'used', __( 'Are used?', 'run' ) )
		                   ->set_options( [
			                   '0' => __( 'not used', 'run' ),
			                   '1' => __( 'used', 'run' ),
		                   ] )
	              ] )
	              ->set_header_template(
		              '<% if (brand) { %>
			              <%- brand %> <%- model %>
		              <% } %>'
	              )
         ] );
