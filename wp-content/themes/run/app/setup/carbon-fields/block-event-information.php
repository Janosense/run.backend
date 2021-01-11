<?php

use Carbon_Fields\Block;
use Carbon_Fields\Field;

Block::make( __( 'Event information', 'run' ) )
     ->add_fields( [
	     Field::make( 'text', 'crb_event_info_title', __( 'Event title', 'run' ) )->set_required( true ),
	     Field::make( 'text', 'crb_event_info_url', __( 'Event URL', 'run' ) )->set_required( true ),
	     Field::make( 'text', 'crb_event_info_date', __( 'Event date', 'run' ) )->set_required( true ),
	     Field::make( 'text', 'crb_event_info_place', __( 'Event place', 'run' ) )->set_required( true ),
	     Field::make( 'text', 'crb_event_info_organizer', __( 'Event organizer', 'run' ) ),
     ] )
     ->set_icon( 'superhero' )
     ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) { ?>
	     <div class="event-info-block">
		     <div class="event-info-block__header">
			     <span class="event-info-block__date"><?php echo $fields['crb_event_info_date']; ?></span>
			     <a href="<?php echo $fields['crb_event_info_url']; ?>" class="event-info-block__title"><?php echo $fields['crb_event_info_title']; ?></a>
		     </div>
		     <span class="event-info-block__place"><?php echo $fields['crb_event_info_place']; ?></span>
		     <?php if ( ! empty( $fields['crb_event_info_organizer'] ) ) : ?>
			     <span class="event-info-block__organizer"><?php echo $fields['crb_event_info_organizer']; ?></span>
		     <?php endif; ?>
	     </div>
     <?php } );
