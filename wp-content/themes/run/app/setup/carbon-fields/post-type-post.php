<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make( 'post_meta', 'meta_data', __( 'Post meta data', 'run' ) )
         ->where( 'post_type', '=', 'post' )
         ->add_fields( [
	         Field::make( 'text', 'crb_meta_description', __( 'Post meta description', 'run' ) ),
	         Field::make( 'image', 'crb_meta_image', __( 'Post meta image', 'run' ) )->set_value_type( 'url' ),
         ] );
