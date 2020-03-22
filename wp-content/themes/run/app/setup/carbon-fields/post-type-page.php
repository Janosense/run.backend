<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make( 'post_meta', 'meta_data', __( 'Page meta data', 'run' ) )
         ->where( 'post_type', '=', 'page' )
         ->add_fields( [
	         Field::make( 'text', 'crb_meta_description', __( 'Page meta description', 'run' ) )
         ] );

