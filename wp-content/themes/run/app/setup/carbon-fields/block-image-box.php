<?php

use Carbon_Fields\Block;
use Carbon_Fields\Field;

Block::make( __( 'Image box', 'run' ) )
     ->add_fields( [
	     Field::make( 'image', 'crb_image_box_image', __( 'Image', 'run' ) )->set_value_type( 'url' ),
	     Field::make( 'text', 'crb_image_box_caption', __( 'Caption', 'run' ) ),
     ] )
     ->set_icon( 'format-image' )
     ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) { ?>
	     <div class="image-box">
		     <a href="<?php echo $fields['crb_image_box_image']; ?>"
				class="image-box__link glightbox"
				data-title="<?php echo $fields['crb_image_box_caption']; ?>">
			     <img src="<?php echo $fields['crb_image_box_image']; ?>"
					  class="image-box__image"
					  alt="<?php echo $fields['crb_image_box_caption']; ?>">
		     </a>
	     </div>
     <?php } );
