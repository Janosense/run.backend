<?php

use Carbon_Fields\Block;
use Carbon_Fields\Field;

Block::make( __( 'Disclaimer' ) )
     ->add_fields( [
	     Field::make( 'rich_text', 'crb_disclaimer_content', __( 'Disclaimer content' ) )
     ] )
     ->set_icon( 'visibility' )
     ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) { ?>
	     <div class="disclaimer">
		     <div class="disclaimer__content">
			     <?php echo wpautop( $fields['crb_disclaimer_content'] ) ?>
		     </div>
	     </div>
     <?php } );
