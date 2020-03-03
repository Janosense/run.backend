<?php

use App\Controllers\Web\StatisticsController;
use Carbon_Fields\Container;
use Carbon_Fields\Field;

$fields           = StatisticsController::get_personal_best_fields();
$container_fields = [];

foreach ( $fields as $field_key => $field_title ) {
	$container_fields[] = Field::make( 'text', $field_key, $field_title )->set_attribute( 'placeholder', '00:00:00.0' );
}

Container::make( 'theme_options', __( 'Personal Best', 'run' ) )
         ->set_page_file( 'personal-best' )
         ->set_icon( 'dashicons-awards' )
         ->add_fields( $container_fields );
