<?php

use Carbon_Fields\Block;
use Carbon_Fields\Field;

Block::make( __( 'Apportionment pace', 'run' ) )
     ->add_fields( [
	     Field::make( 'complex', 'crb_apportionment', __( 'Apportionment pace', 'run' ) )
	          ->add_fields( [
		          Field::make( 'text', 'crb_apportionment_km', __( 'km', 'run' ) )->set_width( 50 ),
		          Field::make( 'text', 'crb_apportionment_pace', __( 'Pace', 'run' ) )->set_width( 50 ),
		          Field::make( 'text', 'crb_apportionment_height', __( 'Height', 'run' ) )->set_width( 50 ),
		          Field::make( 'text', 'crb_apportionment_hr', __( 'HR', 'run' ) )->set_width( 50 ),
	          ] )
	          ->set_layout( 'tabbed-vertical' )
	          ->setup_labels( [
		          'plural_name'   => 'Rows',
		          'singular_name' => 'Row',
	          ] )
	          ->set_header_template( '
				    <% if (crb_apportionment_km) { %>
				        <%- crb_apportionment_km %> km
				    <% } %>' )
     ] )
     ->set_icon( 'format-image' )
     ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) { ?>
	     <?php if ( ! empty( $fields['crb_apportionment'] ) ) : ?>
		     <table class="apportionment">
			     <thead>
			     <tr>
				     <td>км</td>
				     <td>темп</td>
				     <td>высота</td>
				     <td>ЧСC</td>
			     </tr>
			     </thead>
			     <?php foreach ( $fields['crb_apportionment'] as $row ) : ?>
				     <tr>
					     <td><?php echo $row['crb_apportionment_km']; ?></td>
					     <td><?php echo $row['crb_apportionment_pace']; ?></td>
					     <td><?php echo $row['crb_apportionment_height']; ?></td>
					     <td><?php echo $row['crb_apportionment_hr']; ?></td>
				     </tr>
			     <?php endforeach; ?>
		     </table>
	     <?php endif; ?>
     <?php } );
